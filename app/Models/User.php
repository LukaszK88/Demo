<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/01/2017
 * Time: 14:46
 */
namespace Demo\Models;

use Demo\Models\School;
use Demo\Models\Records;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email'
    ];

    public function record()
    {
        return $this->hasMany(Records::class);
    }

    public function schools()
    {
        return $this->belongsToMany(School::class);
    }
}
