<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')
    <title>DevStagram - @yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-custom-grey">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <img class="text-3xl font-black"
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAv5JREFUaEPtmUvIDlEYx39fKbknpeSaBZKQS3KNkKxYoMSKUoqiXEKiXLKwQAmFLCwsLFAsUJRrKCJZEHLbKHItpZh/PVPH6cy839uct/f9cp7VzJk55zz/5//czkwbHVzaOrj+JADNZjAx0OoMLAS2A+OapOhT4AhwuGj/MheaCVxrkuL+tuuAgyFdygDcBia3CIBnwMh6AfxpEeVzNYLGLmMgAYjMYGIgskHrXi4xULfJIk9IDKisr/Gs2h3Y6hW8M8Ap4Jf37kpgOTAX+A3MBzYF3nkJDAOOec8qM3AHmFLgFnszhbcAX4FeNd7RGlprBKAKm8s3oKfdrAUOxQag1mKqLTrKFL1l912Bd8BbYIyNjQd6OEqsApZac7jbxj9klu5n1xeABXZ9zrmOVoml7DRvg5vAdBu7CPQHxtr9A0AgfLkOzLLB08Ayu14PHLDrLw4b0QC4DLgWGgC8B04AExwGigBIoW6Z//8EVtg8jY0GngCTgLsB4JVjoAjAIHOd48BEB4CCcLgpK2CuzMvi6XIW7EOAV8BHoK+9oKSwpxEAZJW8vXYZGJxZ8o1ZUgBkSVcUE4+8sf3ARht7DdwDlti9ziA6i/hSmYGYAB46p7yTBuAo0Bn4DnRqBIBQEGufgZaB5EJylTyIy1xI8/oAn6w2yDgvgDlZprsSUF5DlRkoAqDMo3SoIFbWqZWFcv0WA2ezo2Jv4LMN7gM2NwpAKIhdUJcsjeZ1oCwLSUe5zGpP2fvGYghDZQbKCplYUCF7XFLI8lYiV+65tQz5vZiQSxVJVADuJsrp54HZWWb5Aag/Comq7zbvgQqaCpukKH3mUyoDUJugjOFKF2ARMNQZlF8roIuaOXe+LL7LXG9DifWjBHGN9Rv+uDIDDdcwMeBZIH0XiuxzKQYiG7Tu5f4/BtTnFB3i6zZfxQk3gBmhNcq+Tqs1uFpx41jT3ZbjnzVr/eTTL6YdToscS6H2rqOOdmd2VNUHg6DUAtDejZr2XgLQNNPbxomBxEBFC/wF07GfMTVYHu8AAAAASUVORK5CYII=" />


            @auth
                <nav class="flex gap-2 items-center">
                    <a class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm
                        uppercase font-bold cursor-pointer"
                        href="{{ route('posts.create') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>

                        Create
                    </a>
                    <a href="{{ route('posts.index', auth()->user()->username) }}" class="font-bold  text-gray-600 text-sm">
                        Hola:
                        <span class="font-normal">
                            {{ Auth::user()->username }}
                        </span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm">
                            Close Session
                        </button>
                    </form>
                </nav>
            @endauth

            @guest
                <nav class="flex gap-2 items-center">
                    <a href="{{ route('login') }}" class="font-bold uppercase text-gray-600 text-sm">Login</a>
                    <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600 text-sm">
                        Register
                    </a>
                </nav>
            @endguest
        </div>
    </header>
    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('title')
        </h2>
        @yield('content')
    </main>
    <footer class="text-center p-5 text-gray-500 font-bold">
        DEVSTAGRAM - ALL RIGHTS RESERVED
        {{ now()->year }} <!-- Laravel's Helper. Obtains the year -->
    </footer>
</body>

</html>
