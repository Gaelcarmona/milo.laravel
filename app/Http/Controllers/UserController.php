<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use \App\Http\Requests\CreateAndEditUserRequest;

class UserController extends Controller
{
    public function insert(CreateAndEditUserRequest $request)
    {

        $user = new User();

        $user->pseudo = $request->input('pseudo');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        return view('/login');
    }

        public function update(CreateAndEditUserRequest $request, $id)
    {

        User::where('id', $id)->update([

        'pseudo' => $request->input('pseudo'),
        "email" => $request->input('email'),
        "password" => $request->input('password')]);

        return view('/admin');
    }

        public function delete($id)
    {
        User::where('id', $id)->delete();
        return view('/admin');
    }










































//    public function login(){
//
//        if (!empty ( $_POST ) )  {
//            $oUser =  app\Models\User::find($_POST['pseudo']);
//
//            if ($oUser == NULL) {
//                return view('/login');
//            }
//
//            if (password_verify($_POST['password'], $oUser->getPass())) {
//                $_SESSION['username'] = $oUser->getPseudo();
//                $_SESSION['id'] = $oUser->getId();
//                return view('/login/{id}');
//            }
//        }
//    }
}
