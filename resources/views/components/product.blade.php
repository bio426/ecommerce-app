<div class="p-4 border border-blue-500 rounded">
    <span class="block text-3xl font-bold">{{$product->name}}</span>
    <img class="w-full h-40 mb-4 object-cover" src="{{ asset('product_images/'.$product->image_path) }}" alt="">
    <div class="mb-4">
        <span>By: <span class="underline">{{$product->user->name}}</span></span>
        <span class="float-right">S/. {{$product->price}}</span>
    </div>
    <form action="/cart/add/{{$product->id}}" method="POST">
        @csrf
        @method("POST")
        <input type="submit" class="block w-full p-2 bg-black text-white rounded font-medium" value="Add to cart" />
    </form>
</div>