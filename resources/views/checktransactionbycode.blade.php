@extends('layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="p-3">
        <div class="card p-3">
          <div class="card-body">
      <table class="table-sm">
          <tbody>
            <tr>
              <th scope="row">Date </th>
              <th scope="row">:</th>
              <th scope="row">{{ $data->date }}</th>
            </tr>
            <tr>
              <th scope="row">Costumer</th>
              <th scope="row">:</th>
              <th scope="row">{{ $data->name }}</th>
            </tr>
            <tr>
              <th scope="row">Address</th>
              <th scope="row">:</th>
              <th scope="row">{{ $data->address }},{{ $data->city }}</th>
            </tr>
            <tr>
              <th scope="row">Phone</th>
              <th scope="row">:</th>
              <th scope="row">{{ $data->phone }}</th>
            </tr>
            <tr>
              <th scope="row">Status</th>
              <th scope="row">:</th>
              <th scope="row">{{ $data->status }}</th>
            </tr>
          </tbody>
      </table>
      </div>
      <div class="row">
        <div class="col-md-12">
          @foreach($product as $item)
          <div class="card" style="padding: 0">
            <div class="card-body">

              <table class="table-sm table table-borderless" style="padding: 0">
                <tr>
                  <td rowspan="3"><img src="{{ $item->path }}" style="height: 75px" alt=""></td>
                </tr>
                <tr>
                  <td class="text-left"><p>{{ $item->product_name }}</p></td>
                  <td class="text-right"><p>x{{ $item->quantity }}</p></td>
                </tr>
                <tr>
                  <td></td>
                  <td class="text-right"><p>{{ $item->price }}</p></td>
                </tr>
              </table>
          </div>
          </div>
          @endforeach
        </div>
      </div>
  
  </div>
      </div>
    </div>
  </div>
</div>


@endsection