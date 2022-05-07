<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Create Product') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h2 class="text-2xl underline">
            My Products
            <a class="float-right p-2 bg-black text-white rounded text-base no-underline" href="/products">Back</a>
          </h2>
        </div>
        <form class="flex flex-col items-center gap-4 p-6" action="/products/create" method="POST" enctype="multipart/form-data">
          @csrf
          @method("POST")
          <label class="block">
            Name
            <input class="block mt-2" type="text" name="name">
          </label>
          <label class="block">
            Price
            <input class="block mt-2" type="number" name="price">
          </label>
          <label class="block">
            Image
            <input class="block mt-2" type="file" name="image">
          </label>
          <input class="block p-2 bg-black text-white font-bold" type="submit" value="Create">
        </form>
      </div>
    </div>
  </div>
</x-app-layout>