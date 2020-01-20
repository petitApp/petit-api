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
}
