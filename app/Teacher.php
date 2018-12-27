<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\FullTextSearch;

class Teacher extends Authenticatable
{
    // protected $guard = "teacher";
    protected $table = 'giang_vien';
    public $timestamps = false;
    use Notifiable;
    use FullTextSearch;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','ho_ten','email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The columns of the full text index
     */
    protected $searchable = [
        'username',
        'ho_ten',
        'email',
    ];

    public function mon_hoc()
    {
        return $this->hasMany('App\mon_hoc', 'gv_id', 'id');
    }
}
