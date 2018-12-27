<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\FullTextSearch;

class Student extends Authenticatable
{
    use Notifiable;
    use FullTextSearch;
    protected $table = 'sinh_vien';
    public $timestamps = false;
    // protected $guard = 'student';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'ho_ten', 'lop_khoa_hoc', 'email', 'password'
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
        'lop_khoa_hoc',
    ];

    public function mon_hoc()
    {
        return $this->belongsToMany('App\mon_hoc', 'lop_mon_hoc', 'id_sv', 'ma_mh');
    }
}
