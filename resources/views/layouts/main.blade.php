<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;600;700&family=PT+Sans+Narrow:wght@700&family=Public+Sans:wght@300;400;700&family=Rubik:wght@300;400;600;700&display=swap"
            rel="stylesheet"
        />
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            blue: "#0052CC",
                        },
                        fontFamily: {
                            rubik: ["Rubik"],
                        },
                    },
                },
            };
        </script>
        <title>Login Form</title>
    </head>
    <body>
        @yield('container')
    </body>
</html>
