<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserControllerAdmin extends Controller
{

    public function createUser(Request $request)
    {
        $response = array('code' => 400, 'error_msg' => []);
        if (isset($request)) {
            if (!$request->email) array_push($response['error_msg'], 'Email is required');
            if (!$request->password) array_push($response['error_msg'], 'Password is required');
            if (!$request->user_name) array_push($response['error_msg'], 'User name is required');
            if (!count($response['error_msg']) > 0) {
                $user = User::where('email', '=', $request->email);
                if (!$user->count()) {
                    try {
                        $user = new User();
                        $user->email = $request->email;
                        $user->password = hash('sha256', $request->password);
                        $user->user_name = $request->user_name;
                        $token = uniqid() . $user->email;
                        $user->token = hash('sha256', $token);
                        $user->save();
                        $response = array('code' => 200, 'user' => $user, 'msg' => 'User created');
                    } catch (\Exception $exception) {
                        $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                    }
                } else {
                    $response = array('code' => 400, 'error_msg' => "Email already registered");
                }
            }
        } else {
            $response['error_msg'] = 'Nothing to create';
        }
        // return response()->json($response);
        return view('createuser', ['response' => $response]);
    }


    public function updateUser(Request $request)
    {
        $user = User::find($request->id);
        if (isset($request) && !empty($user)) {
            try {
                $user->email = $request->email ? $request->email : $user->email;
                $user->password = $request->password ? hash('sha256', $request->password) : $user->password;
                $user->user_name = $request->user_name ? $request->user_name : $user->user_name;
                $user->location = $request->location ? $request->location : $user->location;
                $user->picture = $request->picture ? $request->picture : $user->picture;
                $user->active = $request->active ? $request->active : $user->active;
                $user->admin_user = $request->admin_user ? $request->admin_user : $user->admin_user;
                $user->save();
                $msg = 'User updated';
            } catch (\Exception $exception) {
                $msg = $exception->getMessage();
            }
        } else {
            $msg = 'Nothing to update';
        }
        $users = User::all();
        $response = array('code' => 200, 'users' => $users, 'msg' => $msg);
        // return response()->json($response);
        return view('updateuser', ['responseUsers' => $response]);
    }

    public function getUser($id)
    {
        $response = array('code' => 400, 'error_msg' => []);
        if (isset($id)) {
            try {
                $user = User::where('id', '=', $id)->get(['id', 'name', 'email', 'user_name', 'address', 'telephone_number', 'picture']);
            } catch (\Exception $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
            if (count($user) > 0) {
                $response = array('code' => 200, 'User' => $user);
            } else {
                $response = array('code' => 404, 'error_msg' => ['User not found']);
            }
        }
        return response()->json($response);
    }

    public function deleteUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!empty($user)  && $request->user('api')->admin_user === 1) {
            try {
                $user->delete();
                $response = array('code' => 200, 'msg' => 'User deleted');
            } catch (\Exception $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
        } else {
            $response = array('code' => 401, 'error_msg' => 'Unautorized');
        }
        return response()->json($response);
    }




    public function getUsers()
    {
        try{
            $users = User::orderBy('id', 'asc')->paginate(2)->onEachSide(2);
            $response = array('code' => 200, 'users' => $users);
        } catch (\Exception $exception){
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }

        return view('updateuser', ['responseUsers' => $response]);
    }
}
