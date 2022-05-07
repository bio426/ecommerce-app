<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('My cart') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h2 class="mb-4 text-2xl font-bold underline">Cart Items</h2>
          <table class="w-full mb-4 border-collapse">
            <thead class="bg-black">
              <tr class="text-white">
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($items as $item)
              <tr>
                <td class="p-2 border border-gray-300 text-center">{{$item->name}}</td>
                <td class="p-2 border border-gray-300 text-center">S/. {{$item->price}}</td>
                <td class="p-2 border border-gray-300 text-center">
                  <img class="block w-40" src="{{  asset('product_images/'.$item->image_path)  }}" alt="">
                </td>
                <td class="p-2 border border-gray-300 text-center">{{$item->quantity}}</td>
                <td class="p-2 border border-gray-300 text-center">
                  <form action="/cart/{{ $item->id }}" method="post">
                    @csrf
                    @method("DELETE")
                    <input class="p-2 bg-black text-white" type="submit" value="Delete">
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4">No items in cart.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
          <form action="/cart" method="POST">
            @csrf
            @method("DELETE")
            <input class="p-2 bg-black text-white rounded" type="submit" value="Clear cart">
          </form>
          <form action="/orders/create" method="post">
            @csrf
            @method("POST")
            <label class="block mb-2">
              Destination
              <input class="block mt-2" type="text" name="destination">
            </label>
            @error("destination")
            <span class="block text-red-500 font-black">{{$message}}</span>
            @enderror
            @error("cart")
            <span class="block text-red-500 font-black">{{$message}}</span>
            @enderror
            <input class="mt-4 p-2 bg-black text-white rounded" type="submit" value="Send Order">
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>