<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
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
}
