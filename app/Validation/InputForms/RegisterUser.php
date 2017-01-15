<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 08/11/2016
 * Time: 10:05
 */
namespace Demo\Validation\InputForms;

use Respect\Validation\Validator as v;

class RegisterUser
{
    public static function rules()
    {
        return[
            'email'=>v::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'first_name'=>v::notEmpty()->alpha('-'),
            'last_name'=>v::notEmpty()->alpha('-'),
            'schools'=>v::notEmpty(),
        ];
    }
}