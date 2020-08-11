@extends('admin.adminlayout')

@section('content')
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="p-3">
                    <button type="button" class="btn btn-primary mr-2 mb-2" data-toggle="modal" data-target="#exampleModal" >Tambah</button>
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
                                <td>
                                    <a href="/paket/edit/{{ $p->id }}" class="btn mr-2 mb-2 btn-primary">
                                        <i class="fa fa-fw" aria-hidden="true"></i></a>
                                    </td>
                                    <td>                                        
                                    <a href="/paket/delete/{{ $p->id }}" class="btn mr-2 mb-2 btn-danger" onClick="return confirm('Are you sure you want to delete?')">
                                        <i class="fa fa-fw" aria-hidden="true"></i></a>
                                </td>
                              </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ url('/adminproduct') }}" method="POST">

            @csrf
            <div class="form-group">
              <label for="title" class="col-form-label">Title Book:</label>
              <input type="text" class="form-control" id="title" name="product_name">
            </div>
            <div class="form-group">
              <label for="desc" class="col-form-label">Description:</label>
              <textarea class="form-control" id="desc" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="stock" class="col-form-label">Stock</label>
                <input type="text" class="form-control" id="stock" name="stock">
              </div>
              <div class="form-group">
                <label for="price" class="col-form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price">
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Send message</button></form>
        </div>
      </div>
    </div>
  </div>
@endsection