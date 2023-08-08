@extends('dashboard.layouts.main')

@section('container')


<div class="col-auto">
    <h1 class="app-page-title mb-0 text-xl">pemesanan</h1>
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
                            <th class="py-3 px-6 text-left">Kode Pemesanan</th>
                            <th class="py-3 px-6 text-left">Menu</th>
                            <th class="py-3 px-6 text-center">Total Harga</th>
                            <th class="py-3 px-6 text-center">Nomor Meja</th>
                            <th class="py-3 px-6 text-center">TGL</th>
                            <th class="py-3 px-6 text-center">status</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach($pemesanans as $pemesanan)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                        {{ $pemesanan->kodePemesanan }}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <ul>
                                        @foreach($pemesanan->pemesanan_detail as $item)
                                         <li>{{ $item->menu->namaMenu }} x {{ $item->qty }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center mx-10">
                                <div class="flex items-center ml-20">
                                @currency($pemesanan->totalHarga)
                            </div>
                            </td>
                            <td class="py-3 px-6 text-center mx-10">
                                {{ $pemesanan->noMeja }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                
                                    {{ $pemesanan->created_at->format('M, d Y h:i ') }}
                                   
                                
                            </td>
                            <td class="py-3 px-6 text-center">
                                
                                  
                                    <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-base "> {{ $pemesanan->status ?? 'no course'}} </span>
                            
                            </td>
                            <td class="py-3 px-10 text-center">
                                <div class="flex item-center justify-center">
                                    <form action="{{ route('pemesananSelesai', $pemesanan->id) }}" class="inline-block" method="post">
                                        @method('post')
                                        @csrf
                                        <button class="text-sm bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">selesai</button>
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