<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 25/11/2016
 * Time: 09:29
 */

namespace Demo\Validation\Rules;

use Demo\Models\User;
use Respect\Validation\Rules\AbstractRule;

class EmailAvailable extends AbstractRule
{
    public function validate($input)
    {
        return User::where('email',$input)->count()===0;
    }
}