<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        <span class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
            {{ auth()->user()->level }}
        </span>
      
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="/dashboard" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item {{ Request::is('dashboard') ? 'active-nav-link' : '' }}">
           
            Dashboard
        </a>
         @can('koki')
        <a href="/dashboard/pesananMasuk" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item {{ Request::is('dashboard/pesananMasuk') ? 'active-nav-link' : '' }}">
           
            Pemesanan Masuk
        </a>
        @endcan
        @can('kasir') 
        <a href="/dashboard/pemesanan" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item {{ Request::is('dashboard/pemesanan') ? 'active-nav-link' : '' }}">
          
            pemesanan
        </a>
        <a href="/dashboard/cetakNota" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item {{ Request::is('dashboard/cetakNota') ? 'active-nav-link' : '' }}">
           
            cetakNota
        </a>
        <a href="/dashboard/categories" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item {{ Request::is('dashboard/categories') ? 'active-nav-link' : '' }}">
            
            Kategori Menu
        </a>
        <a href="/dashboard/menus" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item {{ Request::is('dashboard/menus') ? 'active-nav-link' : '' }}">
           
            Menu
        </a>
         @endcan 
    </nav>
</aside>