@extends('admin.adminlayout')
@section('transaction','sidebar-active')

@section('content')
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="p-3">
                    <a href="{{ route('adminproducts.create') }}" class="btn btn-primary mr-2 mb-2" >Tambah</a>
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
                                <td>{{ $d->total }}</td>
                                {{-- <td>{{ $d->account_number }}</td> --}}
                                <td>{{ $d->status }}</td>
                                <form action="{{ route('adminproducts.destroy', $d->id) }}" method="POST">
                                    <td>
                                        <a href="{{ route('adminproducts.edit', $d->id) }}" class="btn mr-2 mb-2 btn-primary">
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection