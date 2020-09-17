@extends('layout')

@section('content')
<div class="container full-height">
  <div class="row">
    <div class="col-md-6">
    <div class="p-3">
      <div class="card" style="">
        <div class="card-header">
          Your Transaction
        </div>
        <div class="card-body">
          <table class="table-sm">
            <tbody>
              <tr>
                <th scope="row">Transaction Code </th>
                <th scope="row">{{ $data->code }}</th>
              </tr>
              <tr>
                <th scope="row">Date </th>
                <th scope="row">{{ $data->date }}</th>
              </tr>
              <tr>
                <th scope="row">Costumer</th>
                <th scope="row">{{ $data->name }}</th>
              </tr>
              <tr>
                <th scope="row">Address</th>
                <th scope="row">{{ $data->address }},{{ $data->city }}</th>
              </tr>
              <tr>
                <th scope="row">Phone</th>
                <th scope="row">{{ $data->phone }}</th>
              </tr>
              <tr>
                <th scope="row">Status</th>
                <th scope="row">{{ $data->status }}</th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>
    <div class="col-md-6">
    <div class="p-3">
      <div class="card" style="">
        <div class="card-body">
          <?php $total=0 ?>
          <table class="table-sm table table-borderless" style="padding: 0">
            @foreach($product as $item)
            <?php $total += $item['price'] * $item['quantity'] ?>
            <tr>
              <td><p>{{ $item->product_name }}</p></td>
              <td class="text-left"><p>x{{ $item->quantity }}</p></td>
              <td>Rp. </td>
              <td class="text-right"><p>{{ $item->price }}</p></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td>Rp. </td>
              <td class="text-right"><p>{{ $item->price * $item->quantity}}</p></td>
            </tr>
            @endforeach
            <tr>
              <th colspan="2">Grand Total</th>
              <td>Rp. </td>
              <td class="text-right">{{ $total }}</td>
            </tr>
          </table>
          
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
@endsection