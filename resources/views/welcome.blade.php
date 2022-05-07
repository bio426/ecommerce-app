<x-guest-layout>
    <div class="relative">
        @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
            @endauth
        </div>
        @endif
        <div class="w-3/4 mx-auto py-16">
            <h1 class="text-4xl text-center">E-commerce App</h1>
            <h2 class="mb-4 text-2xl font-bold underline">Available Products</h2>
            <div class="grid grid-cols-4 gap-4">
                @foreach ($products as $product)
                <x-product :product="$product"></x-product>
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>