<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				@if (session("cartMessage"))
				<div class="p-6 bg-white border-b border-gray-200">
					{{ session("cartMessage")}}
				</div>
				@endif
				<div class="p-6 bg-white border-b border-gray-200">
					<h2 class="mb-4 text-2xl font-bold underline">Available Products</h2>
					<div class="grid grid-cols-4 gap-4">
						@foreach ($products as $product)
						<x-product :product="$product"></x-product>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>