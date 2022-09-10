<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto mt-10">
                <div class="flex shadow-md my-10">
                    <div class="w-3/4 bg-white px-10 py-10">
                        <div class="flex justify-between border-b pb-8">
                            <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                            <h2 class="font-semibold text-2xl">{{$cartitems->count()}}</h2>
                        </div>
                        <div class="flex mt-10 mb-5">
                            <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                            <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                            <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                            <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                        </div>

                        @if($cartitems->count() > 0)
                        @foreach($cartitems as $item)
                        <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                            <div class="flex w-2/5">
                                <!-- product -->
                                <div class="w-20">
                                    <img class="h-24" src="{{$item->product->image}}" alt="">
                                </div>
                                <span class="font-bold text-sm  ml-5">{{$item->product->name}}</span>
                            </div>
                            <div class="flex justify-center w-1/5">
                                <input min="1" data-id="{{$item->id}}" data-route="{{route('update_quantity')}}" class="update-qty mx-2 form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700  bg-white bg-clip-padding
                                border border-solid border-gray-300 rounded transition  ease-in-out m-0  focus:text-gray-700 focus:bg-white focus:outline-none w-16" type="number" value="{{$item->quantity}}">
                            </div>
                            <span class="text-center w-1/5 font-semibold text-sm">${{$item->product->price}}</span>
                            <span class="text-center w-1/5 font-semibold text-sm price_data_{{$item->id}}">${{$item->product->price * $item->quantity}}</span>
                            <span class="text-center w-1/5 font-semibold text-sm">
                                <div class="cursor-pointer" onclick="removeFromCart(`{{$item->id}}`,`{{route('remove_from_cart')}}`)">
                                    <i class="fa-regular fa-circle-xmark text-lg text-red-600"></i>
                                </div>
                            </span>
                        </div>
                        @endforeach
                        @else
                        <h4 class="text-center">Cart is empty</h4>
                        @endif
                        <a href="{{route('dashboard')}}" class="flex font-semibold text-indigo-600 text-sm mt-10">

                            <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                                <path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path>
                            </svg>
                            Continue Shopping
                        </a>
                    </div>
                    <div id="summary" class="w-1/4 px-8 py-10 bg-indigo-100">
                        <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                        <div class="flex justify-between mt-10 mb-5">
                            <span class="font-semibold text-sm uppercase">Items {{$cartitems->count()}}</span>
                            <span class="font-semibold text-sm" id="total_cart_val">${{$totalcartAmount}}</span>
                        </div>
                        <div>
                            <label class="font-medium inline-block mb-3 text-sm uppercase">Shipping</label>
                            <select class="block p-2 text-gray-600 w-full text-sm">
                                <option>Standard shipping - $10.00</option>
                            </select>
                        </div>
                        <div class="py-10">
                            <label for="promo" class="font-semibold inline-block mb-3 text-sm uppercase">Promo Code</label>
                            <input type="text" id="promo" placeholder="Enter your code" class="p-2 text-sm w-full">
                        </div>
                        <button class="bg-red-500 hover:bg-red-600 px-5 py-2 text-sm text-white uppercase">Apply</button>
                        <div class="border-t mt-8">
                            <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                                <span>Total cost</span>
                                <span>$600</span>
                            </div>
                            <button class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function removeFromCart(id, url) {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        toastr.success(response.message);
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error(response.message)
                    }
                },
                error: function(error) {
                    toastr.error(error.message)
                }
            });
        };
        $(".update-qty").on('change', function() {
            quantity = $(this).val();
            id = $(this).attr('data-id');
            url = $(this).attr('data-route');
            if (quantity <= 0) {
                toastr.error("invalid quantity");
                return false;
            }
            $.ajax({
                type: "post",
                url: url,
                data: {
                    id,
                    quantity
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        toastr.success(response.message);
                        $(`#total_cart_val`).text('$' + response.data.cart_total);
                        $(`.price_data_${id}`).text('$' + response.data.price);
                    } else {
                        toastr.error(response.message)
                    }
                },
                error: function(error) {
                    toastr.error(error.message)
                }
            });

        });
        // });
    </script>
    @endpush
</x-app-layout>