<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('banners.index', compact('banners'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'type' => ['required', Rule::in(array_keys(Banner::TYPES))],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $banner = new Banner;
        $banner->title = $request->title;
        $banner->link = $request->link;
        $banner->type = $request->type;
        $banner->image_url = "/images/".$imageName;
        $banner->save();

        return redirect()->route('banners.index')->with('success','Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required',
        ]);

        if($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            //delete old image
            if($banner->image_url) {
                //check if file exists
                if(file_exists(public_path($banner->image_url))) {
                    unlink(public_path($banner->image_url));
                }
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $banner->image_url = "/images/".$imageName;
        }

        $banner->title = $request->title;
        $banner->link = $request->link;
        $banner->type = $request->type;
        $banner->save();

        return redirect()->route('banners.index')->with('success','Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();

        return redirect()->route('banners.index')->with('success','Banner deleted successfully.');
    }
}
