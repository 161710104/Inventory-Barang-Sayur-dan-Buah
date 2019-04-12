<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Supplier extends Model
{
    public function barang_masuk()
    {
        return $this->hasMany('App\BarangMasuk' ,'id_supplier');
    }

    public static function boot(){
    	parent::boot();
    	self::deleting(function($supplier){
    		if($supplier->barang_masuk->count() > 0){
    		$html = 'Supplier tidak bisa dihapus karena masih memiliki Barang Masuk';
    		Session::flash("flash_notification",[
    			"level" => "danger",
    			"message" => $html

    			]);
    		return false;

    		}

    	});
    	
    }
}
