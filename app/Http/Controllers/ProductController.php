<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        //get all products
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public  function home(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        //get all products
        $products = Product::all();
//get the main banner;
        $mainBanner = Banner::where('type', 'main')->latest()->first();

// Get the top right banner
        $trBanner = Banner::where('type', 'top_right')->latest()->first();

        // Get the bottom right banner
        $brBanner = Banner::where('type', 'bottom_right')->latest()->first();


        return view('home', compact('products', 'mainBanner', 'trBanner', 'brBanner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        //view to create a new product
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'color' => 'required',
            'specs' => 'required|json',
            'brand' => 'required',
            'category_id' => 'required',
            'stock' => 'required',
            'sizes' => 'required|array',
            'images.*' => 'required|image'
        ]);

        //check if the exact product already exists
        $product = Product::where('name', $request->name)->where('color', $request->color)->where('specs', $request->specs)->where('brand', $request->brand)->first();

        if($product) {
            return response()->json([
                'error' => 'Product already exists.'
            ], 409);
        }

        $product = Product::create($request->except('sizes', 'images'));

        foreach ($request->sizes as $size) {
            $product->sizes()->create(['size' => $size]);
        }

        if(count($request->file('images')) < 2) {
            session()->flash('error', 'You can only upload a minimum of 2 images.');
            //delete the product
            $product->delete();
            return response()->json([
                'error' => 'You can only upload a minimum of 2 images.'
            ], 409);
        }

        if(count($request->file('images')) > 4) {
            session()->flash('error', 'You can only upload a max of 4 images.');
            //delete the product
            $product->delete();
            return response()->json([
                'error' => 'You can only upload a maximum of 4 images.'
            ], 409);
        }

        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $file)
            {
                $name = time().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/images/', $name);
                $data[] = $name;
            }
        }

        foreach ($data as $image_path) {
            $product->images()->create(['image_path' => $image_path]);
        }

        $request->session()->flash('success', 'Product creation successful 💖');

        return response()->json([
            'success' => 'Product created successfully.',
            'product' => $product
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        //get the product
        $product = Product::findOrFail($id);

        //get related products from same category or brand
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->orWhere(function ($query) use ($product) {
                $query->where('brand', $product->brand);
            })
            ->where('id', '!=', $product->id)
            ->distinct()
            ->get();

        //remove the current product from the related products
        $relatedProducts = $relatedProducts->filter(function ($value, $key) use ($product) {
            return $value->id != $product->id;
        });

        //return the product show view
        return view('products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        //
        $categories = Category::all();
        $product = Product::findOrFail($id);
        $product->specs = json_decode($product->specs, true);
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'color' => 'required',
            'specs' => 'required|json',
            'brand' => 'required',
            'category_id' => 'required',
            'stock' => 'required',
            'sizes' => 'required|array',
            'images' => 'required|array',
            'images.*' => 'file',
            'discount_percentage' => 'required|numeric'
        ]);

        $product = Product::findOrFail($id);

        $data = $request->all();
        unset($data['sizes']);
        unset($data['images']);

        $product->update($data);

        // Update sizes
        $product->sizes()->delete();
        foreach ($request->input('sizes') as $size) {
            $product->sizes()->create(['size' => $size]);
        }

        // Update images
        if ($request->hasFile('images')) {
            // Delete existing images from the database and the server
            foreach ($product->images as $image) {
                $filePath = public_path('images/' . $image->image_path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $image->delete();
            }


            // Upload new images
            $imageNames = []; // Changed from $data to $imageNames
            if($request->hasfile('images'))
            {
                foreach($request->file('images') as $file)
                {
                    $name = time().'_'.$file->getClientOriginalName();
                    $file->move(public_path().'/images/', $name);
                    $imageNames[] = $name; // Changed from $data to $imageNames
                }
            }

            foreach ($imageNames as $image_path) { // Changed from $data to $imageNames
                $product->images()->create(['image_path' => $image_path]);
            }
        }
        $request->session()->flash('success', 'Product update successful ⚡💖');
        return response()->json(['success' => 'Product updated successfully.', 'product' => $product]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        //
        $product = Product::findOrFail($id);

        // Delete images from the database and the server
        foreach ($product->images as $image) {
            $filePath = public_path('images/' . $image->image_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $image->delete();
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

}
