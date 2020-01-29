<?php

namespace App\Http\Controllers;

use App\Animals;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function createAnimal(Request $request)
    {
        $response = array('code' => 400, 'error_msg' => []);
        if (isset($request)) {
            if (!$request->name) array_push($response['error_msg'], 'Name is required');
            if (!$request->id_type) array_push($response['error_msg'], 'Type is required');
            if (!$request->sex) array_push($response['error_msg'], 'Sex or gender is required');
            if (!$request->age) array_push($response['error_msg'], 'Age is required');
            if (!$request->location) array_push($response['error_msg'], 'Location is required');
            if (!$request->description) array_push($response['error_msg'], 'Description is required');
            if (!$request->prefered_photo) array_push($response['error_msg'], 'Prefered_photo is required');
            if (!$request->id_owner) array_push($response['error_msg'], 'Owner id is required');
            if (!count($response['error_msg']) > 0) { //cambiar esto
                try {
                    $animal = new Animals();
                    $animal->id_owner = $request->id_owner;
                    $animal->name = $request->name;
                    $animal->id_type = $request->id_type;
                    $animal->sex = $request->sex;
                    $animal->age = $request->age;
                    $animal->location = $request->location;
                    $animal->description = $request->description;
                    $animal->prefered_photo = $request->prefered_photo;
                    $animal->id_breed = $request->id_breed ? $request->id_breed : null;
                    $animal->save();
                    $response = array('code' => 200, 'animal' => $animal, 'msg' => 'Animal created');
                } catch (\Exception $exception) {
                    $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                }
            }
        } else {
            $response['error_msg'] = 'Nothing to create';
        }
        return response()->json($response);
    }
    public function updateAnimal(Request $request, $id)
    {
        $response = array('code' => 400, 'error_msg' => []);
        $animal = Animals::find($id);
        if (isset($request) && isset($id) && !empty($animal)) {
            try {
                $animal->name = $request->name ? $request->name : $animal->name;
                $animal->id_type = $request->id_type ? $request->id_type : $animal->id_type;
                $animal->sex = $request->sex ? $request->sex : $animal->sex;
                $animal->age = $request->age ? $request->age : $animal->age;
                $animal->location = $request->location ? $request->location : $animal->location;
                $animal->description = $request->description ? $request->description : $animal->description;
                $animal->prefered_photo = $request->prefered_photo ? $request->prefered_photo : $animal->prefered_photo;
                $animal->id_breed = $request->id_breed ? $request->id_breed : $animal->id_breed;
                $animal->save();
                $response = array('code' => 200, 'msg' => 'Animal updated');
            } catch (\Exception $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
        } else {
            $response['error_msg'] = 'Nothing to update';
        }
        return response()->json($response);
    }

    public function getAnimal($id)
    {
        $response = array('code' => 400, 'error_msg' => []);
        if (isset($id)) {
            try {
                $animal = Animals::find($id);
            } catch (\Exception $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
            if ($animal!==null) {
                $response = array('code' => 200, 'animal' => $animal);
            } else {
                $response = array('code' => 404, 'error_msg' => ['Animal not found']);
            }
        }
        return response()->json($response);
    }
    public function deleteUser(Request $request, $id)
    {
        $animal = Animals::find($id);
        if (!empty($user)  && $request->user('api')->admin_user === 1) {
            try {
                $animal->delete();
                $response = array('code' => 200, 'msg' => 'Animal deleted');
            } catch (\Exception $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
        } else {
            $response = array('code' => 401, 'error_msg' => 'Unautorized');
        }
        return response()->json($response);
    }

    public function getAllAnimals()
    {
        $response = array('code' => 400, 'error_msg' => []);
        try {
            $animals = Animals::all(['id', 'name', 'id_owner', 'id_type', 'sex', 'age', 'location', 'description', 'prefered_photo', 'id_breed']);
            if (count($animals) > 0) {
                $response = array('code' => 200, 'animals' => $animals);
            } else {
                $response = array('code' => 404, 'error_msg' => ['animals not found']);
            }
        } catch (\Exception $exception) {
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }
        return response()->json($response);
    }

    public function getAllAnimalsPaginated() 
    {
        //$animals = Animals::all(['id', 'name', 'id_owner', 'id_type', 'sex', 'age', 'location', 'description', 'prefered_photo', 'id_breed']);
        $animals = Animals::orderBy('id', 'asc')->paginate(2)->onEachSide(2);

        return view('defaultPaginated', compact('animals'));        
    }


}
