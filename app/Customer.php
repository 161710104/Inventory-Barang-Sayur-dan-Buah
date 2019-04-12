<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Customer extends Model
{
    
    public function barang_keluar()
    {
        return $this->hasMany('App\BarangKeluar' ,'id_barang');
    }

    public static function boot(){
    	parent::boot();
    	self::deleting(function($customer){
    		if($customer->barang_keluar->count() > 0){
    		$html = 'Customer tidak bisa dihapus karena masih memiliki Barang Masuk';
    		Session::flash("flash_notification",[
    			"level" => "danger",
    			"message" => $html

    			]);
    		return false;

    		}

    	});
    	
    }
}
