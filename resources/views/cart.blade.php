@extends('layout')
@section('content')
	<div class="col-12 mt-5 mb-5">
		<div class="card border-0 shadow" style="border-radius: 10px">
			<div class="card-header bg-warning" style="border-radius: 10px 10px 0px 0px;">
				<h4 class="pt-2 pl-2">
					KERANJANG BELANJA
				</h4>
			</div>
			<div class="card-body">
				<?php $subtotal = 0 ?>
				@auth
				@if (!$products->isEmpty())
				<table class="table table-borderless table-responsive">
					<thead>
						<tr class="text-secondary text-center">
							<th scope="col" colspan="2" class="text-left">Detail Produk</th>
							<th scope="col">Jumlah</th>
							<th scope="col">Harga</th>
							<th scope="col">Total</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
					@foreach ($products as $id => $details)
						<?php
							$img = \App\Product::leftJoin('images','products.id', '=','images.product_id')
                                  ->select('images.path')
                                  ->where('products.id','=',$details->product_id)
																	->get();
							$harga = \App\Product::where(['id' => $details->product_id])->pluck('price')->first();
							$total = $harga * $details->quantity;
							$subtotal += $total;
						?>
						<tr class="text-center">
							{{-- IMAGE --}}
							<td class="align-middle" style="white-space: nowrap; width: 1%;">
								<img src="{{ $img[0]['path'] }}" class="img-fluid pb-3" style="max-width: 50px">
							</td>
							{{-- PRODUCT NAME --}}
							<td class="align-middle text-left">
								<strong>{{ \App\Product::where(['id' => $details->product_id])->pluck('product_name')->first() }}</strong>
							</td>
							{{-- QUANTITY --}}
							<td class="align-middle">
								<div class="form-inline justify-content-center">
									{{-- MINUS BUTTON --}}
									<form action="{{ route('cart.decrease',['id' => $details->product_id]) }}" method="POST" class="mt-auto">
										@csrf
										@method('patch')
										<button class="text-dark btn border-0">
											<i class="fa fa-minus"></i>
										</button>
									</form>
									{{-- VALUE --}}
									<button class="btn btn-outline-dark pl-4 pr-4" disabled>{{ $details->quantity }}</button>
									{{-- PLUS BUTTON --}}
									<form action="{{ route('cart.increase',['id' => $details->product_id]) }}" method="POST" class="mt-auto">
										@csrf
										@method('patch')
										<button class="text-dark btn border-0">
											<i class="fa fa-plus"></i>
										</button>
									</form>
								</div>

							</td>
							{{-- HARGA --}}
							<td class="align-middle">
								<strong>Rp. @convert($harga)</strong>
							</td>
							{{-- TOTAL --}}
							<td class="align-middle">
								<strong>Rp. @convert($total)</strong>
							</td class="align-middle">
							{{-- HAPUS DARI CART --}}
							<td class="align-middle">
								<form method="POST" action="{{ route('cart.destroy',['id' => $details->product_id]) }}" class="mt-auto">
										@csrf
										@method('delete')
						
										<button class="btn border-0 text-danger font-weight-bold"><i class="fa fa-trash"></i> Hapus</button>
								</form>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<hr>
				<div class="col-12">
					<div class="row">
						<a href="{{ route('home') }}" class="mr-auto text-decoration-none text-secondary"><i class="fa fa-arrow-left"></i> Kembali Belanja</a>
						<h5>
							SUBTOTAL : <strong>Rp. @convert($subtotal)</strong>
						</h5>
					</div>
					<div class="row mt-2">
						<a href="{{ route('checkout') }}" class="btn btn-warning ml-auto font-weight-bold">LANJUTKAN PEMBAYARAN</a>
					</div>
				</div>
							@else
								<div class="col-12 p-5 h-100 text-center mt-4">
									<div class="row justify-content-center">
										<img src="{{ ('assets/images/cart.svg') }}" style="height: 200px;
										margin-top: -3em; margin-bottom: 3em">
										
									</div>
									<div class="row justify-content-center">
										<h3 class="text-center">Keranjang belanja anda kosong !</h3>
									</div>
								</div>
							@endif
        @endauth
        {{-- GUEST --}}
        @guest
				@if (!empty($products))
				<table class="table table-borderless table-responsive">
					<thead>
						<tr class="text-secondary text-center">
							<th scope="col" colspan="2" class="text-left">Detail Produk</th>
							<th scope="col">Jumlah</th>
							<th scope="col">Harga</th>
							<th scope="col">Total</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
					@foreach ($products as $id => $details)
						<?php
							$img = \App\Product::leftJoin('images','products.id', '=','images.product_id')
                                  ->select('images.path')
                                  ->where('products.id','=',$details['product_id'])
																	->get();
							$harga = \App\Product::where(['id' => $details['product_id']])->pluck('price')->first();
							$total = $harga * $details['quantity'];
							$subtotal += $total;
						?>
						<tr class="text-center">
							{{-- IMAGE --}}
							<td class="align-middle" style="white-space: nowrap; width: 1%;">
								<img src="{{ $img[0]['path'] }}" class="img-fluid pb-3" style="max-width: 50px">
							</td>
							{{-- PRODUCT NAME --}}
							<td class="align-middle text-left">
								<strong>{{ \App\Product::where(['id' => $details['product_id']])->pluck('product_name')->first() }}</strong>
							</td>
							{{-- QUANTITY --}}
							<td class="align-middle">
								<div class="form-inline justify-content-center">
									{{-- MINUS BUTTON --}}
									<form action="{{ route('cart.decrease',['id' => $details['product_id']]) }}" method="POST" class="mt-auto">
										@csrf
										@method('patch')
										<button class="text-dark btn border-0">
											<i class="fa fa-minus"></i>
										</button>
									</form>
									{{-- VALUE --}}
									<button class="btn btn-outline-dark pl-4 pr-4" disabled>{{ $details['quantity'] }}</button>
									{{-- PLUS BUTTON --}}
									<form action="{{ route('cart.increase',['id' => $details['product_id']]) }}" method="POST" class="mt-auto">
										@csrf
										@method('patch')
										<button class="text-dark btn border-0">
											<i class="fa fa-plus"></i>
										</button>
									</form>
								</div>

							</td>
							{{-- HARGA --}}
							<td class="align-middle">
								<strong>Rp. @convert($harga)</strong>
							</td>
							{{-- TOTAL --}}
							<td class="align-middle">
								<strong>Rp. @convert($total)</strong>
							</td class="align-middle">
							{{-- HAPUS DARI CART --}}
							<td class="align-middle">
								<form method="POST" action="{{ route('cart.destroy',['id' => $details['product_id']]) }}" class="mt-auto">
										@csrf
										@method('delete')
						
										<button class="btn border-0 text-danger font-weight-bold"><i class="fa fa-trash"></i> Hapus</button>
								</form>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<hr>
				<div class="col-12">
					<div class="row">
						<a href="{{ route('home') }}" class="mr-auto text-decoration-none text-secondary"><i class="fa fa-arrow-left"></i> Kembali Belanja</a>
						<h5>
							SUBTOTAL : <strong>Rp. @convert($subtotal)</strong>
						</h5>
					</div>
					<div class="row mt-2">
						<a href="{{ route('checkout') }}" class="btn btn-warning ml-auto font-weight-bold">LANJUTKAN PEMBAYARAN</a>
					</div>
				</div>
							@else
								<div class="col-12 p-5 h-100 text-center mt-4">
									<div class="row justify-content-center">
										<img src="{{ ('assets/images/cart.svg') }}" style="height: 200px;
										margin-top: -3em; margin-bottom: 3em">
										
									</div>
									<div class="row justify-content-center">
										<h3 class="text-center">Keranjang belanja anda kosong !</h3>
									</div>
								</div>
							@endif
			  @endguest
			</div>
		</div>
	</div>
@endsection