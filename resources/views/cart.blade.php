

@extends('layout')
@section('content')
<section>
  <div class="container full-height mobile">
    <div class="row">
      <div class="col-12">
        <div class="p-3">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <?php $total=0 ?>

                  @guest
                    @if (session('cart'))
                      @foreach (session('cart') as $id => $details)
                      
                      <?php $total += $details['price'] * $details['quantity'] ?>

                      <div class="card-body">
                        <div class="row">
                            <div class="col-3 text-center">
                            <img src="{{ $details['path'] }}" class="img-fluid pb-3" style="max-height: 200px">
                            </div>
                            <div class="col-9">
                              <h5>
                                <strong>{{ $details['product_name'] }}</strong>
                              </h5>
                              <div class="form-inline">
                                <form action="{{ route('cart.increase',['id' => $id]) }}" method="POST" class="mt-auto">
                                  @csrf
                                  @method('patch')
                                  <button class="badge badge-info">
                                    <i class="fa fa-plus"></i>
                                  </button>
                                </form>

                                <form class="col-4">
                                    <input type="number" class="col-12 form-control form-control-sm quantity" id="number" value="{{ $details['quantity'] }}">
                                </form>

                                <form action="{{ route('cart.decrease',['id' => $id]) }}" method="POST" class="mt-auto">
                                    @csrf
                                    @method('patch')
                                    <button class="badge badge-info">
                                      <i class="fa fa-minus"></i>
                                    </button>
                                </form>
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-8">
                          <h5 class="pt-2">
                            Total Harga : {{ $details['price'] * $details['quantity'] }}
                          </h5>
                        </div>
                        <div class="col-4 text-right">
                          <button class="btn btn-danger mt-auto remove-from-cart" data-id={{ $id }}>Hapus</button>
                        </div>
                      </div>
                      <hr>                          
                        </div>
                      </div>
                      @endforeach
                      </div>
                      <div class="col-12 pb-4">
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
              <div class="col-12 p-5 h-100 text-center">
                <img src="{{ ('assets/images/cart.svg') }}" style="height: 200px;
                margin-top: -3em; margin-bottom: 3em">
                <h3 class="text-center">Keranjang belanja anda kosong !</h3>
              </div>
              @endif

              @endguest
              @auth
                @if (!$products->isEmpty())
                  @foreach ($products as $id => $details)
                    @php
                      $img = \App\Product::leftJoin('images','products.id', '=','images.product_id')
                                        ->select('images.path')
                                        ->where('products.id','=',$details->product_id)
                                        ->get();
                    @endphp
                      
                    <?php $total += \App\Product::where(['id' => $details->product_id])->pluck('price')->first() * $details->quantity ?>

                    <div class="card-body">
                      <div class="row">
                        <div class="col-2 text-center">
                          <img src="{{ $img[0]['path'] }}" class="img-fluid pb-3" style="max-height: 200px">
                        </div>
                        <div class="col-8">
                          <h3>
                            <strong>{{ \App\Product::where(['id' => $details->id])->pluck('product_name')->first() }}</strong>
                          </h3>
                          <div class="form-inline">
                            <form action="{{ route('cart.increase',['id' => $details->id]) }}" method="POST" class="mt-auto">
                              @csrf
                              @method('patch')
                              <button class="btn btn-info">
                                <i class="fa fa-plus"></i>
                              </button>
                            </form>
                            <form class="col-5">
                                <input type="number" class="col-5 form-control quantity" id="number" value="{{ $details->quantity }}">
                            </form>
                            <form action="{{ route('cart.decrease',['id' => $details->id]) }}" method="POST" class="mt-auto">
                                @csrf
                                @method('patch')
                                <button class="btn btn-info">
                                  <i class="fa fa-minus"></i>
                                </button>
                            </form>
                          </div>
                          
                          <h5 class="pt-4">
                            Total Harga : {{ \App\Product::where(['id' => $details->product_id])->pluck('price')->first() * $details->quantity }}
                          </h5>
                        </div>
                        <div class="col-2 d-flex">
                          
                          <form method="POST" action="{{ route('cart.destroy',['id' => $details->product_id]) }}" class="mt-auto">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                    
                            <button class="btn btn-danger">Hapus</button>
                        </form>
                        </div>
                      </div>
                    </div>
                    <hr>
                  @endforeach
                    </div>
                    <div class="col-4">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Subtotal : {{ $total }}</h5>
                          <a href="{{ route('checkout') }}" class="btn btn-yellow btn-block">Go to Payment</a>
                        </div>
                      </div>
                    </div>
                  @else
                  </div>
                </div>
              </div>
              <div class="col-12 p-5 h-100 text-center">
                <img src="{{ ('assets/images/cart.svg') }}" style="height: 200px;
                margin-top: -3em; margin-bottom: 3em">
                <h3 class="text-center">Keranjang belanja anda kosong !</h3>
              </div>
              @endif
            @endauth
                  
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container full-height desktop">
    <div class="row">
      <div class="col-12">
        <div class="p-3">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <?php $total=0 ?>

                  @guest
                    @if (session('cart'))
                      @foreach (session('cart') as $id => $details)
                      
                      <?php $total += $details['price'] * $details['quantity'] ?>

                      <div class="card-body">
                        <div class="row">
                          <div class="col-2 text-center">
                            <img src="{{ $details['path'] }}" class="img-fluid pb-3" style="max-height: 200px">
                          </div>
                          <div class="col-8">
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
                          <div class="col-2 d-flex">
                            <button class="btn btn-danger mt-auto remove-from-cart" data-id={{ $id }}>Hapus</button>
                          </div>
                        </div>
                      </div>
                      <hr>
                      @endforeach
                      </div>
                      <div class="col-4">
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
              <div class="col-12 p-5 h-100 text-center">
                <img src="{{ ('assets/images/cart.svg') }}" style="height: 200px;
                margin-top: -3em; margin-bottom: 3em">
                <h3 class="text-center">Keranjang belanja anda kosong !</h3>
              </div>
              @endif

              @endguest
              @auth
                @if (!$products->isEmpty())
                  @foreach ($products as $id => $details)
                    @php
                      $img = \App\Product::leftJoin('images','products.id', '=','images.product_id')
                                        ->select('images.path')
                                        ->where('products.id','=',$details->product_id)
                                        ->get();
                    @endphp
                      
                    <?php $total += \App\Product::where(['id' => $details->product_id])->pluck('price')->first() * $details->quantity ?>

                    <div class="card-body">
                      <div class="row">
                        <div class="col-2 text-center">
                          <img src="{{ $img[0]['path'] }}" class="img-fluid pb-3" style="max-height: 200px">
                        </div>
                        <div class="col-8">
                          <h3>
                            <strong>{{ \App\Product::where(['id' => $details->id])->pluck('product_name')->first() }}</strong>
                          </h3>
                          <div class="form-inline">
                            <form action="{{ route('cart.increase',['id' => $details->id]) }}" method="POST" class="mt-auto">
                              @csrf
                              @method('patch')
                              <button class="btn btn-info">
                                <i class="fa fa-plus"></i>
                              </button>
                            </form>
                            <form class="col-3">
                                <input type="number" class="col-12 form-control quantity" id="number" value="{{ $details->quantity }}">
                            </form>
                            <form action="{{ route('cart.decrease',['id' => $details->id]) }}" method="POST" class="mt-auto">
                                @csrf
                                @method('patch')
                                <button class="btn btn-info">
                                  <i class="fa fa-minus"></i>
                                </button>
                            </form>
                          </div>
                          
                          <h5 class="pt-4">
                            Total Harga : {{ \App\Product::where(['id' => $details->product_id])->pluck('price')->first() * $details->quantity }}
                          </h5>
                        </div>
                        <div class="col-2 d-flex">
                          
                          <form method="POST" action="{{ route('cart.destroy',['id' => $details->product_id]) }}" class="mt-auto">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                    
                            <button class="btn btn-danger">Hapus</button>
                        </form>
                        </div>
                      </div>
                    </div>
                    <hr>
                  @endforeach
                    </div>
                    <div class="col-4">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Subtotal : {{ $total }}</h5>
                          <a href="{{ route('checkout') }}" class="btn btn-yellow btn-block">Go to Payment</a>
                        </div>
                      </div>
                    </div>
                  @else
                  </div>
                </div>
              </div>
              <div class="col-12 p-5 h-100 text-center">
                <img src="{{ ('assets/images/cart.svg') }}" style="height: 200px;
                margin-top: -3em; margin-bottom: 3em">
                <h3 class="text-center">Keranjang belanja anda kosong !</h3>
              </div>
              @endif
            @endauth
                  
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
  <script type="text/javascript">
 
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