@extends('layouts.mainDashboard')

@section('container')
    <div>
        <div class="float-right px-24 py-5 mt-5">
            <a class="px-3 py-3 bg-blue-ocean m-1 font-semibold text-blue rounded-md hover:bg-blue hover:text-white" href="/dashboard/category">
                +Add Category
            </a>
            <a class="px-3 py-3 bg-blue-ocean m-1 font-semibold text-blue rounded-md hover:bg-blue hover:text-white" href="/dashboard/products">
                +Add Products
            </a>
            <a class="font-semibold px-6 py-3 bg-blue hover:bg-blue-900 text-white rounded-sm mr-2" href="/cart">
                Cart
            </a>
            <a class="font-semibold px-6 py-3 bg-blue hover:bg-blue-900 text-white rounded-sm" href="/record/transaksi">
                Transaksi
            </a>
        </div>
    </div>

    <div class="border-b border-gray-200 mx-24 mt-16">
        <div class="overflow-x-auto w-full">
            <ul class="flex flex-nowrap text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                <li class="mr-2">
                    <a href="/" class="inline-flex p-4 border-b-2 text-sm rounded-t-lg hover:text-blue hover:border-blue {{ request()->is('/') ? 'visited:text-blue border-blue' : '' }}">
                        All Products
                    </a>
                </li>
                @foreach($categories as $category)
                    <li class="mr-2">
                        <a href="/categories/{{ $category->id }}" class="inline-flex p-4 border-b-2 text-sm rounded-t-lg hover:text-blue hover:border-blue {{ Request::is("categories/$category->id") ? 'visited:text-blue border-blue' : '' }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="mx-24">
        <div class="grid grid-cols-5 gap-5">
            @foreach($products as $product => $val)
                <?php $subtotal = $val['price'] * $val['qty']; ?>
                <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mt-7 flex flex-col">
                    <a href="#">
                        <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset('storage/'.$val['image']) }}" alt="{{ $val['name'] }}" />
                    </a>
                    <div class="p-4 flex flex-col flex-grow">
                        <div class="flex justify-between items-center">
                            <h5 class="text-sm font-normal tracking-tight text-gray-900 dark:text-white">{{ $val['name'] }}</h5>
                            <form action="/dashboard/products/{{ $val['id'] }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="focus:outline-none text-white bg-merah hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium text-sm px-1 rounded-md">
                                    Delete
                                </button>
                            </form>
                        </div>
                        <p class="mt-2 mb-5 font-bold text-gray-700 dark:text-gray-400">Rp. {{ number_format($val['price']) }}</p>
                    </div>
                    <div class="p-4 flex justify-center">
                        <a href="/cart/tambah/{{ $val['id'] }}" class="text-white bg-blue hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-6 py-2 w-full focus:outline-none dark:focus:ring-blue-800 rounded-md text-center">
                            + Add to Cart
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <a class="float-right bg-blue text-white px-3 py-2 mt-5 mb-5 rounded-md fixed bottom-0 right-24" href="/cart">
            Total Bill: Rp. {{ $grandtotal }}
        </a>
    </div>


@endsection
