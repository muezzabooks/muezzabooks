@extends('admin.adminlayout')
@section('product','sidebar-active')

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
                            <th scope="col">Title Book</th>
                            <th scope="col">Description</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Price</th>
                            <th scope="col" colspan="2">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $no => $p)
                            <tr>
                                <th scope="row">{{ $no + 1 }}</th>
                                <td>{{ $p->product_name }}</td>
                                <td>{{ $p->description }}</td>
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection