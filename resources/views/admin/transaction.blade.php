@extends('admin.adminlayout')
@section('transaction','active')
@section('header','Transaction')

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
        <th scope="col">Date</th>
        <th scope="col">Costumer</th>
        <th scope="col">Subtotal</th>
        <th scope="col">Status</th>
        <th scope="col" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($data as $no => $d)
        <tr>
            <th scope="row">{{ $no + 1 }}</th>
            <td>{{ $d->date }}</td>
            <td>{{ $d->user_name }}</td>
            <td>{{ $d->subtotal }}</td>
            {{-- <td>{{ $d->account_number }}</td> --}}
            <td>{{ $d->status }}</td>
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
