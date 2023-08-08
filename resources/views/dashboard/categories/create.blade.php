

@extends('dashboard.layouts.main')

@section('container')
<h1 class="w-full text-3xl text-black pb-6">Forms Tambah kategori Menu</h1>
 <div class="flex flex-wrap justify-center">
    <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
        <div class="leading-loose">
            <form class="p-10 bg-white rounded shadow-xl" action="/dashboard/categories" method="POST" enctype="multipart/form-data"> 
            @csrf 
            <div class="">
                <label class="block text-sm text-gray-600" for="name">Nama Kategori</label>
                <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name" type="text" required="" placeholder="masukan nama kategori.." aria-label="Name">      
            </div>
            <div class="mt-6">
                <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Simpan Kategori</button>
            </div>
            
        </form>
    </div>
</div>



@endsection