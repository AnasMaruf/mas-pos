<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;600;700&family=PT+Sans+Narrow:wght@700&family=Public+Sans:wght@300;400;700&family=Rubik:wght@300;400;600;700&display=swap"
            rel="stylesheet"
        />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css"
            rel="stylesheet"
        />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Document</title>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            blue: "#0052CC",
                            "blue-ocean": "#CFE3FD",
                            merah: "#DE350B",
                        },
                        fontFamily: {
                            rubik: ["Rubik"],
                        },
                    },
                },
            };
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <body class="pt-20">
        <!-- Tambahkan padding top pada body -->
        <nav class="fixed top-0 w-full z-10">
            <!-- Tambahkan z-10 untuk memastikan nav berada di atas elemen lain -->
            <div class="bg-blue h-20 w-full flex justify-between">
                <div class="flex">
                    <h1
                        class="text-white font-rubik font-bold px-24 py-6 text-xl"
                    >
                        MASPOS
                    </h1>
                </div>
                <div class="flex px-24">
                    <h1 class="text-white font-rubik px-2 py-6 text-xl">
                        {{ auth()->user()->username }}
                    </h1>
                    <img
                        class="h-12 mt-4"
                        src="{{ asset('img/profile.png') }}"
                        alt=""
                    />
                </div>
            </div>
        </nav>
        @yield('container')
    </body>
</html>
