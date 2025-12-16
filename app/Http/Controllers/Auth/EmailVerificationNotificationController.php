<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\Models\EmailVerification;
use App\Models\User;
use App\Notifications\SendOtpNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function view()
    {
        return view('auth.verify-email');
    }
    public function sendOTP()
    {
        $user = Auth::user();

        if (!$user) {
            return back()->with('error', 'Vui lòng đăng nhập');
        }
        $record = EmailVerification::where('email', $user->email)->first();
        if ($record && $record->expires_at > now()) {
            return redirect()->route('viewVerify')->with('success', 'OTP đã được gửi lại đến email của bạn');
        }

        $otp = rand(100000, 999999);
        EmailVerification::updateOrCreate(
            [
                'email' => $user->email,
                'otp' => $otp,
                'expires_at' => now()->addMinutes(5)
            ]
        );
        try {
            Mail::to($user->email)->send(new SendEmail($otp));
            return redirect()->route('viewVerify')->with('success', 'OTP đã được gửi lại đến email của bạn');
        } catch (\Exception $e) {
            return back()->with('error', 'Không thể gửi email: ' . $e->getMessage());
        }
    }
    public function verify(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'otp' => 'required'
        ]);

        $record = EmailVerification::where('email', $user->email)
            ->where('otp', $data['otp'])
            ->latest()
            ->first();
        if (!$record) {
            return back()->with('error', 'OTP này không tồn tại');
        }
        if ($record->expires_at < now() && $record->otp === $data['otp']) {
            $record->delete();
            return back()->with('error', 'OTP đã hết hạn');
        }
        if ($record->otp != $data['otp']) {
            return back()->with('error', 'OTP không chính xác');
        }

        User::where('email', Auth::user()->email)->update(['email_verified_at' => now()]);
        return  redirect()->route('welcome')->with('status', 'Xác thực tài khoản thành công!');
    }
    public function resend(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return back()->with('error', 'Vui lòng đăng nhập');
        }
        $otp = rand(100000, 999999);
        $record = EmailVerification::where('email', $user->email)->first();

        if ($record && $record->expires_at > now()) {
            return back()->with('error', 'OTP vẫn còn hiệu lực, vui lòng kiểm tra email!');
        } else {
            EmailVerification::updateOrCreate(
                ['email' => $user->email],
                [
                    'otp' => $otp,
                    'expires_at' => now()->addMinutes(5)
                ]
            );

            try {
                Mail::to($user->email)->send(new SendEmail($otp));

                return back()->with('success', 'OTP đã được gửi lại đến email của bạn');
            } catch (\Exception $e) {
                // \Log::error('Resend OTP Error: ' . $e->getMessage());
                return back()->with('error', 'Không thể gửi email: ' . $e->getMessage());
            }
        }
    }
}
