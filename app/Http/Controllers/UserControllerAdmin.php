<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

//Controller to manage users from the administrator panel
class UserControllerAdmin extends Controller {
    //Paginated request of all users
    public function getUsersAdmin() {
        //Response initiallization
        $response = array('code' => 400, 'error_msg' => []);
        
        try {
            //Request of all users
            $users = User::orderBy('id', 'asc')->paginate(5)->onEachSide(2);
            if (count($users) > 0) {
                //Success response
                $response = array('code' => 200, 'users' => $users);
            } else {
                //Users not found response 
                $response = array('code' => 404, 'error_msg' => ['users not found']);
            }
        } catch (\Exception $exception) {
            //Internal server error response
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }

        //Return the users view with the response data in order to show a all users filtered, paginated and ordered by ÍD
        return view('users', ['response' => $response]);
    }

    //Get request of an user by a given ID
    public function getUserById($id) {
        //Check id the function is receiving parameters
        if(isset($id)){
            try {
                //request by id of the user
                $user = User::find($id);
                //Success response
                $response = array('code' => 200, 'user' => $user);
            } catch (\Throwable $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }

            //Return the updateuser view with the response data in order to populate it
            return view('updateuser', ['response' => $response]);
        } else {
            //No parameters received
            $response['error_msg'] = 'Nothing to get';
        }
    }

    //TODO - check creation of admins and users - token hash differences
    //Request to create a new user 
    public function createUser(Request $request) {
        //Initiallization of the response array
        $response = array('code' => 400, 'error_msg' => []);

        //Check if the function is receiving parameters
        if (isset($request)) {
            //Check if all the required fields aren't empty
            if (!$request->email) array_push($response['error_msg'], 'Email is required');
            if (!$request->password) array_push($response['error_msg'], 'Password is required');
            if (!$request->user_name) array_push($response['error_msg'], 'User name is required');
            if (!$request->picture) {
                array_push($response['error_msg'], 'Main picture is required');
            } else {
                //Setpath-of-the-ome-files 
                $path = $request->file('picture')->store("picture");
            };
            if (!count($response['error_msg']) > 0) {
                
                //TODO - TO TEST
                try {
                    $user = User::where('email', '=', $request->email);

                    if (!$user->count()) {
                        try {
                            //Try to create the user
                            $user = new User();
                            $user->email = $request->email;
                            $user->password = hash('sha256', $request->password);
                            $user->user_name = $request->user_name;
                            $token = uniqid() . $user->email;
                            $user->token = hash('sha256', $token);
                            $user->picture = $path;
                            $user->save();

                            //Success response
                            $response = array('code' => 200, 'user' => $user, 'msg' => 'User created');
                        } catch (\Exception $exception) {
                            //Internal server error response
                            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                        }

                    } else {
                        //Email already registered response
                        $response = array('code' => 400, 'error_msg' => "Email already registered");
                    }

                } catch (\Throwable $th) {
                    //Internal server error response
                    $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                }

            } else {
                $response['error_msg'] = 'Please introduce the required data';
            }

        } else {
            //No parameters received
            $response['error_msg'] = 'Nothing to create';
        }
        //Return the createuser view again with the response data in order to show a created user in the moment
        return view('createuser', ['response' => $response]);
    }

    //Request to update only the fields edited of an specific user
    public function updateUserById(Request $request, $id) {
        //Check if the function is receiving parameters 
        if (isset($request)){ 
            try {
                //Get by id of the user
                $user = User::find($id);
                //Chec if User is not empty
                if(!empty($user)) {
                    try {
                        //Update values if they are not null
                        $user->email = $request->email ? $request->email : $user->email;
                        $user->password = $request->password ? hash('sha256', $request->password) : $user->password;
                        $user->user_name = $request->user_name ? $request->user_name : $user->user_name;
                        $user->latitude = $request->latitude ? $request->latitude : $user->latitude;
                        $user->longitude = $request->longitude ? $request->longitude : $user->longitude;
                        //Picture treatment
                        if (!$request->picture) {
                            //TODO mirar si realmente es necesaria esta comprobación
                            if (!$user->picture){
                                //array_push($response['error_msg'], 'Main picture is required');
                            } else {
                                $user->picture = $user->picture;
                            }
                        } else {
                            //Set path of the ome files 
                            $path = $request->file('picture')->store("public/picture");
                            //Get the real route of the image
                            //It will be storaged in a private folder with a symlink so the we get the public route of the file in order to show it later
                            $user->picture = substr($path, 6);
                        };
                        $user->active = $request->active ? $request->active : $user->active;
                        $user->admin_user = $request->admin_user ? $request->admin_user : $user->admin_user;
                        $user->save();

                        //TODO - mirar si realmente es necesario devolver mensajes de error al administrador
                        $msg = 'User updated';

                        //Success response
                        $response = array('code' => 200, 'user' => $user, 'msg' => $msg);
                    } catch (\Exception $exception) {
                        //Internal server error response
                        $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                    }

                } else {
                    //User not found response
                    $response =  array('code' => 404, 'error_msg' => 'User not found');
                }

            } catch (\Throwable $exception) {
                //Internal server error response
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }

        } else {
            //Not receiving parameters response
            $response['error_msg'] = 'Nothing to update';
        }

        //Return the updateUser view again with the response data in order to show the result of the User update in the moment
        return view('updateuser', ['response' => $response]);      
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
