<h1 class="w-full text-3xl text-black pb-6">Forms Tambah menu </h1>

<div class="flex flex-wrap justify-center">
    <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
        <div class="leading-loose">
            <form class="p-10 bg-white rounded shadow-xl" action="/dashboard/menus" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="">
                    <label class="block text-sm text-gray-600" for="title">Nama makanan</label>
                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="title" name="title" type="text" required="" placeholder="masukan nama makanan" aria-label="Name">
                    @error('title')<small class="text-red-600 font-medium block my-2">{{ $message }}</small>@enderror
                </div>
                <div class="mt-4">
                    <label class="block text-sm text-gray-600" for="slug">slug</label>
                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="slug" name="name" type="text" required="" aria-label="Name">
                </div>
                 <div class="mt-4">
                    <label class="block text-sm text-gray-600" for="categori">Categori Makanan</label>
                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="categori" name="categori" type="text" required="" placeholder="masukan nama makanan" aria-label="Name">
                </div>
                <div class="mt-4">
                    <label class="block text-sm text-gray-600" for="harga">Harga</label>
                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="harga" name="harga" type="number" required="" placeholder="Masukan Harga Makanan" aria-label="Name">
                </div>
                <div class="mt-4">
                <img class="rounded-md border border-gray-200 hidden mb-3 overflow-hidden" id="img-preview" alt="">
                    <label class="block text-sm text-gray-600" for="image">image</label>
                    <input type="file" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="image" name="image"  required="">
                </div>
                
                <div class="mt-6">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Simpan Menu</button>
                </div>
                
            </form>
        </div>
    </div>

    
</div>