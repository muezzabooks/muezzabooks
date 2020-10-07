@extends('admin.adminlayout')
@section('order','active')
@section('header','Transaction')
@section('waiting','active')
@section('show','show')

@section('content')

<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">List Transaksi</h1>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <div class="text-right">
        <a href="{{ route('adminproducts.create') }}" class="btn btn-primary mr-2 mb-2" >Tambah</a>                                                
      </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Date</th>
              <th scope="col">Costumer</th>
              <th scope="col">Subtotal</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
              <th scope="col">Cetak</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $no => $d)
            <tr>
                <th scope="row">{{ $no + 1 }}</th>
                <td>{{ $d->date }}</td>
                <td>{{ $d->name }}</td>
                <td>{{ $d->total }}</td>
                {{-- <td>{{ $d->account_number }}</td> --}}
                <td><span class="badge {{ $d->status }} ">{{ $d->status }}</span></td>
                <td><a href="detailtransaction/{{ $d->id }}" class="btn btn-primary">Detail</a></td>
                <td><a href="invoice/{{ $d->id }}" class="btn btn-success">Cetak</a></td>
              </tr>
            @endforeach
            
          
        </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
@endsection
