<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body>
    

    <div class="min-w-screen min-h-screen bg-gray-100 flex  justify-center font-sans">
        <div class="w-full lg:w-5/6">
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Menu</th>
                            <th class="py-3 px-6 text-left">Harga</th>
                            <th class="py-3 px-6 text-center">Quantity</th>
                            <th class="py-3 px-6 text-center">Subtotal</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    @php $total = 0 @endphp
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['harga'] * $details['quantity'] @endphp

                    <tbody class="text-gray-600 text-sm font-light">
                        <tr class="border-b border-gray-200 hover:bg-gray-100" data-id="{{ $id }}">
                            <td class="py-3 px-6 text-left whitespace-nowrap" data-th="menu">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img  src="{{ asset('storage/'.$details['image'] ) }}" width="75px" height="75px" class="img-responsive"/>
                                    </div>
                                    <span class="font-medium">{{ $details['namaMenu'] }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left" data-th="harga">
                                <div class="flex items-center">
                                    @currency($details['harga'] )
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center" data-th="Quantity">
                                <div class="flex items-center justify-center">
                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update w-20" min="1" />
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">@currency($details['harga'] * $details['quantity'])</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button class="cart_remove">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                           
                                            </svg>
                                      
                                    </div>
                                </button>
                                </div>
                            </td>
                        </tr>
                        
                    </tbody>
                    @endforeach
                    @endif
                    <tfoot> 
                        <div class="container">
                        <tr class="mb-10 mt-10">
                            <td colspan="5" class="text-right"><h3><strong>Total @currency( $total )</strong></h3></td>
                        </tr>
                        <tr>
                            <td  colspan="5" class="text-right align-center">
                                <form action="/session" method="POST">
                                    <div class="relative inline-flex ">
                                  <!-- This is an example component -->
                                        <select name="noMeja" class="border border-gray-300 rounded-full text-gray-600 h-10 pl-2 pr-2 bg-white hover:border-gray-400 focus:outline-none appearance-none justify-center text-center" required>
                                        <option disabled selected value>Pilih No Meja</option>
                                        <option value="Meja 1">Meja 1</option>
                                        <option value="Meja 2">Meja 2</option>
                                        <option value="Meja 3">Meja 3</option>
                                        <option value="Meja 4">Meja 3</option>
                                        <option value="Meja 5">Meja 5</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="total" value="{{  }}">
                                    <a href="{{ url('/') }}" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded border-transparent focus:border-transparent focus:ring-0 focus:shadow-outline"> <i class="fa fa-arrow-left"></i> Continue Shopping</a>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <button class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:shadow-outline focus:outline-none" type="submit" id="checkout-live-button"><i class="fa fa-money"></i> Checkout</button>
                                </div>
                                </form>
                            </td>
                        </tr>
                    </div>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div> 
@endif








@section('scripts')
<script type="text/javascript">
   
    $(".cart_update").change(function (e) {
        e.preventDefault();
   
        var ele = $(this);
        
   
        $.ajax({
            url: '{{ route('update_cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
   
    $(".cart_remove").click(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        if(confirm("Do you really want to remove?")) {
            $.ajax({
                url: '{{ route('remove_from_cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
   
</script>
</body>
</html>




