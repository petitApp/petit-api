<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    
    public function generateToken(Request $request, $id)
    {
        if (isset($request) && isset($id)) {
            $response = array('code' => 400, 'error_msg' => []);
            try {
                $user = User::find($id);
                $token = $request->api_token;
                $user->token = hash('sha256', $token);
                $user->save();
                $response = array('code' => 200, 'msg' => 'Token Generated');
            } catch (\Exception $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
        } else {
            $response['error_msg'] = 'Nothing to create';
        }
        return response()->json($response);
    }
    public function createUser(Request $request)
    {
        $response = array('code' => 400, 'error_msg' => []);
        if (isset($request)) {
            if (!$request->email) array_push($response['error_msg'], 'Email is required');
            if (!$request->password) array_push($response['error_msg'], 'Password is required');
            if (!$request->user_name) array_push($response['error_msg'], 'User name is required');
            if (!count($response['error_msg']) > 0) {
                try {
                    $user = new User();
                    $user->email = $request->email;
                    $user->password = hash('sha256', $request->password);
                    $user->user_name = $request->user_name;
                    $user->save();
                    $response = array('code' => 200, 'user' => $user, 'msg' => 'User created');
                } catch (\Exception $exception) {
                    $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                }
            }
        } else {
            $response['error_msg'] = 'Nothing to create';
        }
        return response()->json($response);
    }


    public function updateUser(Request $request, $id)
    {
        $response = array('code' => 400, 'error_msg' => []);
        $user = User::find($id);
        if (isset($request) && isset($id) && !empty($user)) {
                try {
                    $user->email = $request->email ? $request->email : $user->email;
                    $user->password = $request->password ? hash('sha256', $request->password): $user->password;
                    $user->user_name = $request->user_name ? $request->user_name : $user->user_name;
                    $user->location = $request->location ? $request->location : $user->location;
                    $user->picture = $request->picture ? $request->picture : $user->picture;
                    $user->save();
                    $response = array('code' => 200, 'msg' => 'User updated');
                } catch (\Exception $exception) {
                    $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                }
            
        } else {
            $response['error_msg'] = 'Nothing to update';
        }
        return response()->json($response);
    }

    public function getUser($id)
    {
        $response = array('code' => 400, 'error_msg' => []);
        if (isset($id)) {
            try {
            $user = User::where('id', '=', $id)->get(['id', 'name', 'email','user_name','address','telephone_number','picture']);
            } catch (\Exception $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
            if (count($user)>0) {
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


    public function loginUser(Request $request)
    {
        $response = array('code' => 400, 'error_msg' => []);
        if($request->email && $request->password){
            $user = User::where('email', "$request->email")->first();
            if (!empty($user) && $user->password === hash('sha256', $request->password)) {
                    try {
                        $token = uniqid().$user->email;
                        $user->token = hash('sha256', $token);
                        $user->save();
                        $response = array('code' => 200, 'user' => $user);
                    } catch (\Exception $exception) {
                        $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                    }
                
            } else {
                $response['error_msg'] = 'User not found';
            } 
        } else {
            $response['error_msg'] = 'Email and password are required';
        } 
        
        return response()->json($response);

    }

    public function getUsers()
    {
       return User::all();
    }
}
