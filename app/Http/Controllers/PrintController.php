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
    // $connector = new FilePrintConnector("//192.168.43.37/pos-58-2");
    // $printer = new Printer($connector);
    // $printer -> text("terrrrr\n");
    // $printer -> text("Hello World!\n");
    // $printer -> text("Hello World!\n");
    // $printer -> text("Hello World!\n");
    // $printer -> text("Hello World!\n");
    // $printer -> text("Hello World!\n");
    // $printer -> cut();
    // $printer -> close();

    // $json = file_get_contents('http://localhost/pos_wm_api/public/api/inventory_invoice/4');
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://warungmitra.com/abcd/api/inventory_invoice/4');
    $response = $request->getBody();
    // dd($response);

    return response()->json([
      'data' => $request
    ]);

    // $client = new \GuzzleHttp\Client();
    // $res = $client->request('GET', 'http://127.0.0.1:8000/api/inventory_invoice/4');
    // echo $res->getStatusCode();
    // "200"
    // echo $res->getHeader('content-type')[0];
    // 'application/json; charset=utf8'
    // echo $res->getBody();
    // {"type":"User"...'
  }
}
