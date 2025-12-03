<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')->orderBy('created_at','desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $post = new Post();
        return view('admin.posts.create', compact('post'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        }

        DB::beginTransaction();
        try {
            // featured image
            if ($request->hasFile('featured_image')) {
                $data['featured_image'] = $request->file('featured_image')->store('posts','public');
            }

            $post = Post::create($data);

            // gallery images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $i => $img) {
                    $path = $img->store('posts/gallery','public');
                    PostImage::create([
                        'post_id' => $post->id,
                        'path' => $path,
                        'order' => $i,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.posts.index')->with('success','Đã tạo phòng.');
        } catch (\Throwable $e) {
            DB::rollBack();
            // optional: Log::error($e);
            return back()->withErrors('Lỗi lưu dữ liệu: '.$e->getMessage())->withInput();
        }
    }

    public function edit(Post $post)
    {
        $post->load('images');
        return view('admin.posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        }

        DB::beginTransaction();
        try {
            // featured image replace
            if ($request->hasFile('featured_image')) {
                if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                    Storage::disk('public')->delete($post->featured_image);
                }
                $data['featured_image'] = $request->file('featured_image')->store('posts','public');
            }

            $post->update($data);

            // If new gallery images uploaded, append them
            if ($request->hasFile('images')) {
                $maxOrder = $post->images()->max('order') ?? 0;
                foreach ($request->file('images') as $i => $img) {
                    $path = $img->store('posts/gallery','public');
                    PostImage::create([
                        'post_id' => $post->id,
                        'path' => $path,
                        'order' => $maxOrder + $i + 1,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.posts.index')->with('success','Đã cập nhật phòng.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Lỗi cập nhật: '.$e->getMessage())->withInput();
        }
    }

    public function destroy(Post $post)
    {
        DB::beginTransaction();
        try {
            // delete featured image file
            if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                Storage::disk('public')->delete($post->featured_image);
            }
            // delete gallery files
            foreach ($post->images as $img) {
                if ($img->path && Storage::disk('public')->exists($img->path)) {
                    Storage::disk('public')->delete($img->path);
                }
            }
            $post->delete();
            DB::commit();
            return redirect()->route('admin.posts.index')->with('success','Đã xóa phòng.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Lỗi xóa: '.$e->getMessage());
        }
    }

    // optional: route to delete a single gallery image via ajax/form
    public function destroyImage(PostImage $image)
    {
        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }
        $image->delete();
        return back()->with('success','Đã xóa ảnh.');
    }
}
