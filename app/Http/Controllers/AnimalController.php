<?php

namespace App\Http\Controllers;

use App\Animals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


//Controller to manage all animals functionality from the app
class AnimalController extends Controller
{
    //Create an animal with relative data
    public function createAnimal(Request $request)
    {
        $response = array('code' => 400, 'error_msg' => []);

        if (isset($request)) {
            if (!$request->name) array_push($response['error_msg'], 'Name is required');
            if (!$request->type) array_push($response['error_msg'], 'Type is required');
            if (!$request->sex) array_push($response['error_msg'], 'Sex or gender is required');
            if (!$request->age) array_push($response['error_msg'], 'Age is required');
            if (!$request->longitude) array_push($response['error_msg'], 'Longitude is required');
            if (!$request->latitude) array_push($response['error_msg'], 'Latitude is required');
            if (!$request->description) array_push($response['error_msg'], 'Description is required');
            if (!$request->id_owner) array_push($response['error_msg'], 'Owner id is required');
            if (!$request->file('picture')) {
                array_push($response['error_msg'], 'Picture is required');
            } else {
                $path = $request->file('picture')->store("picture");
            };

            if (!count($response['error_msg']) > 0) { //cambiar esto
                try {
                    $animal = new Animals();
                    $animal->id_owner = $request->id_owner;
                    $animal->name = $request->name;
                    $animal->type = $request->type;
                    $animal->sex = $request->sex;
                    $animal->age = $request->age;
                    $animal->latitude = $request->latitude;
                    $animal->longitude = $request->longitude;
                    $animal->description = $request->description;
                    $animal->prefered_photo = $path;
                    $animal->breed = $request->breed ? $request->breed : null;
                    $animal->save();
                    $response = array('code' => 200, 'animal' => $animal, 'msg' => 'Animal created');
                } catch (\Exception $exception) {
                    $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                }
            }
        } else {
            $response['error_msg'] = 'Nothing to create';
        }

        return response($response, $response['code']);
    }

    //Modify fields of an specific animal by ID 
    public function updateAnimal(Request $request, $id)
    {
        $response = array('code' => 400, 'error_msg' => []);

        if (isset($request) && isset($id)) {
            //TODO - TO TEST
            try {
                $animal = Animals::find($id);

                if (!empty($animal)) {
                    try {
                        $animal->name = $request->name ? $request->name : $animal->name;
                        $animal->type = $request->type ? $request->type : $animal->type;
                        $animal->sex = $request->sex ? $request->sex : $animal->sex;
                        $animal->age = $request->age ? $request->age : $animal->age;
                        $animal->latitude = $request->latitude ? $request->latitude : $animal->latitude;
                        $animal->longitude = $request->longitude ? $request->longitude : $animal->longitude;
                        $animal->description = $request->description ? $request->description : $animal->description;

                        //TODO - Find another way 
                        if ($request->file('picture')) {
                            $path = $request->file('picture')->store("picture");
                            $animal->prefered_photo = $path;
                        }


                        $animal->breed = $request->breed ? $request->breed : $animal->breed;
                        $animal->save();
                        $response = array('code' => 200, 'msg' => 'Animal updated');
                    } catch (\Exception $exception) {
                        $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                    }
                } else {
                    $response['error_msg'] = 'No animal to update';
                }
            } catch (\Throwable $th) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
        } else {
            $response['error_msg'] = 'Nothing to update';
        }

        return response($response, $response['code']);
    }

    //Get an specific animal by ID
    public function getAnimal($id)
    {
        $response = array('code' => 400, 'error_msg' => []);

        if (isset($id)) {
            try {
                $animal = Animals::find($id);
            } catch (\Exception $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }

            if ($animal !== null) {
                $response = array('code' => 200, 'animal' => $animal);
            } else {
                $response = array('code' => 404, 'error_msg' => ['Animal not found']);
            }
        }

        return response($response, $response['code']);
    }

    //Delete an specific user by ID
    public function deleteAnimal(Request $request, $id)
    {
        if (isset($request) && isset($id)) {
            //TODO - TO TEST
            try {
                $animal = Animals::find($id);

                if (!empty($animal) && $request->user('api')->admin_user === 1) {
                    try {
                        $animal->delete();
                        $response = array('code' => 200, 'msg' => 'Animal deleted');
                    } catch (\Exception $exception) {
                        $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                    }
                } else {
                    $response = array('code' => 401, 'error_msg' => 'Unautorized');
                }
            } catch (\Throwable $th) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
        }

        return response($response, $response['code']);
    }

    //Get all animals function
    public function getAllAnimals()
    {
        $response = array('code' => 400, 'error_msg' => []);

        try {
            $animals = Animals::all(['id', 'name', 'id_owner', 'type', 'sex', 'age', 'latitude', 'longitude', 'description', 'prefered_photo', 'breed']);
            if (count($animals) > 0) {
                $response = array('code' => 200, 'animals' => $animals);
            } else {
                $response = array('code' => 404, 'error_msg' => ['animals not found']);
            }
        } catch (\Exception $exception) {
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }

        return response($response, $response['code']);
    }

    public function getAnimalByType($type)
    {
 $response = array('code' => 400, 'error_msg' => []);
        if (isset($type)) {
           
            try {
                $animals = DB::table('animals')
                    ->where('type', '=', $type)->get();
                if (count($animals) > 0) {
                    $response = array('code' => 200, 'animals' => $animals);
                } else {
                    $response = array('code' => 404, 'error_msg' => ['animals not found']);
                }
            } catch (\Exception $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
           
        }else{

        } 
        return response($response, $response['code']);
    }

    public function getAnimalByBreed($breed)
    {
        $response = array('code' => 400, 'error_msg' => []);
        if (isset($breed)) {
           
            try {
                $animals = DB::table('animals')
                    ->where('breed', '=', $breed)->get();
                if (count($animals) > 0) {
                    $response = array('code' => 200, 'animals' => $animals);
                } else {
                    $response = array('code' => 404, 'error_msg' => ['animals not found']);
                }
            } catch (\Exception $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
        }
        else{
            array_push($response['error_msg'], 'Breed is required');
        }
        return response($response, $response['code']);
    }

    public function getAnimalByAge($age)
    {  
        $response = array('code' => 400, 'error_msg' => []);
        if (isset($age)) {
          
            try {
                $animals = DB::table('animals')
                    ->where('age', '=', $age)->get();
                if (count($animals) > 0) {
                    $response = array('code' => 200, 'animals' => $animals);
                } else {
                    $response = array('code' => 404, 'error_msg' => ['animals not found']);
                }
            } catch (\Exception $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
            
        }else{
            array_push($response['error_msg'], 'Age is required');
        }
        return response($response, $response['code']);
    }
    public function getAnimalByDistance($latitude, $longitude, $distance)
    {
        $response = array('code' => 400, 'error_msg' => []);
        
        if (isset($latitude) && isset($longitude) && isset($distance)) {
            try {

                $animals = Animals::selectRaw('*, ( 6367 * acos( cos( radians( ? ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( latitude ) ) ) ) AS distance', [$latitude, $longitude, $latitude])
                    ->having('distance', '<', $distance)
                    ->orderBy('distance')
                    ->get();
                if (count($animals) > 0) {
                    $response = array('code' => 200, 'animals' => $animals);
                } else {
                    $response = array('code' => 404, 'error_msg' => ['animals not found']);
                }
            } catch (\Exception $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
        }else{
            array_push($response['error_msg'], 'Distance is required');
        }
        return response($response, $response['code']);
    }
}
