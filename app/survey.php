<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class survey extends Model
{
    protected $table = 'phieu_khao_sat';
    public $timestamps = false;
    protected $primaryKey = 'ma_phieu';

    public function category()
    {
        return $this->belongsTo('App\category_survey');
    }
}
