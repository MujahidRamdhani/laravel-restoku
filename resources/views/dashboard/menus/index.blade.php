@extends('dashboard.layouts.main')

@section('container')
<div>
    <a href="/dashboard/menus/create" class="mb-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">Tambah Menu</a>
<div>
    <h1 class="mt-4 mb-4 text-xl">Menu</h1>
</div>
@if(session('success'))
<div class="bg-white shadow-sm p-5 border-l-4 border-green-500 mb-5">
    <span class="font-medium text-green-500 text-base">{{ session('success') }}</span>
</div>
@endif
        <div class="w-full lg:w-5/6">
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Nama Menu</th>
                            <th class="py-3 px-6 text-left">Harga</th>
                            <th class="py-3 px-6 text-center">Kategori</th>
                            <th class="py-3 px-6 text-center">Gambar</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach($menus as $menu)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                        {{ $menu->namaMenu }}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    {{ $menu->harga }}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                {{ $menu->category->name ?? " " }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class=" ml-40">
                                    <img src="{{ asset('storage/'. $menu->image) }}" alt="{{ $menu->category->name ?? "no categori"}}"  class="img-fluid mt-3 h-16 w-16">  
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="/dashboard/menus/{{ $menu->slug }}/edit" class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</a>
                                    <form action="/dashboard/menus/{{ $menu->slug }}" class="inline-block" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Are you sure to delete this menu?')" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline ml-2">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
    </div>
</div>
</div>

@endsection