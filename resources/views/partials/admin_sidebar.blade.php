{{-- resources/views/partials/admin_sidebar.blade.php --}}
<div class="admin-sidebar" style="width:260px; padding:20px; background:#fff; border-right:1px solid #e5e7eb; height:100vh; box-sizing:border-box;">
  <h3 style="margin:0 0 12px; font-weight:600;">Quản trị</h3>

  <nav>
    <ul style="list-style:none; padding:0; margin:0;">
      <li style="margin-bottom:8px;">
        <a href="{{ route('admin.posts.index') }}" style="display:flex; justify-content:space-between; align-items:center; text-decoration:none; color: #111;">
          <span>Phòng</span>
          <span style="font-size:12px; background:#e6f4ea; color:#057a38; padding:2px 8px; border-radius:999px;">{{ $postsCount ?? 0 }}</span>
        </a>
      </li>

      <li style="margin-bottom:8px;">
        <a href="{{ route('admin.bookings.index') }}" style="display:flex; justify-content:space-between; align-items:center; text-decoration:none; color: #111;">
          <span>Đặt phòng</span>
          <span style="font-size:12px; background:#eef2ff; color:#3730a3; padding:2px 8px; border-radius:999px;">{{ $bookingsCount ?? 0 }}</span>
        </a>
      </li>
    </ul>
  </nav>

  <hr style="margin:14px 0; border:none; border-top:1px solid #f1f5f9;">

  <div style="font-weight:600; font-size:13px; margin-bottom:8px;">Phòng (lọc nhanh)</div>

  <div style="max-height:52vh; overflow:auto;">
    <ul style="list-style:none; padding:0; margin:0;">
      {{-- danh sách phòng --}}
      @if(!empty($postsList) && $postsList->count())
        @foreach($postsList as $p)
          <li style="margin-bottom:6px;">
            <a href="{{ route('admin.bookings.index', ['post' => $p->id]) }}"
               style="display:flex; justify-content:space-between; align-items:center; text-decoration:none; color:#111;"
               class="{{ request('post') == $p->id ? 'active' : '' }}">
              <span style="font-size:13px;">{{ \Illuminate\Support\Str::limit($p->title, 35) }}</span>
              <span style="font-size:12px; color:#94a3b8;">#{{ $p->id }}</span>
            </a>
          </li>
        @endforeach
      @else
        <li class="text-muted">Chưa có phòng</li>
      @endif
    </ul>
  </div>
</div>

{{-- optional tiny css for active --}}
<style>
  .admin-sidebar a.active { background:#f1f5f9; border-radius:6px; padding:6px 8px; }
  .admin-sidebar a:hover { background:#fbfbfc; border-radius:6px; padding:6px 8px; }
</style>
