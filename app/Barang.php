<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class Barang extends Model
{

    public function barang_masuk()
    {
        return $this->hasMany('App\BarangMasuk' ,'id_barang');
    }

    public function barang_keluar()
    {
        return $this->hasMany('App\BarangKeluar' ,'id_barang');
    }

    public static function boot(){
        parent::boot();
        self::deleting(function($barang){
            if($barang->barang_keluar->count() > 0 ){
            $html = 'Barang tidak bisa dihapus karena masih memiliki Barang Keluar';
            Session::flash("flash_notification",[
                "level" => "danger",
                "message" => $html

                ]);
            return false;

            }
            else if($barang->barang_masuk->count() > 0 ){
            $html = 'Barang tidak bisa dihapus karena masih memiliki Barang Masuk';
            Session::flash("flash_notification",[
                "level" => "danger",
                "message" => $html

                ]);
            return false;

            }
        });
    }
}
