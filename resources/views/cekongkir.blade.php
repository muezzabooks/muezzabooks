
@extends('layout')

@section('content')
<div class="container">
  <div class="row">
    
    <div class="col-md-8 col-sm-12">

      <div class="row">
        <div class="col-12 p-3">
          <div class="card">
            <h5 class="card-header card-header-yellow">Alamat Pengiriman</h5>
            <div class="card-body">
                {{-- Kota atau kecamatan --}}
                <div class="row">
                  <div class="col-6">
                    <select class="js-example-basic-single" name="state" class="form-control" id="destination" style="width: 100%">
                    </select>
                  </div>
                </div>
                <label>Berat (gram)</label><br> 
                <input id="berat" type="text" name="berat" value="1" /> 
                <br><br> 
                <input id="cek" type="submit" value="Cek"/> 
              
            </div>
            <pre id="ongkir"></pre> 
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

@section('script')
<script>

  $(document).ready(function(){

    $('.js-example-basic-single').select2({
      data: data
    });
    
    $('.js-example-basic').select2({
      data: origin
    });

  });
  

  document.getElementById("destination").onchange = function(){
    var finalResult = [];
    function convertSiCepatFareTableToJSON(resultFromSiCepat) {
      

      // Remove <div> that wrap <table> tag
      var tableString = resultFromSiCepat.replace(/(?:^<div[^>]*>)|(?:<\/div>$)/g, '')
      var tableDOM = $(tableString)[0];

      // first row needs to be headers
      var headers = [];
      for (var i = 0; i < tableDOM.rows[0].cells.length; i++) {
        headers[i] = tableDOM.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi, '');
      }

      // go through cells
      for (var i = 1; i < tableDOM.rows.length; i++) {
        var tableRow = tableDOM.rows[i];
        var rowData = {};

        for (var j = 0; j < tableRow.cells.length; j++) {

          // remove any div and its content
          filteredContent = tableRow.cells[j].innerHTML.replace(/<div.*<\/div>/g, '')
          rowData[headers[j]] = filteredContent;
        }

        finalResult.push(rowData);
      }

      return finalResult;

    }

    var kab = $('#destination').val(); 
    var berat = $('#berat').val(); 

    var params = {
      origin_code: 'BDO',
      destination_code: kab,
      weight: berat
    };

    console.log(params);

    var headers = {
      "authority": 'www.sicepat.com',
      "accept": 'application/json, text/javascript, */*; q=0.01',
      "x-requested-with": 'XMLHttpRequest',
      "content-type": 'application/x-www-form-urlencoded; charset=UTF-8',
    }

    $.ajax({
      url: 'https://cors-anywhere.herokuapp.com/https://www.sicepat.com/deliveryFee/fare',
      method: 'POST',
      data: params,
      datatype: 'json',
      headers: headers,
      beforeSend: function () {
        console.log('Please Wait..')
      },
      success: function (data) {
        // Final JSON data you can manipulate as your desire.
        console.log(convertSiCepatFareTableToJSON(data.html))
        // var json_data = convertSiCepatFareTableToJSON(data.html)
        

            console.log(finalResult);
            var arrlength = finalResult.length;

            if(arrlength == 4){
              document.getElementById("ongkir").textContent = finalResult[3].tarif;
            }
            else if(arrlength == 5){
              document.getElementById("ongkir").textContent = finalResult[4].tarif;
            }

           
            // hasil.innerHTML = stringresult;
        
      },
      error: function (xhr) {
        console.log(xhr.status + " - " + xhr.statusText)
      },
    })

  }

</script>
@endsection
