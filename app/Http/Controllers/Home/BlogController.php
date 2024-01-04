<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class BlogController extends Controller {

    public function AllBlog() {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.blogs_all', compact('blogs'));
    }

    public function AddBlog() {
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('admin.blogs.blogs_add', compact('categories'));
    }
    public function StoreBlog(Request $request) {

        $request->validate([

            'blog_title' => 'required',

        ], [
            'blog_title.required' => 'Blog Title is Required',

        ]);

        $image = $request->file('blog_image');
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img = $img->resize(430, 327);
        $img->save(base_path('public/upload/blog_images/' . $name_gen));

        Blog::create([

            'blog_category_id' => $request->blog_category_id,
            'blog_title'       => $request->blog_title,
            'blog_tags'        => $request->blog_tags,
            'blog_description' => $request->blog_description,
            'blog_image'       => 'upload/blog_images/' . $name_gen,
            'created_at'       => now(),
        ]);
        $notification = [
            'message'    => 'Blog Inserted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.blog')->with($notification);

    }

    public function EditBlog($id) {
        $blogs = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('admin.blogs.blogs_edit', compact('blogs', 'categories'));
    }

    public function UpdateBlog(Request $request) {

        $blog_id = $request->id;
        if ($request->file('blog_image')) {
            $image = $request->file('blog_image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(430, 327);
            $img->save(base_path('public/upload/blog_images/' . $name_gen));

            Blog::findOrFail($blog_id)->update([

                'blog_category_id' => $request->blog_category_id,
                'blog_title'       => $request->blog_title,
                'blog_tags'        => $request->blog_tags,
                'blog_description' => $request->blog_description,
                'blog_image'       => 'upload/blog_images/' . $name_gen,
                'created_at'       => now(),
            ]);
            $notification = [
                'message'    => 'Blog Update Successfully With Image',
                'alert-type' => 'success',
            ];
            return redirect()->route('all.blog')->with($notification);

        } else {

            Blog::findOrFail($blog_id)->update([

                'blog_category_id' => $request->blog_category_id,
                'blog_title'       => $request->blog_title,
                'blog_tags'        => $request->blog_tags,
                'blog_description' => $request->blog_description,
            ]);
            $notification = [
                'message'    => 'Blog Update Successfully Without Image',
                'alert-type' => 'success',
            ];
            return redirect()->route('all.blog')->with($notification);

        }

    }

    public function DeleteBlog($id) {

        $blogs = Blog::findOrFail($id);
        $img = $blogs->blog_image;
        unlink($img);

        Blog::findOrFail($id)->delete();
        $notification = [
            'message'    => 'Blog Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

}
