<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Orders') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				@if(session("message"))
				<div class="mb-4 p-6 bg-white border-b border-gray-200">
					{{session("message")}}
				</div>
				@endif
				<div class="p-6 bg-white border-b border-gray-200">
					<h2 class="mb-2 text-2xl font-bold underline">Requested Orders</h2>
					<div class="grid grid-cols-4 gap-4 mb-4">
						@if(count($requested) < 1) You don't have orders to show. @endif @foreach ($requested as $order) <div class="p-2 border border-blue-500">
							<span class="block text-xl font-bold underline">Order N° {{$order->id}}</span>
							<span class="block">Destination: {{$order->destination}}</span>
							<span class="block">Total Price: S/.{{$order->price}}</span>
							<span class="block">Status:
								@if($order->status == "delivered")
								<span class="px-2 bg-black text-green-500 font-bold">Delivered</span>
								@elseif($order->status == "canceled")
								<span class="px-2 bg-black text-red-500 font-bold">Canceled</span>
								@else
								<span class="px-2 bg-black text-yellow-500 font-bold">Pending</span>
								@endif
							</span>
					</div>
					@endforeach
				</div>
				<h2 class="mb-2 text-2xl font-bold underline">Recieved Orders</h2>
				<table class="border-collapse w-full">
					<thead>
						<tr>
							<th class="bg-black text-white">Customer</th>
							<th class="bg-black text-white">Address</th>
							<th class="bg-black text-white">Products</th>
						</tr>
					</thead>
					<tbody>
						@if($received->isEmpty())
						<tr>
							<td class="border text-center" colspan="3">
								You have not received orders</td>
						</tr>
						@endif
						@foreach ($received as $order)
						<tr>
							<td class="border border-gray-500">{{$order->user->name}}</td>
							<td class="border border-gray-500">{{$order->destination}}</td>
							<td class="border border-gray-500 text-center">
								<table class="border-collapse">
									@foreach($order->products as $product)
									@if($product->user->id == Auth::id() && !$product->pivot->delivered)
									<tr>
										<td class="p-2 border">{{$product->pivot->quantity}}</td>
										<td class="p-2 border">{{$product->name}}</td>
										<td class="p-2 border">
											<form action="/orders/deliver" method="post">
												@csrf
												@method("POST")
												<input type="hidden" name="orderId" value="{{$order->id}}">
												<input type="hidden" name="productId" value="{{$product->id}}">
												<input class="px-2 text-white bg-gray-500 rounded" type="submit" value="Send">
											</form>
										</td>
									</tr>
									@endif
									@endforeach
								</table>
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