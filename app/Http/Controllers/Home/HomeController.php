<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class HomeController extends Controller {

    public function homeSlide() {
        $homeSlide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all', compact('homeSlide'));
    }

    public function updateSlider(Request $request) {
        $slide_id = $request->id;
        if ($request->file('home_slide')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('home_slide')->getClientOriginalExtension();
            $img = $manager->read($request->file('home_slide'));
            $img = $img->resize(636, 852);
            //$img->toJpeg(80)->save(base_path('public/upload/home_slide/' . $name_gen));
            $img->save(base_path('public/upload/home_slide/' . $name_gen));

            HomeSlide::findOrFail($slide_id)->update([
                'title'       => $request->title,
                'short_title' => $request->short_title,
                'video_url'   => $request->video_url,
                'home_slide'  => 'upload/home_slide/' . $name_gen,
            ]);
            $notification = [
                'message'    => 'Home Slide Updated with Image Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);

        } else {

            HomeSlide::findOrFail($slide_id)->update([
                'title'       => $request->title,
                'short_title' => $request->short_title,
                'video_url'   => $request->video_url,
            ]);
            $notification = [
                'message'    => 'Home Slide Updated Successfully WithOut Image',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        }
    }

}
