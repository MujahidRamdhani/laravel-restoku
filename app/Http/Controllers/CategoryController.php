<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = category::all(); 
        return view('dashboard.categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        category::create($validatedData);

        return redirect()->to('/dashboard/categories')->with('success', 'New category has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        return view('dashboard.categories.edit', [
            'category'          => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $category->where('id', $category->id)->update($validatedData);
        return redirect()->to('/dashboard/categories')->with('success', 'category has been updated.');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $category->destroy($category->id);
        return redirect()->to('/dashboard/categories')->with('success', 'category has been deleted.');
    }
}
