<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 13/01/2017
 * Time: 09:55
 */
namespace Demo\Models;


use Demo\Models\User;
use Illuminate\Database\Eloquent\Model;

class Records extends Model{

    protected $table = 'school_user';

    protected $fillable = [
        'user_id',
        'school_id'
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }
    

}