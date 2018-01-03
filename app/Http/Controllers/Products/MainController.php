<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Model\Products\MainModel as Users;
use Illuminate\Http\Request;
use Session;
use Validator;

class MainController extends Controller
{
    public function index(Request $req)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $mesages = [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ];
        $validator = Validator::make($req->all(), $rules, $mesages);
        if ($validator->fails()) {
            return response()->json(['errors', $this->GetMessageBag($validator)]);
        }
        $users = Users::select('pass', 'id')->where('user', $req->email)->first();
        if ($users->pass == hash('sha1', hash('whirlpool', $req->password))) {
            $sessions = array('id_user' => $users->id);
            Session::put($sessions);
            return response()->json(['sucess', '/home']);
        } else {
            return response()->json(['errors', 'User and password invalid', Session::get('id_user')]);
        }
    }

    public function signup(Request $req)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $mesages = [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ];
        $validator = Validator::make($req->all(), $rules, $mesages);
        if ($validator->fails()) {
            return response()->json(['errors', $this->GetMessageBag($validator)]);
        }
        $users = Users::select('user')->where('user', $req->email)->first();
        if (count($users) < 1) {
            $newUser = new Users;
            $newUser->user = $req->email;
            $newUser->pass = hash('sha1', hash('whirlpool', $req->password));
            if ($newUser->save()) {
                return response()->json(['success', 'The user has been successfully registered']);
            } else {
                return response()->json(['errors', 'An error occurred while creating a new user']);
            }
        } else {
            return response()->json(['errors', 'The mail already exists']);
        }
    }

    //function return errors messages validator-ajax
    public function GetMessageBag($validator)
    {
        $data = "";
        foreach ($validator->getMessageBag()->toArray() as $errors) {
            $data .= "<br>" . $errors[0] . "<br>";
        }
        $data .= "";
        return $data;
    }
}
