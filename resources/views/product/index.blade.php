<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Products') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @if(session("message"))
        <div class="p-6 bg-white border-b border-gray-200">
          {{session("message")}}
        </div>
        @endif
        <div class="p-6 bg-white border-b border-gray-200">
          <h2 class="text-2xl underline">
            My Products
            <a class="float-right p-2 bg-black text-white rounded text-base no-underline" href="/products/create">Create Product</a>
          </h2>
        </div>
        <div class="p-6">
          <table class="w-full border-collapse">
            <thead>
              <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Ordered</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $product)
              <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>
                  <img class="w-12" src="{{ asset('product_images/'.$product->image_path) }}" alt="">
                </td>
                <td>
                  {{$product->timesOrdered}}
                </td>
                <td class="text-center">
                  <form action="/products/{{$product->id}}" method="post">
                    @csrf
                    @method("DELETE")
                    <input class="px-2 text-white bg-red-500 rounded" type="submit" value="Delete Product">
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>