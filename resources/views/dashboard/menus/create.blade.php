

@extends('dashboard.layouts.main')

@section('container')
<h1 class="w-full text-3xl text-black pb-6">Forms Tambah menu </h1>
 <div class="flex flex-wrap justify-center">
    <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
        <div class="leading-loose">
            <form class="p-10 bg-white rounded shadow-xl" action="/dashboard/menus" method="POST" enctype="multipart/form-data"> 
                @csrf 
            <div class="">
                <label class="block text-sm text-gray-600" for="namaMenu">Nama Menu</label>
                <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="namaMenu" name="namaMenu" type="text" required="" placeholder="masukan nama makanan" aria-label="Name">
                
            </div>
            <div class="mt-4">
                <label class="block text-sm text-gray-600" for="slug">slug</label>
                <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="slug" name="slug" type="text" required="" aria-label="Name">
            </div>
             <div class="mt-4">
                <label class="block text-sm text-gray-600" for="categori">Categori Makanan</label>
                <select id="category" name="category_id" autocomplete="category-name" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded">
                    @foreach($categories as $category)
                    @if( old('category_id') == $category->id)
                    <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                    @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <label class="block text-sm text-gray-600" for="harga">Harga</label>
                <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="harga" name="harga" type="number" required="" placeholder="Masukan Harga Makanan" aria-label="Name">
            </div>
            <div class="mt-4">
            <img class=" img-preview rounded-md border border-gray-200 hidden mb-3 overflow-hidden h-72" id="img-preview" alt="">
                <label class="block text-sm text-gray-600" for="image">image</label>
                <input type="file" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="image" name="image" onchange="previewImage()">
            </div>
            
            <div class="mt-6">
                <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Simpan Menu</button>
            </div>
            
        </form>
    </div>
</div>

<script>
    const title = document.querySelector('#namaMenu');
    const slug = document.querySelector('#slug');

    title.addEventListener('change',function(){
        fetch('/dashboard/menus/checkSlug?namaMenu=' + title.value)
        .then( response => response.json() )
        .then( data=> slug.value = data.slug)
    });

    function previewImage(){
        const image =  document.querySelector('#image');
        const imgPreview =  document.querySelector('.img-preview');

        imgPreview.style.display = 'block';
        const ofReader =  new FileReader();
        ofReader.readAsDataURL(image.files[0]);

        ofReader.onload = function(oFREvent)
        {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

@endsection