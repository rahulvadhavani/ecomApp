<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div>
                <li class="font-sans block mt-4 lg:inline-block lg:mt-0 lg:ml-6 align-middle text-black hover:text-gray-700">
                    <a href="{{route('cart')}}" role="button" class="relative flex">
                        <svg class="flex-1 w-8 h-8 fill-current" viewbox="0 0 24 24">
                            <path d="M17,18C15.89,18 15,18.89 15,20A2,2 0 0,0 17,22A2,2 0 0,0 19,20C19,18.89 18.1,18 17,18M1,2V4H3L6.6,11.59L5.24,14.04C5.09,14.32 5,14.65 5,15A2,2 0 0,0 7,17H19V15H7.42A0.25,0.25 0 0,1 7.17,14.75C7.17,14.7 7.18,14.66 7.2,14.63L8.1,13H15.55C16.3,13 16.96,12.58 17.3,11.97L20.88,5.5C20.95,5.34 21,5.17 21,5A1,1 0 0,0 20,4H5.21L4.27,2M7,18C5.89,18 5,18.89 5,20A2,2 0 0,0 7,22A2,2 0 0,0 9,20C9,18.89 8.1,18 7,18Z" />
                        </svg>
                        <span class="absolute right-0 top-0 rounded-full bg-red-600 w-4 h-4 top right p-0 m-0 text-white font-mono text-sm  leading-tight text-center" id="cart_counter" >{{$cartitem ?? 0}}
                        </span>
                    </a>
                </li>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-white">
                        @if($products->count() > 0)
                        <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                            @foreach($products as $product)
                            <div class="group relative bg-gray-100 py-3 px-5">
                                <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 hover:opacity-75 lg:aspect-none lg:h-80">
                                    <img src="{{$product->image}}" alt="{{$product->name}}" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                                </div>
                                <div class="mt-4 flex justify-between">
                                    <p class="mt-1 text-sm text-gray-500">{{$product->name}}</p>
                                    <p class="text-sm font-medium text-gray-900">$35</p>
                                </div>
                                <div class="mt-4 flex justify-between">
                                    <button disabled class="focus:outline-none h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-gray-600 rounded-lg">Buy</button>
                                    <button onclick="addtoCart(`{{$product->id}}`,`{{route('add_to_cart')}}`)" class="ad_to_cart h-8 px-4 m-2 text-sm text-white transition-colors duration-150 bg-black rounded-lg focus:shadow-outline hover:bg-gray-600"><i class="fa-solid fa-cart-plus"></i> Add To Cart</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <br>
                        <div class="p-4">
                            {{$products->links()}}
                        </div>
                        @else
                        <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                            <div class="group relative">
                                <div class="mt-4 flex justify-between">
                                    <div>
                                        <h3 class="text-sm text-gray-700">
                                            <a href="#">
                                                <span aria-hidden="true" class="absolute inset-0"></span>
                                                Basic Tee
                                            </a>
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500">Black</p>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900">$35</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script>
        // $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function addtoCart(id, url) {
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
                        $("#cart_counter").text(response.data.count);
                    } else {
                        toastr.error(response.message)
                    }
                },
                error: function(error) {
                    toastr.error(error.message)
                }
            });
        };
        // });
    </script>
    @endpush
</x-app-layout>