

@extends('layout')
@section('content')
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="p-3">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <?php $total=0 ?>

                  @if (session('cart'))
                    @foreach (session('cart') as $id => $details)
                    
                    <?php $total += $details['price'] * $details['quantity'] ?>

                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-2 text-center">
                          <img src="{{ ('assets/images/cover-book.jpg') }}" class="img-fluid pb-3" style="max-height: 200px">
                        </div>
                        <div class="col-md-8">
                          <h4>{{ $details['product_name'] }}</h4>
                          <form>
                            <div class="form-group">
                              <input type="number" class="form-control" id="number" value="{{ $details['quantity'] }}" min="1">
                            </div>
                          </form>
                          <p>Total Harga : {{ $details['price'] }}</p>
                        </div>
                        <div class="col-md-2 d-flex">
                          {{-- <button class="btn btn-danger mt-auto remove-from-cart" data-id={{ $id }}>Hapus</button> --}}
                          {{-- <a href="{{ route('cart.destroy',['id' => $id]) }}" class="btn btn-danger mt-auto">Hapus</a> --}}
                          <form action="{{ route('cart.destroy',['id' => $id]) }}" method="POST" class="mt-auto">
                              @csrf
                              @method('delete')
                              <button class="btn btn-danger">Hapus</button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <hr>

                    @endforeach
                    </div>
                    <div class="col-md-4">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Subtotal : {{ $total }}</h5>
                          <a href="checkout" class="btn btn-yellow btn-block">Go to Payment</a>
                        </div>
                      </div>
                    </div>
                  @else
                  <div class="col-12">
                    <h1>Keranjang belanja anda kosong !</h1>
                  </div>
                  @endif
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
  <script type="text/javascript">
 
      $(".update-cart").click(function (e) {
         e.preventDefault();
 
         var ele = $(this);
 
          $.ajax({
             url: '{{ url('update-cart') }}',
             method: "patch",
             data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
             success: function (response) {
                 window.location.reload();
             }
          });
      });
 
      $(".remove-from-cart").click(function (e) {
          e.preventDefault();
 
          var ele = $(this);
 
          if(confirm("Are you sure")) {
              $.ajax({
                  url: '',
                  method: "DELETE",
                  data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                  success: function (response) {
                      window.location.reload();
                  }
              });
          }
      });
 
  </script>
@endsection