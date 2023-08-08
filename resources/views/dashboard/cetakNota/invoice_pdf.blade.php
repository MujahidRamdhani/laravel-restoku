<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /*
  Common invoice styles. These styles will work in a browser or using the HTML
  to PDF anvil endpoint.
*/

body {
  font-size: 16px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

table tr td {
  padding: 0;
}

table tr td:last-child {
  text-align: right;
}

.bold {
  font-weight: bold;
}

.right {
  text-align: right;
}

.large {
  font-size: 1.75em;
}

.total {
  font-weight: bold;
  color: #fb7578;
}

.logo-container {
  margin: 20px 0 70px 0;
}

.invoice-info-container {
  font-size: 0.875em;
}
.invoice-info-container td {
  padding: 4px 0;
}

.no-meja {
  font-size: 1.5em;
  vertical-align: top;
}

.line-items-container {
  margin: 70px 0;
  font-size: 0.875em;
}

.line-items-container th {
  text-align: left;
  color: #999;
  border-bottom: 2px solid #ddd;
  padding: 10px 0 15px 0;
  font-size: 0.75em;
  text-transform: uppercase;
}

.line-items-container th:last-child {
  text-align: right;
}

.line-items-container td {
  padding: 15px 0;
}

.line-items-container tbody tr:first-child td {
  padding-top: 25px;
}

.line-items-container.has-bottom-border tbody tr:last-child td {
  padding-bottom: 25px;
  border-bottom: 2px solid #ddd;
}

.line-items-container.has-bottom-border {
  margin-bottom: 0;
}

.line-items-container th.heading-quantity {
  width: 50px;
}
.line-items-container th.heading-price {
  text-align: right;
  width: 100px;
}
.line-items-container th.heading-subtotal {
  width: 100px;
}

.payment-info {
  width: 38%;
  font-size: 0.75em;
  line-height: 1.5;
}

.footer {
  margin-top: 100px;
}

.footer-thanks {
  font-size: 1.125em;
}

.footer-thanks img {
  display: inline-block;
  position: relative;
  top: 1px;
  width: 16px;
  margin-right: 4px;
}

.footer-info {
  float: right;
  margin-top: 5px;
  font-size: 0.75em;
  color: #ccc;
}

.footer-info span {
  padding: 0 5px;
  color: black;
}

.footer-info span:last-child {
  padding-right: 0;
}

.page-container {
  display: none;
}
  </style>
  <title>Document</title>
</head>
<body>
  <div class="page-container">
    Page
    <span class="page"></span>
    of
    <span class="pages"></span>
  </div>
  
  
  <table class="invoice-info-container">
    <tr>
      <td rowspan="2" class="no-meja">
        {{ $pemesanan->kodeMeja }}
      </td>
      <td>
        Waktu pemesanan: <strong>{{ $pemesanan->created_at->format('M, d Y h:i ') }}</strong>
      </td>
    </tr>
    <tr>
      <td>
        Kode Pemesanan: <strong>{{ $pemesanan->kodePemesanan }}</strong>
      </td>
    </tr>
  </table>
  <table class="line-items-container">
    <thead>
      <tr>
        <th class="heading-quantity">Qty</th>
        <th class="heading-description">Nama Menu</th>
        <th class="heading-price">Harga</th>
        <th class="heading-subtotal">Subtotal</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($pemesanan->pemesanan_detail as $item)
        <tr>
        <td>{{ $item->qty }}</td>
        <td>{{ $item->menu->namaMenu }}</td>
        <td class="right">@currency( $item->menu->harga )</td>
        <td class="bold">@currency( $item->menu->harga * $item->qty )</td>
    </tr>
        @endforeach
    </tbody>
  </table>
  
  
  <table class="line-items-container has-bottom-border">
    <thead>
      <tr>
        <th>Total harga</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="large total">@currency( $pemesanan->totalHarga )</td>
      </tr>
    </tbody>
  </table>
  <div class="footer">
    <div class="footer-thanks">
      {{-- <img src="https://github.com/anvilco/html-pdf-invoice-template/raw/main/img/heart.png" alt="heart"> --}}
      <span>Terima Kasih!</span>
    </div>
  </div>
</body>
</html>