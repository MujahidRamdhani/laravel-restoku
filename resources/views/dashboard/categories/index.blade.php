@extends('dashboard.layouts.main')

@section('container')
<div>
    <a href="/dashboard/categories/create" class="mb-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">Tambah kategori Menu</a>
<div>
    <h1 class="mt-4 mb-4">Kategory</h1>
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
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Nama Kategori</th>
                            <th class="py-3 px-6 text-center"></th>
                            <th class="py-3 px-6 text-center"></th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach($categories as $categori)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    {{ $loop->iteration }}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    {{ $categori->name }}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="w-32 ml-24">
                                    
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="/dashboard/categories/{{ $categori->id }}/edit" class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline mr-2">Edit</a>
                                    <form action="/dashboard/categories/{{ $categori->id }}" class="inline-block" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Are you sure to delete this Category?')" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
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