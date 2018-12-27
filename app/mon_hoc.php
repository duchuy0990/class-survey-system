<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mon_hoc extends Model
{
    protected $table = 'mon_hoc';
    protected $timestamp = false;

    public function sinh_vien()
    {
        return $this->belongsToMany('App\Student', 'lop_mon_hoc', 'ma_mh', 'id_sv');
    }

    public function giang_vien()
    {
        return $this->belongsTo('App\Teacher', 'gv_id', 'id');
    }
}
