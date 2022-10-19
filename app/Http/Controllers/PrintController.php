<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

class PrintController extends Controller
{
  public function index()
  {
    
  }

  public function show($id)
  {
    $invoice_id = $id;

    return view('print', ['invoice_id' => $invoice_id]);
  }

  public function print(Request $request)
  {
    function addSpaces($string = '', $valid_string_length = 0) {
      if (strlen($string) < $valid_string_length) {
          $spaces = $valid_string_length - strlen($string);
          for ($index1 = 1; $index1 <= $spaces; $index1++) {
              $string = $string . ' ';
          }
      }
    
      return $string;
    }

    $connector = new FilePrintConnector("//10.2.1.17/pos-58-2");
    $printer = new Printer($connector);

    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text($request->nama_toko . "\n");
    $printer->text($request->alamat . "\n");
    $printer->text("___________________________\n");
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text("kode: " . $request->kode . "\n");
    $printer->text("\n");


    foreach ($request->produk as $key => $value) {
      $printer->text($value . "\n");
      $printer->text(addSpaces('x' . $request->qty[$key], 20) . addSpaces($request->total[$key], 6) . "\n");  
    }

    $printer->text("\n");
    $printer->setJustification(Printer::JUSTIFY_RIGHT);
    $printer->text('Total ' . $request->semua_total);
    $printer->text("\n");
    $printer->text("\n");
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text("Terimakasih Telah Berbelanja\n");
    $printer->text("Jangan lupa berkunjung kembali\n");

    $printer->text("\n");
    $printer->text("\n"); 
    $printer->cut();
    $printer->close();

    return redirect('/');
  }
}
