<!DOCTYPE html>
<html lang="en">
  <!-- Design by foolishdeveloper.com -->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto slideshow</title>
    <!--Stylesheet-->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <style media="screen">
      *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #7aacff;
}

.wrapper{
    display: flex;
    animation: slide 20s infinite;
}
@keyframes slide{
    0%{
        transform: translateX(0);
    }
    25%{
        transform: translateX(0);
    }
    30%{
        transform: translateX(-100%);
    }
    50%{
        transform: translateX(-100%);
    }
    55%{
        transform: translateX(-200%);
    }
    75%{
        transform: translateX(-200%);
    }
    80%{
        transform: translateX(-300%);
    }
    100%{
        transform: translateX(-300%);
    }
}
/* img{
    width: ;
} */
    </style>
</head>
<body class="bg-blue-200">
  <div class="container mx-auto">
    <header class="z-10 sticky top-0 bg-slate-300 py-3 "> 
      <!-- header -->
      <nav class="w-9/12 flex flex-row mx-auto">
        <div class="uppercase text-lg basis-1/2"> 
          <!-- logo -->
          <a href="#hero">
            <span class="font-extrabold text-white">Nama Toko</span>
          </a>
        </div>
        <div class="basis-1/2 flex justify-end">
           
                <div class="relative scale-75">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                  </svg>
                  <span class="absolute -top-2 left-4 rounded-full bg-red-500 p-0.5 px-2 text-sm text-red-50">{{ count((array) session('cart')) }}</span>
                </div>
             
        </div>
      </nav>
    </header>

    <div class="container overflow-hidden mx-auto h-52 rounded-b-lg">
        <div class="wrapper">
            <img class="object-none object-center" src="https://i.pinimg.com/originals/2b/de/de/2bdede0647e3cdf75b44ea33723201d9.jpg">
            <img class="object-none object-bottom" src="https://images6.alphacoders.com/462/thumb-1920-462371.jpg">
            <img class="object-none object-bottom" src="https://images5.alphacoders.com/343/thumb-1920-343645.jpg">
            <img class="object-none object-bottom" src="https://cdn.wallpapersafari.com/24/98/dwMtqD.jpg">
        </div>
  </div>
  <!-- component -->

<div class='flex items-center justify-center mt-4'>
  <form action="welcome" method="POST">
  <div class="flex items-center max-w-md mx-auto bg-white rounded-lg " x-data="{ search: '' }">
      <div class="w-full">
          <input type="search" class="w-full px-4 py-1 text-gray-800 rounded-full focus:outline-none"
              placeholder="search" x-model="search" name="search">
      </div>
      <div>
          <button type="submit" class="flex items-center bg-blue-500 justify-center w-12 h-12 text-white rounded-r-lg"
              :class="(search.length > 0) ? 'bg-purple-500' : 'bg-gray-500 cursor-not-allowed'"
              :disabled="search.length == 0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
          </button>
      </div>
    </form>
  </div>
</div>

@csrf
@foreach ($menus as $menu)
<div class="container grid lg:grid-cols-3 xl:grid-cols-4 lg:gap-2 sm:grid-cols-1 ">
  <div class="mx-auto mt-11 w-80 transform overflow-hidden rounded-lg bg-white dark:bg-slate-800 shadow-md">
    <img class="h-48 w-full object-cover object-center" src="https://images.unsplash.com/photo-1674296115670-8f0e92b1fddb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="Product Image" />
    <div class="p-4" >
      <h2 class=" text-lg font-medium dark:text-white text-gray-900">{{ $menu->namaMenu }}</h2>
      <p class="mb-2 text-base dark:text-gray-300 text-gray-700">{{ $menu->category->name }}</p>
      <div class="flex items-center">
        <p class="mr-2 text-lg font-semibold text-gray-900 dark:text-white">{{ $menu->harga }}</p>
        <a href="{{ route('add_to_cart', $menu->id) }}"
        class="text-white ml-auto  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
        to cart</a>
      </div>
    </div>
 </div>
</div>
@endforeach    
</body>
</html>



