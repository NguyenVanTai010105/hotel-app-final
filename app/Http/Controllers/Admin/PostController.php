<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        // nếu bạn muốn bắt login: uncomment
        // $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:4096',
            // status chỉ chấp nhận 2 trạng thái phòng
            'status' => 'required|in:' . Post::STATUS_AVAILABLE . ',' . Post::STATUS_UNAVAILABLE,
            'published_at' => 'nullable|date',
        ]);

        // tạo slug an toàn
        $slug = Str::slug($validated['slug'] ?? $validated['title']);
        $base = $slug;
        $i = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }
        $validated['slug'] = $slug;

        // user assignment: nếu auth tồn tại thì dùng, nếu không lấy user đầu tiên
        $userId = auth()->id() ?? User::value('id');
        if (!$userId) {
            return back()->withInput()->withErrors('Chưa có user trong hệ thống. Hãy tạo user trước.');
        }
        $validated['user_id'] = $userId;

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        // nếu status là available mà published_at rỗng -> set now()
        if ($validated['status'] === Post::STATUS_AVAILABLE && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $post = Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Đã tạo bài viết (phòng).');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug,' . $post->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:4096',
            'status' => 'required|in:' . Post::STATUS_AVAILABLE . ',' . Post::STATUS_UNAVAILABLE,
            'published_at' => 'nullable|date',
        ]);

        $slug = Str::slug($validated['slug'] ?? $validated['title']);
        $base = $slug; $i = 1;
        while (Post::where('slug', $slug)->where('id', '<>', $post->id)->exists()) {
            $slug = $base . '-' . $i++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        if ($validated['status'] === Post::STATUS_AVAILABLE && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Đã cập nhật bài viết (phòng).');
    }

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Đã xóa bài viết.');
    }
}
