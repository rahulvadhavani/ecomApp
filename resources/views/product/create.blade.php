<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $title ?? '-' }}
            <a href="{{route('product.index')}}" class="text-sm px-4 py-2 float-right rounded-md bg-black text-sky-100 hover:bg-gray-600">Product list</a>
        </h2>
    </x-slot>
    <div class="font-sans antialiased">
        <div class="flex flex-col items-center mt-12 pt-2 bg-gray-100 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-20 mt-1 overflow-hidden bg-white rounded-lg lg:max-w-4xl ring-1 ring-gray-300">
                <div class="">
                    <form method="POST" action="{{ route('product.index') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$product->id ?? 0}}">
                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="name"> Name</label>
                            <input required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="name" placeholder="Product name" value="{{$product->name ?? ''}}">
                            @error('name')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <!-- Price -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="name"> Price</label>
                            <input required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="number" name="price" placeholder="Product price" value="{{$product->price ?? ''}}">
                            @error('price')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <!-- Image -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="name"> Image</label>
                            <input class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="image" type="file" id="formFile">
                            @error('image')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <!-- Description -->
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700" for="description">
                                Description
                            </label>
                            <textarea required name="description" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="4" placeholder="Product description">{{$product->description ?? ''}}</textarea>
                            @error('description')
                            <span class="text-red-600 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="flex items-center justify-center mt-6">
                            <button type="submit" class="inline-flex items-center px-6 py-2 text-sm font-semibold rounded-md text-sky-100 bg-black hover:gray-400 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>