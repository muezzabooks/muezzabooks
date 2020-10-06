@extends('auth.layoutauth')
@section('content')

<style>
html{
    margin: 0;
    background-color: white !important ;
}

.header{
    padding-top: 2em;
    margin-bottom: 2em;
    min-width: 100%;
    text-align: center;
}
.img-header{
    height: 75px;
}
</style>
<div class="shadow-sm p-2 mb-2 bg-white">

    <div class="header">
        <img class="img-header" src="{{ ('/assets/images/logo-muezza.png') }}" >
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="right">
                    <table class="table table-borderless table-sm">
                        <thead>
                          <tr>
                            <th scope="col">Tanggal</th>
                            <td>{{ $data->date }}</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th>Kode Invoice</th>
                            <td>{{ $data->code }}</td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-8">
                <div class="left text-right">
                    <table class="table table-borderless table-sm">
                        <tbody>
                          <tr>
                            <th>{{ $data->name }}</th>
                          </tr>
                          <tr>
                            <td>{{ $data->address }}, {{ $data->city }}</td>
                          </tr>
                          <tr>
                            <td>{{ $data->phone }}</td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                      <tr class="table-active">
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>Rp. {{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp. {{ $item->price * $item->quantity }}</td>
                        </tr>
                        @endforeach                     
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Subtotal</td>
                            <td>Rp. {{ $data->total - $data->shipping_cost }}</td>
                        </tr>
                    </tfoot>
                  </table>                  
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="card shadow-sm p-2 mb-2 bg-white rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p>Sicepat - SiUntung </p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p>Rp. {{ $data->shipping_cost }}</p>
                            </div>
                        </div>
                     <hr>
                    </div>
                  </div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="card shadow-sm p-2 mb-5 bg-white rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Grand Total</strong> </p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p>Rp. {{ $data->total }} </p>
                            </div>
                        </div>
                     <hr>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
    
    @endsection