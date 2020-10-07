@extends('admin.adminlayout')
@section('order','active')
@section('header','Transaction')

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Order</h1>
  <div class="card shadow mb-4">
    <div class="card-body">
<form action="{{ route('admintransaction.update',$data->id) }}" method="POST">
  @csrf
  @method('PUT')
<div class="row">
  <div class="col-md-4">
    <table class="table-sm">
        <tbody>
          <tr>
            <th scope="row">Tanggal </th>
            <th scope="row">:</th>
            <th colspan="2" class="text-left">{{ $data->date }}</th>
          </tr>
          <tr>
            <th scope="row">Kostumer</th>
            <th scope="row">:</th>
            <th colspan="2" class="text-left">{{ $data->name }}</th>
          </tr>
          <tr>
            <th scope="row">Alamat</th>
            <th scope="row">:</th>
            <th colspan="2" class="text-left">{{ $data->address }},{{ $data->city }}</th>
          </tr>
          <tr>
            <th scope="row">Telepon</th>
            <th scope="row">:</th>
            <th colspan="2" class="text-left">{{ $data->phone }}</th>
          </tr>
          <tr>
            <th scope="row">No Resi</th>
            <th scope="row">:</th>
            <th colspan="2" class="text-left"><input type="text" name="resi" value="{{ $data->no_resi }}"></th>
          </tr>
          <tr>
            <th scope="row">Status</th>
            <th scope="row">:</th>
            <th colspan="2" class="text-left">
            <select name="status" id="" style="width: 100%">
                <option value="waiting" {{ $data->status == 'waiting'? 'selected' : '' }}>waiting</option>
                <option value="processing" {{ $data->status == 'processing'? 'selected' : '' }}>processing</option>
                <option value="confirmed" {{ $data->status == 'confirmed'? 'selected' : '' }}>confirmed</option>
                <option value="delivered" {{ $data->status == 'delivered'? 'selected' : '' }}>delivered</option>
                <option value="closed" {{ $data->status == 'closed'? 'closed' : '' }}>closed</option>
            </select></th>
          </tr>
          <tr>
            <th scope="row" colspan="2">Bukti Pembayaran</th>
            <th colspan="2" class="text-left"><a href="{{ $data->path }}" target="_blank">
              <img src="{{ $data->path }}" style="height: 100px"></a></th>
          </tr>
          <tr>
           
          </tr>
        </tbody>
    </table>
  </div>
    <div class="col-md-2"></div>
    <div class="col-md-6">
        <table class="table table-sm table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Title Books</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
                <tbody>
                @foreach ($product as $no => $item)             
                <tr>
                    <td>{{ $no+1 }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price * $item->quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p>Total : {{ $data->total }}</p>
    </div>

</div>
<div class="row">
 <div class="col-md-12 text-right">
    <a href="{{ route('transaction') }}" class="btn btn-secondary">back</a>
    <button type="submit" class="btn btn-primary">Submit</button>
 </div>
</div>
</form>
    </div>
    </div>
</div>
@endsection
