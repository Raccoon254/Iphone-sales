<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        //get all categories
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        //view to create a new category
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        //validate the data
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        //create a new category
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        //redirect to category index view with a success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get the category
        $category = Category::findOrFail($id);

        //return the category show view
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get the category
        $category = Category::findOrFail($id);

        //return the category edit view
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate the data
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        //get the category
        $category = Category::findOrFail($id);

        //update the category
        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        //redirect to category index view with a success message
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get the category
        $category = Category::findOrFail($id);

        //delete the category
        $category->delete();

        //redirect to category index view with a success message
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
