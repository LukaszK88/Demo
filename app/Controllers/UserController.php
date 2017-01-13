<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/01/2017
 * Time: 14:57
 */
namespace Demo\Controllers;

use Demo\Models\School;

use Demo\Models\User;
use Demo\Models\Records;
use Demo\Validation\InputForms\RegisterUser;
use Demo\Validation\InputForms\GetUsers;
use Slim\Views\Twig as View;

class UserController extends Controller{


    public function getAdd($request,$response){

        $schools = School::all();

        return $this->view->render($response,'users/add.twig',[
            'schools' => $schools
        ]);
    }


    public function postAdd($request,$response){

        $validation = $this->validator->validate($request,RegisterUser::rules());

        if($validation->fails() ){
            $this->flash->addMessage('error','Please double check entered data');
            return $response->withRedirect($this->router->pathFor('add.user'));
        }

             $user = User::create([
                  'first_name' => $request->getParam('first_name'),
                  'last_name' => $request->getParam('last_name'),
                  'email' => $request->getParam('email')
              ]);

            foreach ($request->getParam('school') as $schoolId){
                $user->record()->create([
                    'school_id' => $schoolId
                ]);

            }

        $this->flash->addMessage('success','You have successfully added a member');
        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function getUsers($request,$response,$schoolId = ''){

        $schools = School::all();
        if(!empty($schoolId)) {
            
            $selectSchoolById = School::where('id', $schoolId)->first();

            $school = School::find($schoolId['schoolId']);
            
            $users = $school->users;

        }else{
            $selectSchoolById = '';
            $users = '';

        }
        return $this->view->render($response,'users/get.twig',[
            'schools' => $schools,
            'schoolId' => $schoolId,
            'selectedSchool' => $selectSchoolById,
            'users' => $users
        ]);
    }

    public function postUsers($request,$response){

        $validation = $this->validator->validate($request,GetUsers::rules());

        if($validation->fails() ){

            return $response->withRedirect($this->router->pathFor('get.users'));
        }

        return $response->withRedirect($this->router->pathFor('get.users',['schoolId' => $request->getParam('school')]));

    
    }

}