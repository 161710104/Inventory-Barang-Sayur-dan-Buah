<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\LogActivity;
use Yajra\DataTables\DataTables;
use Alert;
use Session;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('Supplier/index',['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Supplier/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|unique:suppliers',
            'alamat' => 'required',
            'no_telepon' => 'required|numeric',
        ],
        [
          'nama.required' => ':Attribute harus diisi',
          'nama.unique' => ':Attribute sudah ditambahkan',
          'alamat.required' => ':Attribute harus diisi',
          'no_telepon.required' => ':Attribute harus diisi',
          'no_telepon.numeric' => ':Attribute yang dimasukkan harus angka',
        ]);
    
          $suppliers = new Supplier;
          $suppliers->nama          = $request->nama;
          $suppliers->alamat          = $request->alamat;
          $suppliers->no_telepon          = $request->no_telepon;
          $suppliers->save();
          return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suppliers = Supplier::find($id);
        return $suppliers;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $suppliers = Supplier::find($id);        
        $suppliers->nama          = $request->nama;
        $suppliers->alamat          = $request->alamat;
        $suppliers->no_telepon          = $request->no_telepon;
        $suppliers->save();
        return response()->json(['success'=>true]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suppliers = Supplier::findOrFail($id);
        if(!Supplier::destroy($id)){
        return redirect()->back();
        }elseif ($suppliers->delete()) {
            $insertLog                = new LogActivity();
              $insertLog->user_id       = Auth::user()->id;
              $insertLog->description   = 'Menghapus data ='.$suppliers->nama;
              $insertLog->save();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"<b>Berhasil Menghapus Data</b>"
            ]);
        return redirect()->route('suppliers.index');
        }
    }

    public function table(){
        $suppliers = Supplier::all();
        return Datatables::of($suppliers)

        ->addColumn('action', function ($suppliers) {
              return '<center><a href="#" data-id="'.$suppliers->id.'" rel="tooltip" title="Edit" 
                        class="btn btn-warning btn-simple btn-xs editSupplier"><i class="fa fa-pencil"></i></a>
                        &nbsp<a href="/suppliers/delete/'.$suppliers->id.'" rel="tooltip" title="Delete" 
                        class="btn btn-danger btn-simple btn-xs"><i class="fa fa-trash-o"></i></a>';
            })
        ->rawColumns(['action'])
        ->make(true);
    }
    
}
