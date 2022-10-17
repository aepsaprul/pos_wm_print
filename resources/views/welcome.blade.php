<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <form action="{{ route('print') }}" method="POST">
    @csrf
    <input type="text" name="produk" id="produk">
    <br>
    <input type="text" name="nomor" id="nomor">
    <br>
    <button type="submit">print</button>
  </form>
</body>
</html>