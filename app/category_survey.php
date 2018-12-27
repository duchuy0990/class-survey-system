<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category_survey extends Model
{
    protected $table = 'category_khao_sat';
    public $timestamps = false;
    protected $primaryKey = 'ma_category';

    public function survey()
    {
        return $this->hasMany('App\survey', 'ma_category', 'ma_category');
    }
}
