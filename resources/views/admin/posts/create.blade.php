@extends('layouts.app')

@section('title','Tạo bài viết')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Tạo bài viết</h1>

  <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @include('admin.posts._form', ['buttonText' => 'Tạo bài'])
  </form>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('title')?.addEventListener('input', function() {
    const slugEl = document.getElementById('slug');
    if (slugEl && !slugEl.value) {
      slugEl.value = this.value.toLowerCase().replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-');
    }
  });

  const input = document.getElementById('featured_image');
  const preview = document.getElementById('featured_preview');
  input?.addEventListener('change', function(e) {
    const f = e.target.files[0];
    if (!f) return;
    const r = new FileReader();
    r.onload = function(ev) { preview.src = ev.target.result; preview.style.display = 'block'; };
    r.readAsDataURL(f);
  });
});
</script>
@endsection
