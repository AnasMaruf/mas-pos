@extends('layouts.mainDashboard')
@section('container')
<div class="flex h-screen">
  <div class="m-auto  my-28">
    <div class="max-w-lg border border-slate-200 rounded-xl mx-auto shadow-md font-rubik bg-white w-[50vw] h-[50vh]">
        <h4 class="text-center my-3 text-2xl font-semibold">Add Category</h4>
        <hr class="mx-full" />
        <form action="/dashboard/category" method="POST">
            @csrf
            <div class="login-form mx-24 mt-7">
                <label for="name" class="block mb-2 text-slate-700">Category Name</label>
                <input type="text" id="name" placeholder="Masukkan nama name" class="px-5 py-3 border shadow rounded w-full block text-sm focus:outline-none focus:ring-1 focus:ring-sky-500 peer" name="name" value="{{ old('name') }}" autofocus>
                <p class="text-sm m-1 text-red-700 invisible peer-invalid:visible">name tidak valid</p>
            </div>
            <div class="flex justify-center">
                <a href="/" class="border rounded bg-white px-10 py-2 mt-5 mr-3 text-sky-600 border-sky-500 hover:text-white hover:bg-blue active:bg-blue">Cancel</a>
                <button type="submit" class="border rounded bg-blue px-10 py-2 mt-5 text-white hover:bg-sky-600 font-rubik active:bg-sky-700">Confirm</button>
            </div>
        </form>
    </div>
    </div>
  </div>
</div>
@endsection
