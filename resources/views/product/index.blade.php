<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{$title}}
        </h2>
    </x-slot>
    <!-- Index Post -->
    <div class="container max-w-6xl mx-auto mt-20">
        <div class="mb-4">
            @if (session()->has('message'))
            <div id="alert-1" class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                    {{ session('message') }}
                </div>
            </div>
            @endif

            <div class="flex justify-end">
                <a href="{{ route('product.create')}}" class="px-4 py-2 rounded-md bg-black text-sky-100 hover:bg-gray-600">Create {{$title}}</a>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="inline-block min-w-full overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left px-6 py-4">ID</th>
                                <th class="text-left px-6 py-4">Image</th>
                                <th class="text-left px-6 py-4">Name</th>
                                <th class="text-left px-6 py-4">Price</th>
                                <th class="text-left px-6 py-4">Created_At</th>
                                <th class="text-left px-6 py-4">Action</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                            @if($products->count() > 0)
                                @foreach ($products as $product)
                                <tr class="border-b border-gray-200">
                                    <td class="text-left px-6 py-4 whitespace-no-wrap">
                                        <div class="flex items-center">
                                            {{ $product->id }}
                                        </div>

                                    </td>
                                    <td class="text-left px-6 py-4 whitespace-no-wrap">
                                        <div class="flex items-center">
                                            <img height="70" width="70" src="{{ $product->image }}" alt="product">
                                        </div>
                                    </td>

                                    <td class="text-left px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ $product->name }}
                                        </div>
                                    </td>

                                    <td class="text-left px-6 py-4 whitespace-no-wrap">
                                        {{ $product->price }}
                                    </td>

                                    <td class="text-left px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap">
                                        <span> {{ $product->created_at }}</span>
                                    </td>

                                    <td class="flex px-6 py-4 flex-row text-right text-sm font-medium leading-5 text-center whitespace-no-wrap ">
                                        <span class="ml-2">
                                            <a href="{{ route('product.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                        </span>
                                        <span class="ml-2">
                                            <a href="{{ route('product.show', $product->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                                <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </a>
                                        </span>
                                        <span class="ml-2">
                                            <form action="{{ route('product.destroy',$product->id) }}" method="POST" onsubmit="return confirm('{{ trans('are You Sure ? ') }}');">

                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600 hover:text-red-800 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr class="border-b border-gray-200 p-3">
                                <td colspan="6" class="text-center  p-3">No Data Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <br>
                    <div class="p-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>