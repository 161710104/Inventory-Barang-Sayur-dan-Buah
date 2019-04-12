<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Barang;
use App\Customer;

class AndroidController extends Controller
{

     public function buah()
    {
        $barangs = Barang::where('jenis','=','Buah')->get();
        return response()->json($barangs, 200);
    }

    public function sayur()
    {
        $barangs = Barang::where('jenis','=','Sayur')->get();
        return response()->json($barangs, 200);
    }

    public function barang()
    {
	   	$barangs = Barang::all();
	    return response()->json($barangs, 200);
	}

	public function customer()
    {
	   	$customers = Customer::all();
	    return response()->json($customers, 200);
	}
}
