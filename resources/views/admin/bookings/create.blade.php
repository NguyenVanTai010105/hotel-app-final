@extends('layouts.app')

@section('title','Tạo phòng')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
  <h1 class="text-2xl mb-4">Tạo phòng mới</h1>

  <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @include('admin.posts._form', ['buttonText' => 'Tạo phòng'])
  </form>
</div>
@endsection
