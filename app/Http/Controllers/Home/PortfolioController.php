<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PortfolioController extends Controller {

    public function AllPortfolio() {
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all', compact('portfolio'));
    }

    public function AddPortfolio() {
        return view('admin.portfolio.portfolio_add');
    }

    public function StorePortfolio(Request $request) {

        $request->validate([

            'portfolio_name'  => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',

        ], [
            'portfolio_name.required'  => 'Portfolio Name is Required',
            'portfolio_title.required' => 'Portfolio Title is Required',

        ]);

        $image = $request->file('portfolio_image');
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img = $img->resize(1020, 519);
        $img->save(base_path('public/upload/portfolio_images/' . $name_gen));

        Portfolio::create([

            'portfolio_name'        => $request->portfolio_name,
            'portfolio_title'       => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
            'portfolio_image'       => 'upload/portfolio_images/' . $name_gen,
            'created_at'            => now(),
        ]);
        $notification = [
            'message'    => 'Portifolio Inserted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.portfolio')->with($notification);
    }

    public function EditPortfolio($id) {
        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portfolio.portfolio_edit', compact('portfolio'));
    }

    public function UpdatePortfolio(Request $request) {

        $portfolio_id = $request->id;

        if ($request->file('portfolio_image')) {
            $image = $request->file('portfolio_image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(1020, 519);
            $img->save(base_path('public/upload/portfolio_images/' . $name_gen));

            Portfolio::findOrFail($portfolio_id)->update([

                'portfolio_name'        => $request->portfolio_name,
                'portfolio_title'       => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image'       => 'upload/portfolio_images/' . $name_gen,
                'created_at'            => now(),
            ]);
            $notification = [
                'message'    => 'Portifolio Updated With Image Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->route('all.portfolio')->with($notification);
        } else {
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name'        => $request->portfolio_name,
                'portfolio_title'       => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,

            ]);
            $notification = [
                'message'    => 'Portifolio Updated Successfully WithOut Image ',
                'alert-type' => 'success',
            ];
            return redirect()->route('all.portfolio')->with($notification);
        }
    }

    public function DeletePortfolio($id) {
        $portfolio = Portfolio::findOrFail($id);
        $img = $portfolio->portfolio_image;
        unlink($img);

        Portfolio::findOrFail($id)->delete();
        $notification = [
            'message'    => 'Portfolio Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function PortfolioDetails($id) {
        $portfolio = Portfolio::findOrFail($id);
        return view('frontend.portfolio_details', compact('portfolio'));
    }

}
