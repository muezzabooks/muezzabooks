@extends('layout')

@section('content')
<section>
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="p-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ ('assets/images/cover-book.jpg') }}" class="img-card" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <h4>Bahagia Bersama Al-Quran</h4>
                                        <form>
                                            <div class="form-group">
                                              <input type="number" class="form-control" id="number" value="2">
                                            </div>
                                          </form>
                                          <p>Total Harga : Rp 190000</p>
                                    </div>
                                    <div class="col-md-2">
                                            
                                        <a href="3" class="btn btn-yellow btn-delete"> hapus</a>
                                      </div>
                                </div>                          
                            </div>
                            <hr>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ ('assets/images/cover-book.jpg') }}" class="img-card" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h4>Bahagia Bersama Al-Quran</h4>
                                    <form>
                                        <div class="form-group">
                                          <input type="number" class="form-control" id="number" value="2">
                                        </div>
                                      </form>
                                      <p>Total Harga : Rp 190000</p>
                                </div>
                                <div class="col-md-2">
                                        
                                    <a href="3" class="btn btn-yellow btn-delete"> hapus</a>
                                  </div>
                            </div>                          
                        </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                  <h5 class="card-title">Grand Total : 180.000</h5>
                                 <a href="#" class="btn btn-yellow btn-block">Go to Payment</a>
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
  </section>
@endsection