@extends('layouts.mainDashboard') @section('container')
<div class="px-24 py-8">
    <div class="flex justify-between">
        <h1 class="text-3xl font-bold flex">Edit Record Transaksi</h1>
        <a
            href="/record/transaksi"
            class="flex text-white bg-blue hover:bg-blue focus:outline-none font-medium text-sm px-5 py-2.5 text-center mr-2 mb-2 rounded-sm"
            >Kembali</a
        >
    </div>
    <hr class="mb-10 border-t-4 border-solid my-4 border-black" />
    <div class="pr-96 mr-80">
        <form action="/record/transaksi/{{ $cart->id }}" method="POST">
            @method('put') @csrf
            <div class="mb-6">
                <label
                    for="transaksi_id"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Tanggal</label
                >
                <select
                    id="transaksi_id"
                    name="transaksi_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                    @foreach($transaksis as $transaksi) @if(old('transaksi_id',
                    $cart->transaksi_id) == $transaksi->id)
                    <option value="{{ $transaksi->id }}" selected>
                        {{ $transaksi->tanggal }}
                    </option>
                    @else
                    <option value="{{ $transaksi->id }}">
                        {{ $transaksi->tanggal }}
                    </option>
                    @endif @endforeach
                </select>
            </div>
            <div class="mb-6">
                <label
                    for="product_id"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Product Name</label
                >
                <select
                    id="product_id"
                    name="product_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                    @foreach($products as $product) @if(old('product_id',
                    $cart->product_id) == $product->id)
                    <option value="{{ $product->id }}" selected>
                        {{ $product->name }}
                    </option>
                    @else
                    <option value="{{ $product->id }}">
                        {{ $product->name }}
                    </option>
                    @endif @endforeach
                </select>
            </div>
            <div class="mb-6">
                <label
                    for="qty"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Quantity</label
                >
                <input
                    type="text"
                    id="qty"
                    name="qty"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ old('qty', $cart->qty) }}"
                    required
                />
            </div>
            <div class="mb-6">
                <label
                    for="subtotal"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Subtotal</label
                >
                <input
                    type="text"
                    id="subtotal"
                    name="subtotal"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ old('subtotal', $cart->subtotal) }}"
                    required
                />
            </div>
            <button
                type="submit"
                class="flex text-white bg-blue hover:bg-blue focus:outline-none focus:ring-4 focus:ring-sky-300 font-medium text-sm px-5 py-2.5 text-center mr-2 mb-2 rounded-sm"
            >
                Update
            </button>
        </form>
    </div>
</div>
@endsection
