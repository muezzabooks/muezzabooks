// Make sure you have JQuery

function convertSiCepatFareTableToJSON(resultFromSiCepat) {
  var finalResult = [];

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

var params = {
  origin_code: 'BDO',
  destination_code: 'BDO10000',
  weight: 1
};

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
  datatype: 'html',
  headers: headers,
  beforeSend: function () {
    console.log('Please Wait..')
  },
  success: function (data) {
    // Final JSON data you can manipulate as your desire.
    console.log(convertSiCepatFareTableToJSON(data.html))
  },
  error: function (xhr) {
    console.log(xhr.status + " - " + xhr.statusText)
  },
})

