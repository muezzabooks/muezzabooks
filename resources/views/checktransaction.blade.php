@extends('layout')

@section('content')
<div class="col-12">
	<div class="row justify-content-center">
		<div class="col-lg-8 col-sm-12 mt-4 mb-4">
			<div class="card shadow" style="height: 26rem">
				<div class="card-header bg-warning border-0">
				</div>
				<div class="card-body text-center">
					{{-- TITLE --}}
					<h2 class="card-title mt-5 font-weight-bold">Cek Transaksi</h2>
					{{-- FORM --}}
					<div class="row justify-content-center mt-4">
						<div class="col-lg-6 col-sm-12">
							<form method="GET" action="{{ route('transaction.check.search') }}">
								<div class="form-group">
									<label class="text-secondary">Masukan Kode Transaksi</label>
									<div class="col-md-12">
										@if (count($errors) > 0)
									<div class="alert alert-danger alert-dismissible">
											@foreach ($errors->all() as $error)
												{{ $error }}
											@endforeach
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
									</div>
									@endif
										<input id="kode" type="text" class="form-control" name="kode" required>
									</div>
								</div>

								<div class="form-group">
									<div class="col-12 offset-md-0">
										<input type="submit" class="btn btn-success btn-block font-weight-bold" value="Kirim">
									</div>
								</div>
							</form>
						</div>
					</div>
					{{-- FORM END --}}
				</div>
				{{-- CARD BODY END --}}
				<div class="card-header bg-warning border-0">
				</div>
			</div>
			{{-- CARD END --}}
		</div>
	</div>
</div>
@endsection