<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\menu;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = menu::all(); // Error of intelephense
        return view('dashboard.menus.index', [
            'menus' => $menus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.menus.create', [
            'categories'    => category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namaMenu' => 'required|max:255',
            'slug' => 'required',
            'category_id'   => 'required|numeric',
            'harga'   => 'required|numeric',
            'image' => 'image|file|max:5024',
        ]);

        $validatedData['image'] = $request->file('image')->store('menu-images');
        $validatedData['user_id'] = auth()->user()->id;

        menu::create($validatedData);

        return redirect()->to('/dashboard/menus')->with('success', 'New menu has been created.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(menu $menu)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(menu $menu)
    {
        return view('dashboard.menus.edit', [
            'menu'          => $menu,
            'categories'    => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, menu $menu)
    {
        $rules = [
            'namaMenu' => 'required|max:255',
            'category_id'   => 'required|numeric',
            'harga'   => 'required|numeric',
            'image' => 'image|file|max:5024',
        ];


        if ($request->slug !== $menu->slug) {
            $rules['slug'] = 'required|unique:menus';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage){
            Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('menu-images');
        }

        $validatedData['user_id'] = auth()->user()->id;

        $menu->where('id', $menu->id)->update($validatedData);
        return redirect()->to('/dashboard/menus')->with('success', 'menu has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(menu $menu)
    {
        if($menu->image) {
            Storage::delete($menu->image);
        }
        $menu->destroy($menu->id);
        return redirect()->to('/dashboard/menus')->with('success', 'menu has been deleted.');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(menu::class, 'slug', $request->namaMenu);
        return response()->json(['slug' => $slug]);
    }
}
