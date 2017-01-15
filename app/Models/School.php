<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 12/01/2017
 * Time: 15:54
 */
namespace Demo\Models;

use Demo\Models\User;
use Demo\Models\Records;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';

    protected $fillable = [
        'school'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}