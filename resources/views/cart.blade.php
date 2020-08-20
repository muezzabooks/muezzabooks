

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
                          <img src="{{ $details['path'] }}" class="img-fluid pb-3" style="max-height: 200px">
                        </div>
                        <div class="col-md-8">
                          <h3>
                            <strong>{{ $details['product_name'] }}</strong>
                          </h3>
                          <div class="form-inline">
                            <form action="{{ route('cart.increase',['id' => $id]) }}" method="POST" class="mt-auto">
                              @csrf
                              @method('patch')
                              <button class="btn btn-info">
                                <i class="fa fa-plus"></i>
                              </button>
                            </form>

                            <form class="col-3">
                                <input type="number" class="col-12 form-control quantity" id="number" value="{{ $details['quantity'] }}">
                            </form>

                            <form action="{{ route('cart.decrease',['id' => $id]) }}" method="POST" class="mt-auto">
                                @csrf
                                @method('patch')
                                <button class="btn btn-info">
                                  <i class="fa fa-minus"></i>
                                </button>
                            </form>
                          </div>
                          
                          <h5 class="pt-4">
                            Total Harga : {{ $details['price'] * $details['quantity'] }}
                          </h5>

                        </div>
                        <div class="col-md-2 d-flex">
                          <button class="btn btn-danger mt-auto remove-from-cart" data-id={{ $id }}>Hapus</button>
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
                </div>
              </div>
            </div>
            <div class="col-12 p-5 h-100">
              <h1 class="text-center">Keranjang belanja anda kosong !</h1>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
  <script type="text/javascript">
 
      // $(".update-cart").click(function (e) {
      //   e.preventDefault();
 
      //   var ele = $(this);
        
      //   if(confirm("Are you sure")) {
      //     $.ajax({
      //        url: '{{ url('update-cart') }}',
      //        method: "patch",
      //        data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("input").find(".quantity").val()},
      //        success: function (response) {
      //            window.location.reload();
      //        }
      //     });
      //   }
      // });
 
      $(".remove-from-cart").click(function (e) {
          e.preventDefault();
 
          var ele = $(this);
 
          if(confirm("Are you sure")) {
              $.ajax({
                  url: '{{ route("cart.destroy") }}',
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