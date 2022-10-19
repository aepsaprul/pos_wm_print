<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <input type="text" name="invoice_id" id="invoice_id" value="{{ $invoice_id }}">
  <form action="{{ route('inventory_invoice.print') }}" method="POST">
    @csrf
    <div id="data"></div>
  </form>

  <script src="{{ asset('jquery/jquery.min.js') }}"></script>

  <script>
    $(document).ready(function () {
      function format_rupiah(bilangan) {
        var	number_string = bilangan.toString(),
            split	= number_string.split(','),
            sisa 	= split[0].length % 3,
            rupiah 	= split[0].substr(0, sisa),
            ribuan 	= split[0].substr(sisa).match(/\d{1,3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

        return rupiah;
      }
      
      let id = $('#invoice_id').val();

      $.ajax({
        url: `https://warungmitra.com/abcd/api/inventory_invoice/` + id,
        type: 'get',
        success: function (response) {
          console.log(response);
          let data = '' +
            '<table>' +
              '<tr>' +
                '<td><input type="text" name="nama_toko" id="nama_toko" value="' + response.invoice.shop.name + '"></td>' +
              '</tr>' +
              '<tr>' +
                '<td><input type="text" name="alamat" id="alamat" value="' + response.invoice.shop.address + '"></td>' +
              '</tr>' +
              '<tr>' +
                '<td><input type="text" name="kode" id="kode" value="' + response.invoice.code + '"></td>' +
              '</tr>' +
            '</table>' +
            '<table>' +
              '<tr>' +
                '<th>Item</th>' +
                '<th>Qty</th>' +
                '<th>Total</th>' +
              '</tr>';

              $.each(response.product_outs, function (index, item) {
                data += '<tr>' +
                  '<td><input type="text" name="produk[]" id="produk" value="' + item.product.product_name + '" readonly></td>' +
                  '<td><input type="text" name="qty[]" id="qty" value="' + item.quantity + '"></td>' +
                  '<td><input type="text" name="total[]" id="total" value="' + format_rupiah(item.sub_total) + '"></td>' +
                '</tr>';
              })
              
              data += '<tr>' +
                  '<td colspan="2">total</td>' +
                  '<td><input type="text" name="semua_total" id="semua_total" value="' + format_rupiah(response.invoice.total_amount) + '"></td>' +
                '</tr>' +
            '</table>' +
            '<hr>' +
            '<button type="submit">print</button>';

          $('#data').append(data);
        }
      })
    })
  </script>
</body>
</html>