@extends('layout')

@section('content')
<div class="container page-wrap">
    <div class="row justify-content-center p-5">
        <div class="col-md-8">
            <div class="card border-0">
                <div class="card-body">
					<div class="row">
						<div class="col-12">
							<h4 class="text-center">Cek transaksi</h4>
							<form method="GET" action="{{ route('transaction.check.search') }}">
								<div class="form-group">
									<label for="email" class="col-md-12 col-form-label">Kode Transaksi</label>

									<div class="col-md-12">
										<input id="kode" type="text" class="form-control" name="kode" required>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 offset-md-0">
										<input type="submit" class="btn btn-primary btn-block" value="Kirim">
											
									</div>
								</div>
							</form>
						</div>
					</div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection