<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Session;

class User extends Authenticatable
{

    use LaratrustUserTrait;
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function barang_masuk()
    {
        return $this->hasMany('App\BarangMasuk' ,'id_karyawan');
    }

    public function barang_keluar()
    {
        return $this->hasMany('App\BarangKeluar' ,'id_karyawan');
    }

    public function logs()
    {
        return $this->hasMany('App\LogActivity');
    }

    public static function boot(){
        parent::boot();
        self::deleting(function($user){
            if($user->barang_keluar->count() > 0 ){
            $html = 'User tidak bisa dihapus karena masih memiliki Barang Keluar';
            Session::flash("flash_notification",[
                "level" => "danger",
                "message" => $html

                ]);
            return false;

            }
            else if($user->barang_masuk->count() > 0 ){
            $html = 'User tidak bisa dihapus karena masih memiliki Barang Masuk';
            Session::flash("flash_notification",[
                "level" => "danger",
                "message" => $html

                ]);
            return false;

            }
            else if($user->logs->count() > 0 ){
            $html = 'User tidak bisa dihapus karena masih punya riwayat';
            Session::flash("flash_notification",[
                "level" => "danger",
                "message" => $html

                ]);
            return false;

            }

        });
        
    }
}
