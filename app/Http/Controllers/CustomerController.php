<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\BarangKeluar;
use App\Barang;
use App\LogActivity;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Auth;
use Yajra\DataTables\Html\Builder;
use Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('Customer/index',['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Customer/create');
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
          'nama' => 'required|min:3|max:30|unique:customers',
          'alamat' => 'required',
          'no_telepon' => 'required|numeric',
          'awal'=>'required',
          'akhir' =>'required|after:awal'
        ],
        [
          'nama.required' => ':Attribute harus diisi',
          'nama.unique' => ':Attribute sudah ditambahkan',
          'alamat.required' => ':Attribute harus diisi',
          'no_telepon.required' => ':Attribute harus diisi',
          'no_telepon.numeric' => ':Attribute yang dimasukkan harus angka',
          'awal.required'=>':Attribute harus diisi',
          'akhir.required' =>':Attribute harus diisi',
          'akhir.after' =>':Attribute tanggal tidak boleh sebelum kerjasama awal',

        ]);
        
        $log = new LogActivity;
        $customers = new Customer;
        $customers->nama          = $request->nama;
        $customers->alamat          = $request->alamat;
        $customers->no_telepon          = $request->no_telepon;
        $customers->awal    = $request->awal;
        $customers->akhir = $request->akhir;
        $log->user_id = Auth::user()->id;
        $log->description = 'Menambahkan data Customer = '.$request->nama;
        $date1 = Carbon::today();
        $date2 = new Carbon($request->akhir);
        if ($date2 >= $date1) {
            $customers->status = 'Activate';
        }
        elseif ($date2 < $date1)
        {
            $customers->status = 'Deactivate';
        }

        $customers->save();
        $log->save();
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
        $customers = Customer::findorfail($id);
        return view('Customer/show',['customers' => $customers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::find($id);
        return $customers;
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


      $this->validate($request, [
          'nama' => 'required|min:3|max:30',
          'alamat' => 'required',
          'no_telepon' => 'required|numeric',
          'awal'=>'required',
          'akhir' =>'required|after:awal'
        ],
        [
          'nama.required' => ':Attribute harus diisi',
          'alamat.required' => ':Attribute harus diisi',
          'no_telepon.required' => ':Attribute harus diisi',
          'no_telepon.numeric' => ':Attribute yang dimasukkan harus angka',
          'awal.required'=>':Attribute harus diisi',
          'akhir.required' =>':Attribute harus diisi',
          'akhir.after' =>':Attribute tanggal tidak boleh sebelum kerjasama awal',

        ]);

        $log = new LogActivity;
        $customers = Customer::findorfail($id);
        $customers->nama          = $request->nama;
        $customers->alamat          = $request->alamat;
        $customers->no_telepon          = $request->no_telepon;
        $customers->awal    = $request->awal;
        $customers->akhir = $request->akhir;
        $log->user_id = Auth::user()->id;
        $log->description = 'Mengubah data Customer ID = '.$id;
        $date1 = Carbon::today();
        $date2 = new Carbon($request->akhir);
        if ($date2 >= $date1) {
            $customers->status = 'Activate';
        }
        elseif ($date2 < $date1)
        {
            $customers->status = 'Deactivate';
        }
        $customers->save();
        $log->save();
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
        $customers = Customer::findOrFail($id);
        if(!Customer::destroy($id)){
        return redirect()->back();
        }elseif ($customers->delete()) {
          $insertLog                = new LogActivity();
              $insertLog->user_id       = Auth::user()->id;
              $insertLog->description   = 'Menghapus data ='.$customers->nama;
              $insertLog->save();
          Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"<b>Berhasil Menghapus Data</b>"
            ]);
        return redirect()->route('customers.index');
        }
    }

    public function lihat($id)
    {
        $customers = Customer::findorfail($id);
        // $barang = BarangKeluar::select('id_barang')->join('barangs', 'barangs.id', '=', 'barang_keluars.id_barang')
        // ->GROUPBY('barang_keluars.tanggal_keluar')->where('id_customer',$id)->get();
        return view('Customer/show',[
            'customers' => $customers,
            // 'nama_barang' => $barang,
        ]);
    }

    // public function redirect($id)
    // {
    //     $customer = Customer::findorfail($id);
    //     $barang = Barang::all();
    //     return view('BarangKeluar/create',[
    //         'barang' => $barang,
    //         'customer' => $customer,
    //     ]);
    // }

    public function delete($id)
    {
        $customers = Customer::find($id);
         if($customers->delete())
        {
            echo 'Data Deleted';
        }
    }

    public function table(){
        $customers = Customer::all();
        return Datatables::of($customers)
        ->addColumn('action', function ($customers) {
              if (new Carbon($customers->akhir) < Carbon::today()) {
                  return '<center><a href="#" data-id="'.$customers->id.'" rel="tooltip" title="Edit"  class="btn btn-warning btn-simple btn-xs editCustomer"><i class="fa fa-pencil"></i> Edit</a>&nbsp<a href="/customers/delete/'.$customers->id.'" rel="tooltip" title="Delete" 
                        class="btn btn-danger btn-simple btn-xs"><i class="fa fa-trash-o"></i> Delete</a></center>';
              }
              else if (new Carbon($customers->akhir) >= Carbon::today()) {
                 return '<center><a href="#" data-id="'.$customers->id.'" rel="tooltip" title="Edit"  class="btn btn-warning btn-simple btn-xs editCustomer"><i class="fa fa-pencil"></i> Edit</a></center>';
              }
              return '<center><a href="#" data-id="'.$customers->id.'" rel="tooltip" title="Edit"  class="btn btn-warning btn-simple btn-xs editCustomer"><i class="fa fa-pencil"></i> Edit</a>&nbsp<a href="/customers/delete/'.$customers->id.'" rel="tooltip" title="Delete" 
                        class="btn btn-danger btn-simple btn-xs"><i class="fa fa-trash-o"></i> Delete</a></center>';
            })

        ->addColumn('statuss', function ($customers) {
              if (new Carbon($customers->akhir) < Carbon::today()) {
                  $customers->status = "Deactivate";
                  $customers->save();
                 return '<a href="#" data-id="'.$customers->id.'" rel="tooltip" title="perpanjang"  class="btn btn-info btn-simple btn-xs perpanjangcs"><i class=""></i> Perpanjang</a>';
              }
              else if (new Carbon($customers->akhir) > Carbon::today()) {
                  $customers->status = "Activate";
                  $customers->save();
                return '<button type="button" class="btn btn-success btn-xs disabled">
                        <i class="fa fa-check-circle"></i> Aktif
                        </button>';
              }
              else if ($customers->status == "Deactivate") {
                return '<a href="#" data-id="'.$customers->id.'" rel="tooltip" title="perpanjang"  class="btn btn-info btn-simple btn-xs perpanjangcs"><i class=""></i> Perpanjang</a>';
              }
              else if ($customers->status == "Activate") {
                return '<button type="button" class="btn btn-success btn-xs disabled">
                        <i class="fa fa-check-circle"></i> Aktif
                        </button>';
              }
            })

        ->addColumn('awal_kerjasama', function ($customers) {
              return date('d F Y' , strtotime($customers->awal));
            })
        ->addColumn('akhir_kerjasama', function ($customers) {
              return date('d F Y' , strtotime($customers->akhir));
            })
        ->rawColumns(['action','awal_kerjasama','akhir_kerjasama','statuss'])
        ->make(true);
    }

    public function Status($id)
    {
        $customers = Customer::find($id);
        if ($customers->status === "Activate") {
            $customers->status = "Deactivate";
        } else {
            $customers->status = "Activate";
        }
        $customers->save();
        return redirect()->route('customers.index');
    }
}
