@extends('layout')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-3">
                    <div class="card">
                        <div class="card-body">
                            <table class="table-sm">
                                <tbody>
                                  <tr>
                                    <td colspan="2" class="text-left">{{ $data->name }}</td>                                    
                                  </tr>
                                  <tr>
                                    <td colspan="2" class="text-left">{{ $data->phone }}</td>                                    
                                  </tr>
                                  <tr>
                                    <td colspan="2" class="text-left">{{ $data->address }},{{ $data->city }}</td>
                                  </tr>
                                </tbody>
                            </table>
                            <div class="container mt-3">
                              <br>
                              <!-- Nav tabs -->
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
                            
                              <!-- Tab panes -->
                              <div class="tab-content">
                                <div id="belumbayar" class="container tab-pane active"><br>
                                      @if ($waiting == null)
                                      <p>Tidak ada Transaksi disini</p>
                                      @else
                                      @foreach ($waiting as $item)
                                        
                                      <div class="card">
                                        <div class="card-body">
                                          {{ $item->code }} 
                                        </div>
                                      </div>
                                      @endforeach
                                      @endif                                    
                                  
                                </div>
                                <div id="proses" class="container tab-pane fade"><br>
                                      @foreach ($processing as $item)
                                         
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
                                <div id="dikirim" class="container tab-pane fade"><br>
                                      @foreach ($confirmed as $item)
                                         
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
                                <div id="selesai" class="container tab-pane fade"><br>
                                      @foreach ($delivered as $item)
                                         
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
            </div>
            <div class="row">
              <div class="col-md-12">
                
              </div>
            </div>
        </div>
@endsection