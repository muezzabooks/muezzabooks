@extends('admin.adminlayout')
@section('product','active')
@section('header','Products')

@section('content')
<div class="row">
    <div class="col-md-6">
       </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('adminproducts.create') }}" class="btn btn-primary mr-2 mb-2" >Tambah</a>                                               
    </div>
</div>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Cover</th>
        <th scope="col">Judul Buku</th>
        <th scope="col">Author</th>
        <th scope="col">Stok</th>
        <th scope="col">Harga</th>
        <th scope="col" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($products as $no => $p)
        <tr>
            <th scope="row">{{ $no + 1 }}</th>
            <td><img src="{{ $p->path }}" height="30" alt=""></td>
            {{-- <td>{{ $p->name }}</td> --}}
            <td>{{ $p->product_name }}</td>
            <td>{{ $p->author }}</td>
            <td>{{ $p->stock }}</td>
            <td>{{ $p->price }}</td>
            <form action="{{ route('adminproducts.destroy', $p->id) }}" method="POST">
                <td>
                    <a href="{{ route('adminproducts.edit', $p->id) }}" class="btn mr-2 mb-2 btn-primary">
                        <i class="fa fa-fw" aria-hidden="true"></i></a>
                </td>                                     
                @csrf

                @method('DELETE')
                    <td>
                <button type="submit" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-fw" aria-hidden="true"></i></button>
                    </td>
            </form>
          </tr>
        @endforeach
        
      
    </tbody>
</table>
@endsection
