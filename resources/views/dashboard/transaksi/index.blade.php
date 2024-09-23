@extends('layouts.mainDashboard') @section('container')
<div class="px-24 py-8">
    @if(session()->has('success'))
    <div
        class="flex p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
        role="alert"
    >
        <svg
            aria-hidden="true"
            class="flex-shrink-0 inline w-5 h-5 mr-3"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"
            ></path>
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">Success alert!</span>
            {{ session("success") }}
        </div>
    </div>
    @endif
    <div class="flex justify-between">
        <h1 class="text-3xl font-bold flex">Record Transaksi</h1>
        <a
            href="/"
            class="flex text-white bg-blue hover:bg-blue focus:outline-none font-medium text-sm px-5 py-2.5 text-center mr-2 mb-2 rounded-sm"
            >Kembali</a
        >
    </div>
    <hr class="mb-10 border-t-4 border-solid my-4 border-black" />
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Tanggal</th>
                    <th scope="col" class="px-6 py-3">Grandtotal</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $transaksi)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                >
                    <th
                        scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                        {{ $i++ }}
                    </th>
                    <th
                        scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                        {{ $transaksi->created_at }}
                    </th>
                    <td class="px-6 py-4">
                        {{ number_format($transaksi->grandtotal) }}
                    </td>
                    <td class="px-6 py-4">
                        <a
                            href="/record/transaksi/{{ $transaksi->id }}"
                            class="text-white bg-sky-300 hover:bg-blue focus:outline-none font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-900"
                            >Detail</a
                        >
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-right">
            {{  $transaksis->links()  }}
        </div>
    </div>
</div>
@endsection
