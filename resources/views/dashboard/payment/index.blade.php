@extends('layouts.mainDashboard') @section('container')

<div
    href="#"
    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mx-auto my-28 text-center"
>
    <h5
        class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white text-center"
    >
        Payment Successfull
    </h5>
    <img
        class="rounded-full w-24 mx-auto mb-2"
        src="{{ asset('img/payment_successfull.jpg') }}"
        alt=""
    />
    <p class="text-center font-bold mb-4">
        Rp. {{ session()->get('subtotal') }}
    </p>
    <a
        class="border-2 border-blue p-2 mb-10 text-blue hover:bg-blue hover:text-white font-semibold"
        href="/"
        >Back to Home</a
    >
</div>

@endsection
