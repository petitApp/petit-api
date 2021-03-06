<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

//Controller to manage users from the administrator panel
class UserControllerAdmin extends Controller
{
    //Paginated creation of an user
    public function createUser(Request $request)
    {
        $response = array('code' => 400, 'error_msg' => []);

        if (isset($request)) {
            if (!$request->email) array_push($response['error_msg'], 'Email is required');
            if (!$request->password) array_push($response['error_msg'], 'Password is required');
            if (!$request->user_name) array_push($response['error_msg'], 'User name is required');
            if (!count($response['error_msg']) > 0) {
                
                //TODO - TO TEST
                try {
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

                } catch (\Throwable $th) {
                    $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                }

            } else {
                $response['error_msg'] = 'Please introduce the required data';
            }

        } else {
            $response['error_msg'] = 'Nothing to create';
        }

        return view('createuser', ['response' => $response]);
    }

    //Paginated update of an specific user
    public function updateUser(Request $request)
    {
        if (isset($request)) {

            if (!$request->file('picture')) {
                array_push($response['error_msg'], 'Picture is required');
            } else {
                $path = $request->file('picture')->store("picture");
            };

            //TODO - TO TEST
            try {
                $user = User::find($request->id);

                if (!empty($user)) {
                    try {
                        $user->email = $request->email ? $request->email : $user->email;
                        $user->password = $request->password ? hash('sha256', $request->password) : $user->password;
                        $user->user_name = $request->user_name ? $request->user_name : $user->user_name;
                        $user->latitude = $request->latitude ? $request->latitude : $user->latitude;
                        $user->latitude = $request->longitude ? $request->longitude : $user->longitude;
                        $user->picture = $path;
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

            } catch (\Throwable $th) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }

        }

        //Pagination
        try {
            $users = User::orderBy('id', 'asc')->paginate(5)->onEachSide(2);
            $response = array('code' => 200, 'users' => $users, 'msg' => $msg);
        } catch (\Throwable $th) {
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }

        return view('updateuser', ['responseUsers' => $response]);
    }

    //Get an specific user from a given id 
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

    //Delete an specific user from a given id 
    public function deleteUser(Request $request, $id)
    {
        //TODO - TO TEST
        if (isset($request) && isset($id)) {

            try {
                $user = User::find($id);

                if (!empty($user) && $request->user('api')->admin_user === 1) {
                    try {
                        $user->delete();
                        $response = array('code' => 200, 'msg' => 'User deleted');
                    } catch (\Exception $exception) {
                        $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                    }
                } else {
                    $response = array('code' => 401, 'error_msg' => 'Unautorized');
                }

            } catch (\Throwable $th) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }

        } else {
            $response['error_msg'] = 'Nothing to create';
        }

        return response()->json($response);
    }

    //Get all users from database 
    public function getUsers()
    {
        $response = array('code' => 400, 'error_msg' => []);

        try{
            $users = User::orderBy('id', 'asc')->paginate(5)->onEachSide(2);
            $response = array('code' => 200, 'users' => $users);
        } catch (\Exception $exception){
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }

        return view('updateuser', ['responseUsers' => $response]);
    }
}
