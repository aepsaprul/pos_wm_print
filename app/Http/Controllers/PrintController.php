<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

class PrintController extends Controller
{
  public function index(Request $request)
  {
    $connector = new FilePrintConnector("//192.168.43.37/pos-58-2");
    $printer = new Printer($connector);
    $printer -> text($request->produk . "\n");
    $printer -> text("Hello World!\n");
    $printer -> cut();
    $printer -> close();

    return redirect('/');
  }
}
