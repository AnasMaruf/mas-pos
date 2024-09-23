@extends('layouts.main') @section('container')
<div class="relative">
    <div class="bg-blue h-80 flex">
        <div class="flex justify-between w-full">
            <div class="flex">
                <h1
                    class="uppercase font-bold text-white text-3xl font-rubik px-20 py-10"
                >
                    mas pos
                </h1>
            </div>
            <div class="flex">
                <h4 class="text-white px-20 py-10 font-rubik">
                    Call Us +62 817-1902-092
                </h4>
            </div>
        </div>
    </div>
    <div class="bg-white h-80 flex"></div>
    <div
        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
    >
        <div
            class="max-w-lg border border-slate-200 rounded-xl mx-auto shadow-md font-rubik p-10 bg-white w-[50vw] h-[70vh]"
        >
            <h4 class="text-center mb-3 text-2xl font-semibold">Login</h4>
            <form action="/login" method="POST">
                @csrf
                <div class="login-form">
                    <label for="username" class="block mb-2 text-slate-700"
                        >Username</label
                    >
                    <input
                        type="text"
                        id="username"
                        placeholder="masukkan username"
                        class="px-4 py-3 border shadow rounded w-full block text-sm focus:outline-none focus:ring-1 focus:ring-sky-500 peer"
                        name="username"
                        value="{{ old('username') }}"
                        autofocus
                    />
                    <p
                        class="text-sm m-1 text-red-700 invisible peer-invalid:visible"
                    >
                        Username tidak valid
                    </p>
                </div>
                <div class="login-form">
                    <label for="password" class="block mb-2 text-slate-700"
                        >Password</label
                    >
                    <input
                        type="password"
                        id="password"
                        placeholder="masukkan password"
                        class="px-4 py-3 border shadow rounded w-full block text-sm focus:outline-none focus:ring-1 focus:ring-sky-500"
                        name="password"
                        value="{{ old('password') }}"
                    />
                    <p
                        class="text-sm m-1 text-red-700 invisible peer-invalid:visible"
                    >
                        Password tidak valid
                    </p>
                </div>
                <div class="flex justify-center">
                    <button
                        class="border rounded bg-blue px-10 py-2 m-auto mt-5 text-white hover:bg-sky-600 active:bg-sky-700"
                    >
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
