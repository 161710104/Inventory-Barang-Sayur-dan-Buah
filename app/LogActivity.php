<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $table = 'log_activities';
    protected $fillable = [ 'user_id', 'description'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
