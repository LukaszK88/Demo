<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/11/2016
 * Time: 10:05
 */
namespace Demo\Validation\InputForms;

use Respect\Validation\Validator as v;

class GetUsers
{
    public static function rules()
    {
        return[
            'school'=>v::notEmpty(),
        ];
    }
}