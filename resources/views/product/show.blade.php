<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $title ?? '-' }}
            <a href="{{route('product.index')}}" class="text-sm px-4 py-2 float-right rounded-md bg-black text-sky-100 hover:bg-gray-600">Product list</a>
        </h2>
    </x-slot>
    <div class="font-sans antialiased">
        <div class="flex flex-col items-center mt-12 pt-2 bg-gray-100 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-12 mt-1 overflow-hidden bg-white rounded-lg lg:max-w-4xl ring-1 ring-gray-300">
                <div class="grid grid-rows-2 grid-flow-col gap-4">
                    <div class="row-span-2">
                        <div class="rounded overflow-hidden shadow-lg">
                            <div class="px-6 py-4">
                                <img class="w-full" src="{{$product->image}}" alt="Sunset in the mountains">
                                <div class="px-6 py-4">
                                <div class="mb-2"><span class="font-bold">Title : </span> {{$product->name}}</div>
                                <div class="mb-2"><span class="font-bold">Price : </span> {{$product->price}}</div>
                                <div class="mb-2"><span class="font-bold">Created Date : </span> {{$product->created_at}}</div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-span-2">
                        <div class="rounded overflow-hidden shadow-lg">
                            <div class="px-6 py-4">
                                <div class="mb-2"><span class="font-bold">Description : </span> <br> {{$product->description}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>