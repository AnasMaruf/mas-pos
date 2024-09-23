@extends('layouts.mainDashboard') @section('container')
<div
    class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-auto my-9 items-center font-rubik px-auto relative w-[58vw]"
>
    <h1 class="px-16 text-xl py-4 font-bold">Add Product</h1>
    <hr class="max-w-full" />
    <div href="#" class="flex mx-auto items-center md:flex-row">
        <form
            action="/dashboard/products"
            method="POST"
            enctype="multipart/form-data"
            class="flex justify-between w-full"
        >
            @csrf
            <div class="flex items-center justify-center w-full">
                <label
                    for="image"
                    class="flex flex-col items-center justify-center mb-16 w-[22vw] h-[22vw] border-2 border-blue-ocean cursor-pointer bg-blue-ocean dark:bg-gray-700 hover:bg-sky-200 dark:border-gray-600 dark:hover:border-gray-500"
                >
                    <div
                        class="relative w-full h-full flex flex-col items-center justify-center"
                    >
                        <!-- Gambar default yang tetap berada di tengah -->
                        <img
                            class="preview_image w-16 h-16 object-contain"
                            src="{{ asset('img/cloud_up.png') }}"
                            alt="Upload Icon"
                        />
                        <p id="upload_text" class="text-blue mt-2 text-center">
                            Upload Image
                        </p>
                        <!-- Gambar preview yang menutupi seluruh area label -->
                        <img
                            class="img-preview absolute top-0 left-0 w-full h-full object-cover hidden"
                        />
                    </div>
                    <input
                        id="image"
                        type="file"
                        class="hidden"
                        accept="image/*"
                        name="image"
                        onchange="previewImage()"
                    />
                </label>
            </div>

            <div class="flex m-5 flex-col leading-normal">
                <div class="login-form mx-auto">
                    <label
                        for="name"
                        class="block mb-1 text-slate-700 font-reguler text-sm"
                        >Product Name</label
                    >
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Name Product"
                        class="px-2 py-3 border shadow rounded w-[22vw] block text-sm focus:outline-none focus:ring-1 focus:ring-sky-500 peer"
                        name="name"
                        value="{{ old('name') }}"
                        autofocus
                    />
                    <p
                        class="text-sm m-1 text-red-700 invisible peer-invalid:visible"
                    >
                        Username tidak valid
                    </p>
                </div>

                <div class="login-form m-auto">
                    <label
                        for="price"
                        class="block mb-1 text-slate-700 font-reguler text-sm"
                        >Price</label
                    >
                    <input
                        type="number"
                        id="price"
                        placeholder="Input Price"
                        class="px-2 py-3 border shadow rounded w-[22vw] block text-sm focus:outline-none focus:ring-1 focus:ring-sky-500 peer"
                        name="price"
                        value="{{ old('price') }}"
                        autofocus
                    />
                    <p
                        class="text-sm m-1 text-red-700 invisible peer-invalid:visible"
                    >
                        Username tidak valid
                    </p>
                </div>

                <div class="login-form m-auto">
                    <label
                        for="select"
                        class="block mb-1 text-slate-700 font-reguler text-sm"
                        >Select Category</label
                    >
                    <select
                        type="text"
                        id="category_id"
                        class="px-2 py-3 border shadow rounded w-[22vw] block text-sm focus:outline-none focus:ring-1 focus:ring-sky-500 peer text-[#7A869A]"
                        name="category_id"
                    >
                        @foreach($categories as $category)
                        @if(old('category_id') == $category->id)
                        <option value="{{ $category->id }}" selected>
                            {{ $category->name }}
                        </option>
                        @else
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                        @endif @endforeach
                    </select>
                    <p
                        class="text-sm m-1 text-red-700 invisible peer-invalid:visible"
                    >
                        Username tidak valid
                    </p>
                </div>

                <div
                    class="flex items-end justify-end gap-x-2 lg:justify-end font-[rubik]"
                >
                    <a
                        href="/"
                        class="text-[#0052CC] hover:text-white border border-[#0052CC] hover:bg-[#0052CC] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-medium px-7 py-2 text-center dark:border-[#0052CC] dark:text-blue-700 dark:hover:text-white dark:hover:bg-blue-700 dark:focus:ring-blue-700"
                        >Cancel</a
                    >

                    <button
                        type="submit"
                        class="text-white bg-[#0052CC] border border-[#0052CC] hover:bg-[#0052CC] focus:ring-4 focus:ring-blue-300 font-medium rounded text-medium px-7 py-2 dark:bg-[#0052CC] dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-700"
                    >
                        Confirm
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector("#image");
            const imgPreview = document.querySelector(".img-preview");
            const previewImageIcon = document.querySelector(".preview_image");
            const uploadText = document.querySelector("#upload_text");

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function (oFREvent) {
                imgPreview.src = oFREvent.target.result;
                imgPreview.classList.remove("hidden"); // Tampilkan preview gambar
                previewImageIcon.style.display = "none"; // Sembunyikan ikon default
                uploadText.style.display = "none"; // Sembunyikan teks "Upload Image"
            };
        }
    </script>
</div>
@endsection
