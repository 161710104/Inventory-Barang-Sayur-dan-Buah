<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Yajra\DataTables\DataTables;

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
            'name' => 'required|min:3|max:30',
            'email' => 'required',
            'password' => 'required|min:10',
          ]);
    
          $users = new User;
          $users->name          = $request->name;
          $users->email          = $request->email;
          $users->password          = bcrypt($request->password);
          $users->save();
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
        $karyawanRole = Role::where('name', 'karyawan')->first();
        $users->attachRole($karyawanRole);
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
        //
    }

    public function delete(Request $request)
    {
        $users = User::find($request->input('id'));
        if($users->delete())
        {
            echo 'Data Dihapus!';
        }
    }

    public function table(){
        $users = User::all();
        return Datatables::of($users)
        ->addColumn('action', function ($users) {
              return '<center><a href="#" data-id="'.$users->id.'" rel="tooltip" title="Edit" 
                        class="btn btn-warning btn-simple btn-xs editUser"><i class="fa fa-pencil"></i></a>
                    &nbsp<a href="#" id="'.$users->id.'" rel="tooltip" title="Delete" class="btn btn-danger btn-simple btn-xs delete"><i class="fa fa-trash-o"></i></a></center>';
            })
        ->rawColumns(['action'])
        ->make(true);
    }
}
