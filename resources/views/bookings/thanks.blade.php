@extends('layouts.app')

@section('title','Cảm ơn')

@section('content')
<div class="max-w-2xl mx-auto p-6 text-center">
  <h1 class="text-2xl font-semibold mb-4">Cảm ơn bạn!</h1>
  <p class="mb-4">Chúng tôi đã nhận được yêu cầu đặt phòng của bạn. Chúng tôi sẽ liên hệ lại sớm nhất.</p>
  <a href="{{ route('home') }}" class="px-4 py-2 bg-green-600 text-white rounded">Về trang chủ</a>
</div>
@endsection
