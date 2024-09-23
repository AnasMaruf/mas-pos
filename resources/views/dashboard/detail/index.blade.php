@extends('layouts.mainDashboard') @section('container')
@include('dashboard.detail.modal')

<div class="px-24 py-8">
    <div class="flex justify-between">
        <h1 class="text-3xl font-bold flex">Record Transaksi</h1>
        <a
            href="/record/transaksi"
            class="flex text-white bg-blue hover:bg-blue focus:outline-none font-medium text-sm px-5 py-2.5 text-center mr-2 mb-2 rounded-sm"
            >Kembali</a
        >
    </div>
    <hr class="mb-10 border-t-4 border-solid my-4 border-black" />
    <div class="success_message" id="success_message"></div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Product Name</th>
                    <th scope="col" class="pl-12 py-3">Quantity</th>
                    <th scope="col" class="px-6 py-3">Subtotal</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr class="font-semibold text-gray-900 dark:text-white">
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">ID</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">ID</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">ID</span>
                    </th>
                    <th scope="row" class="px-6 py-3 text-base">Total</th>
                    <td id="grandtotal" class="px-6 py-3">
                        Rp. {{ number_format($grandtotal) }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
