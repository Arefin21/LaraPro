<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AboutController extends Controller {
    public function aboutPage() {
        $aboutPage = About::find(1);
        return view('admin.about_page.about_page_all', compact('aboutPage'));
    }

    public function updateAbout(Request $request) {
        $about_id = $request->id;
        if ($request->file('about_image')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('about_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('about_image'));
            $img = $img->resize(523, 605);
            //$img->toJpeg(80)->save(base_path('public/upload/about_image/' . $name_gen));
            $img->save(base_path('public/upload/about_images/' . $name_gen));

            About::findOrFail($about_id)->update([
                'title'             => $request->title,
                'short_title'       => $request->short_title,
                'short_description' => $request->short_description,
                'long_description'  => $request->long_description,
                'about_image'       => 'upload/about_images/' . $name_gen,
            ]);
            $notification = [
                'message'    => 'About Slide Updated with Image Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);

        } else {

            About::findOrFail($about_id)->update([
                'title'             => $request->title,
                'short_title'       => $request->short_title,
                'short_description' => $request->short_description,
                'long_description'  => $request->long_description,
            ]);
            $notification = [
                'message'    => 'About Slide Updated Successfully WithOut Image',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function homeAbout() {
        $aboutPage = About::find(1);
        return view('frontend.about_page', compact('aboutPage'));
    }

    public function AboutMultiImage() {
        return view('admin.about_page.multiImage');
    }

    public function storeMultiImage(Request $request) {

        $images = $request->file('multi_image');

        foreach ($images as $multi_image) {

            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();
            $img = $manager->read($multi_image);
            $img = $img->resize(220, 220);
            $img->save(base_path('public/upload/multi_images/' . $name_gen));

            MultiImage::create([
                'multi_image' => 'upload/multi_images/' . $name_gen,
                'created_at'  => now(),
            ]);
        }

        $notification = [
            'message'    => 'Multi Images Inserted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function AllMultiImage() {
        $allMultiImage = MultiImage::all();
        return view('admin.about_page.all_multiimage', compact('allMultiImage'));
    }

    public function EditMultiImage($id) {
        $multiImage = MultiImage::findOrFail($id);
        return view('admin.about_page.edit_multi_image', compact('multiImage'));
    }

    public function UpdateMultiImage(Request $request) {

        $multi_image_id = $request->id;

        if ($request->file('multi_image')) {
            $image = $request->file('multi_image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(220, 220);
            $img->save(base_path('public/upload/multi_images/' . $name_gen));

            MultiImage::findOrFail($multi_image_id)->update([

                'multi_image' => 'upload/multi_images/' . $name_gen,
            ]);
            $notification = [
                'message'    => 'Multi Image Updated Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->route('all.multi.image')->with($notification);

        }
    }

    public function DeleteMultiImage($id) {

        $multi = MultiImage::findOrFail($id);
        $img = $multi->multi_image;
        unlink($img);

        MultiImage::findOrFail($id)->delete();

        $notification = [
            'message'    => 'Multi Image Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);

    }

}