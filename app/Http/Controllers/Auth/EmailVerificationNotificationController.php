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
    public function sendOTP()
    {
        $user = Auth::user();

        if (!$user) {
            return back()->with('error', 'Vui lòng đăng nhập');
        }
        $record = EmailVerification::where('email', $user->email)->first();

        if ($record && $record->expires_at === NULL) {
            $otp = rand(100000, 999999);
            EmailVerification::updateOrCreate(
                ['email' => $user->email],
                [
                    'otp' => $otp,
                    'expires_at' => now()->addMinutes(5)
                ]
            );
            try {
                Mail::to($user->email)->send(new SendEmail($otp));

                return redirect()->route('viewVerify')->with('success', 'OTP đã được gửi lại đến email của bạn');
            } catch (\Exception $e) {
                // \Log::error('Resend OTP Error: ' . $e->getMessage());
                return back()->with('error', 'Không thể gửi email: ' . $e->getMessage());
            }
        } else {
            $otp = $record->otp;
            EmailVerification::updateOrCreate(
                ['email' => $user->email],
                [
                    'otp' => $otp,
                    'expires_at' => now()->addMinutes(5)
                ]
            );
        }
    }
    public function view()
    {
        return view('auth.verify-email');
    }
    public function verify(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'otp' => 'required'
        ]);
        $otpArray = $request->otp;
        $otp = implode('', $otpArray);
        $record = EmailVerification::where('email', $user->email)
            ->where('otp', $otp)
            ->latest()
            ->first();
        if (!$record) {
            return response()->json(['message' => 'OTP này không tồn tại'], 400);
        }
        if ($record->expires_at < now()) {
            $record->delete();
            return response()->json(['message' => 'OTP đã hết hạn'], 400);
        }
        if ($record->otp != $data['otp']) {
            return response()->json(['message' => 'OTP không chính xác'], 400);
        }
        User::where('email', $data['email'])->update(['email_verified_at' => now()]);
        return  back()->with('message', 'Tạo tài khoản thành công!');
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
        }

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
