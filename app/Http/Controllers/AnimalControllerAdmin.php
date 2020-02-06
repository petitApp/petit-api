<?php

namespace App\Http\Controllers;

use App\Animals;
use Illuminate\Http\Request;

class AnimalControllerAdmin extends Controller
{

    //Paginated request of all animals
    public function getAnimalsAdmin()
    {
        $response = array('code' => 400, 'error_msg' => []);
        
        try {
            $animals = Animals::orderBy('id', 'asc')->paginate(5)->onEachSide(2);
            if (count($animals) > 0) {
                $response = array('code' => 200, 'animals' => $animals);
            } else {
                $response = array('code' => 404, 'error_msg' => ['animals not found']);
            }
        } catch (\Exception $exception) {
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }

        return view('updateanimal', ['responseAnimals' => $response]);
    }

    //Paginated creation of an animal
    public function createAnimalAdmin(Request $request)
    {
        $response = array('code' => 400, 'error_msg' => []);

        if (isset($request)) {
            if (!$request->name) array_push($response['error_msg'], 'Name is required');
            if (!$request->type) array_push($response['error_msg'], 'Type is required');
            if (!$request->sex) array_push($response['error_msg'], 'Sex or gender is required');
            if (!$request->age) array_push($response['error_msg'], 'Age is required');
            if (!$request->location) array_push($response['error_msg'], 'Location is required');
            if (!$request->description) array_push($response['error_msg'], 'Description is required');
            if (!$request->prefered_photo) array_push($response['error_msg'], 'Prefered_photo is required');
            if (!$request->id_owner) array_push($response['error_msg'], 'Owner id is required');
            if (!$request->file('picture')) {
                array_push($response['error_msg'], 'Picture is required');
            } else {
                $path = $request->file('picture')->store("picture");
            };

            if (!count($response['error_msg']) > 0) { //TODO - cambiar esto
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
                    $animal->prefered_photo = $request->prefered_photo;
                    $animal->prefered_photo = $path;
                    $animal->breed = $request->breed ? $request->breed : null;
                    $animal->save();
                    $response = array('code' => 200, 'animal' => $animal, 'msg' => 'Animal created');
                }catch (\Exception $exception) {
                    $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                }
            }

        } else {
            $response['error_msg'] = 'Nothing to create';
        }

        return view('createanimal', ['response' => $response]);
    }

    //Paginated update of an specific animal
    public function updateAnimalAdmin(Request $request)
    {
        $response = array('code' => 400, 'error_msg' => []);

        
        if (isset($request)){ 

            //TODO - TO TEST
            try {
                $animal = Animals::find($request->id);
            
                if(!empty($animal)) {
                    try {
                        $animal->name = $request->name ? $request->name : $animal->name;
                        $animal->type = $request->type ? $request->type : $animal->type;
                        $animal->sex = $request->sex ? $request->sex : $animal->sex;
                        $animal->age = $request->age ? $request->age : $animal->age;
                        $animal->location = $request->location ? $request->location : $animal->location;
                        $animal->description = $request->description ? $request->description : $animal->description;
                        $animal->prefered_photo = $request->prefered_photo ? $request->prefered_photo : $animal->prefered_photo;
                        $animal->breed = $request->breed ? $request->breed : $animal->breed;
                        $animal->save();
                        $response = array('code' => 200, 'msg' => 'Animal updated');
                    } catch (\Exception $exception) {
                        $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                    }

                } else {
                    $response =  array('code' => 404, 'error_msg' => 'Animal not found');
                }

            } catch (\Throwable $th) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }

        } else {
            $response['error_msg'] = 'Nothing to update';
        }
        
        //Pagination 
        try {
            $animals = Animals::orderBy('id', 'asc')->paginate(5)->onEachSide(2);
            $response["animals"] = $animals;
        } catch (\Exception $exception) {
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }
      
        return view('updateanimal', ['responseAnimals' => $response]);
    }

}