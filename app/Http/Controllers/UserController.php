<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;
use App\LogActivity;
use Yajra\DataTables\DataTables;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('User/index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User/create');
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
            'name' => 'required|min:3|max:30|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
          ],[
            'name.required' => ':Attribute harus diisi',
            'name.unique' => ':Attribute sudah ditambahkan',
            'email.required' => ':Attribute harus diisi',
            'password.required' => ':Attribute harus diisi',
            'email.unique' => ':Attribute sudah ditambahkan'
          ]);
    
          $users = new User;
          $users->name          = $request->name;
          $users->email          = $request->email;
          $users->password          = bcrypt($request->password);
          $users->save();
          $insertLog                = new LogActivity();
          $insertLog->user_id       = Auth::user()->id;
          $insertLog->description   = 'Tambah data user ='.$request->name;
          $insertLog->save();
          $karyawanRole = Role::where('name', 'karyawan')->first();
          $users->attachRole($karyawanRole);
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
        $users = User::find($id);
        return $users;
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
        $users = User::find($id);  
        $users->name          = $request->name;
        $users->email          = $request->email;
        $users->password          = bcrypt($request->password);
        $users->save();
        $insertLog                = new LogActivity();
          $insertLog->user_id       = Auth::user()->id;
          $insertLog->description   = 'Ubah User'.$request->name;
          $insertLog->save();
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
        $users = User::findOrFail($id);
        if(!User::destroy($id)){
        return redirect()->back();
        }elseif ($users->delete()) {
          $insertLog                = new LogActivity();
          $insertLog->user_id       = Auth::user()->id;
          $insertLog->description   = 'Menghapus data ='.$users->name;
          $insertLog->save();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"<b>Berhasil Menghapus Data</b>"
            ]);
        return redirect()->route('users.index');
        }
    }

    public function delete(Request $request)
    {
        $users = User::find($request->input('id'));
        if($users->delete())
        {
           $insertLog                = new LogActivity();
          $insertLog->user_id       = Auth::user()->id;
          $insertLog->description   = 'Ubah Profil';
          $insertLog->save();
        }
    }

    public function table(){
        $users = User::all();
        return Datatables::of($users)
        ->addColumn('action', function ($users) {
            if($users->name == 'Admin'){
                return '<center><a href="#" data-id="'.$users->id.'" rel="tooltip" title="Edit" 
                        class="btn btn-warning btn-simple btn-xs editUser"><i class="fa fa-pencil"></i> Edit</a></center>';
            }
            else{
              return '<center><a href="#" data-id="'.$users->id.'" rel="tooltip" title="Edit" 
                        class="btn btn-warning btn-simple btn-xs editUser"><i class="fa fa-pencil"></i> Edit</a>
                    &nbsp<a href="/users/delete/'.$users->id.'" rel="tooltip" title="Delete" 
                        class="btn btn-danger btn-simple btn-xs"><i class="fa fa-trash-o"></i> Delete</a>';
            }
            })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function UbahProfil(Request $request){
        $id = Auth::user()->id;
        $users = User::find($id);
        return view('User/ubah_profil',['users' => $users]);
    }

    public function updateUbahProfil(Request $request, $id)
    {
        $users = User::find($id);
        $users->name          = $request->name;
        $users->email          = $request->email;
        $users->password          = bcrypt($request->password);
        $users->save();
        $insertLog                = new LogActivity();
          $insertLog->user_id       = Auth::user()->id;
          $insertLog->description   = 'Ubah Profil';
          $insertLog->save();
        return response()->json(['success'=>true]);
    }

    public function editUbahProfil($id)
    {
        $id = Auth::user()->id;
        $users = User::find($id);
        return $users;
    }

}

