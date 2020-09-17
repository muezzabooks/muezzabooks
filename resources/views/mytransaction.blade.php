@extends('layout')

@section('content')
<div class="container full-height">
  <div class="row">
    <div class="col-md-12">
      <div class="p-3">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="container">
                  <br>

                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#belumbayar">Belum Bayar</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#proses">Proses</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#dikirim">Sedang Dikirim</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#selesai">Selesai</a>
                      </li>
                  </ul>       

                  <div class="tab-content">
                    <div id="belumbayar" class="container tab-pane active"><br>
                      @foreach ($data as $item)
                      @if($item->status == "waiting")
                        <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-md-6">
                              <p class="text-left">{{ $item->date }}</p>
                            </div>
                            <div class="col-md-6">
                              <p class="text-right">{{ $item->code }}</p>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">	
                          <?php $total = 0 ?>
                          <table class="table table-sm table-borderless">
                        @foreach($detail as $no => $d)
                      @if($d->code == $item->code)
                          
                            <tr>
                              <td rowspan="2"><img src="{{ $d->path }}" style="height: 5em" alt=""></td>
                              <td>{{ $d->product_name }}</td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>x{{ $d->quantity }}</td>
                              <td>Rp. {{ $d->price }}</td>
                            </tr>
                            <?php $total += $d['price'] * $d['quantity'] ?>
                          
                          @endif
                      @endforeach
                    </table>
                        </div>
                        <div class="card-header">
                         <p class="text-right">Total : Rp. {{ $total }}</p>
                          </div>
                        </div>
                        
                        <br>
                        @endif
                      @endforeach  
                    </div> 

                    <div id="proses" class="container tab-pane fade"><br>
                      @foreach ($data as $item)
                      @if($item->status == "processing")
                        <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-md-6">
                              <p class="text-left">{{ $item->date }}</p>
                            </div>
                            <div class="col-md-6">
                              <p class="text-right">{{ $item->code }}</p>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">	
                          <?php $total = 0 ?>
                          <table class="table table-sm table-borderless">
                        @foreach($detail as $no => $d)
                      @if($d->code == $item->code)
                          
                            <tr>
                              <td rowspan="2"><img src="{{ $d->path }}" style="height: 5em" alt=""></td>
                              <td>{{ $d->product_name }}</td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>x{{ $d->quantity }}</td>
                              <td>Rp. {{ $d->price }}</td>
                            </tr>
                            <?php $total += $d['price'] * $d['quantity'] ?>
                          
                          @endif
                      @endforeach
                    </table>
                        </div>
                        <div class="card-header">
                         <p class="text-right">Total : Rp. {{ $total }}</p>
                          </div>
                        </div>
                        
                        <br>
                        @endif
                      @endforeach 
                    </div>     
                    
                    <div id="dikirim" class="container tab-pane fade"><br>
                      @foreach ($data as $item)
                      @if($item->status == "confirmed")
                        <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-md-6">
                              <p class="text-left">{{ $item->date }}</p>
                            </div>
                            <div class="col-md-6">
                              <p class="text-right">{{ $item->code }}</p>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">	
                          <?php $total = 0 ?>
                          <table class="table table-sm table-borderless">
                        @foreach($detail as $no => $d)
                      @if($d->code == $item->code)
                          
                            <tr>
                              <td rowspan="2"><img src="{{ $d->path }}" style="height: 5em" alt=""></td>
                              <td>{{ $d->product_name }}</td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>x{{ $d->quantity }}</td>
                              <td>Rp. {{ $d->price }}</td>
                            </tr>
                            <?php $total += $d['price'] * $d['quantity'] ?>
                          
                          @endif
                      @endforeach
                    </table>
                        </div>
                        <div class="card-header">
                         <p class="text-right">Total : Rp. {{ $total }}</p>
                          </div>
                        </div>
                        
                        <br>
                        @endif
                      @endforeach 
                    </div> 
                    
                    <div id="selesai" class="container tab-pane fade"><br>
                      @foreach ($data as $item)
                      @if($item->status == "delivered")
                        <div class="card">
                        <div class="card-header">
                          <div class="row">
                            <div class="col-md-6">
                              <p class="text-left">{{ $item->date }}</p>
                            </div>
                            <div class="col-md-6">
                              <p class="text-right">{{ $item->code }}</p>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">	
                          <?php $total = 0 ?>
                          <table class="table table-sm table-borderless">
                        @foreach($detail as $no => $d)
                      @if($d->code == $item->code)
                          
                            <tr>
                              <td rowspan="2"><img src="{{ $d->path }}" style="height: 5em" alt=""></td>
                              <td>{{ $d->product_name }}</td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>x{{ $d->quantity }}</td>
                              <td>Rp. {{ $d->price }}</td>
                            </tr>
                            <?php $total += $d['price'] * $d['quantity'] ?>
                          
                          @endif
                      @endforeach
                    </table>
                        </div>
                        <div class="card-header">
                         <p class="text-right">Total : Rp. {{ $total }}</p>
                          </div>
                        </div>
                        
                        <br>
                        @endif
                      @endforeach 
                    </div> 
                    </div>          
                             
              </div>
            </div>
          </div>
        </div>
      </div>           
     </div>
    </div>
  </div>
</div>
@endsection