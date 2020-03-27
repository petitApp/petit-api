<?php

namespace App\Http\Controllers;

use App\Animals;
use Illuminate\Http\Request;

class AnimalControllerAdmin extends Controller {
    //Paginated request of all animals
    public function getAnimalsAdmin() {
        //Response initiallization
        $response = array('code' => 400, 'error_msg' => []);
        
        try {
            //Request of all animals
            $animals = Animals::orderBy('id', 'asc')->paginate(5)->onEachSide(2);
            if (count($animals) > 0) {
                //Success response
                $response = array('code' => 200, 'animals' => $animals);
            } else {
                //Animals not found response 
                $response = array('code' => 404, 'error_msg' => ['animals not found']);
            }
        } catch (\Exception $exception) {
            //Internal server error response
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }

        //Return the animals view with the response data in order to show a all animals filtered, paginated and ordered by ÍD
        return view('animals', ['response' => $response]);
    }

    //Get request of an animal by a given ID.
    public function getAnimalById($id) {
        //Check if the function is receiving parameters
        if (isset($id)){
            try {
                //Request by id of the animal
                $animal = Animals::find($id);
                //Success response
                $response = array('code' => 200, 'animal' => $animal);
            } catch (\Throwable $exception) {
                //Internal server error response
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
    
            //Return the updateanimal view with the response data in order to populate it
            return view('updateanimal', ['response' => $response]);
        } else {
            //No parameters received
            $response['error_msg'] = 'Nothing to get';
        }
    }

    //Request to create a new animal
    public function createAnimalAdmin(Request $request) {
        //Initiallization of the response array
        $response = array('code' => 400, 'error_msg' => []);

        //Check if the function is receiving parameters
        if (isset($request)) {
            //Check if all the required fields aren't empty
            if (!$request->name) array_push($response['error_msg'], 'Name is required');
            if (!$request->type) array_push($response['error_msg'], 'Type is required');
            if (!$request->sex) array_push($response['error_msg'], 'Sex or gender is required');
            if (!$request->age) array_push($response['error_msg'], 'Age is required');
            if (!$request->longitude) array_push($response['error_msg'], 'Longitude is required');
            if (!$request->latitude) array_push($response['error_msg'], 'Latitude is required');
            if (!$request->description) array_push($response['error_msg'], 'Description is required');
            if (!$request->id_owner) array_push($response['error_msg'], 'Owner id is required');
            if (!$request->picture) {
                array_push($response['error_msg'], 'Prefered photo is required');
            } else {
                //Setpath-of-the-ome-files 
                $path = $request->file('prefered_photo')->store("prefered_photo");
            };

            //Check if errors array is not bigger than the 0 value
            if (!count($response['error_msg']) > 0) { //TODO - cambiar esto - TO TEST
                try {
                    //Try to create the animal
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

                    //Check if array of pictures exists and it has values before adding the images
                    if (!empty($request->images) && count($request->images) > 0){
                        //Call to addImages function in orther to add new images to the user
                        AnimalController::addImages($animal, $request->images);
                        $animalPicture->picture = $request->images;
                        die($animalPicture->picture);
                    }
                
                    //Success response
                    $response = array('code' => 200, 'animal' => $animal,'aniamlPicture' => $animalPicture, 'msg' => 'Animal created');
                }catch (\Throwable $exception) {
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

        //Return the createanimal view again with the response data in order to show a created animal in the moment
        return view('createanimal', ['response' => $response]);
    }

    //Request to update some fields of a new animal
    public function updateAnimalById(Request $request, $id) {
        //Check if the function is receiving parameters 
        if (isset($request)){ 
            try {
                //Get by id of the animal
                $animal = Animals::find($id);
                //Chec if animal is not empty
                if(!empty($animal)) {
                    try {
                        //Update values if they are not null
                        $animal->name = $request->name ? $request->name : $animal->name;
                        $animal->type = $request->type ? $request->type : $animal->type;
                        $animal->sex = $request->sex ? $request->sex : $animal->sex;
                        $animal->age = $request->age ? $request->age : $animal->age;
                        $animal->latitude = $request->latitude ? $request->latitude : $animal->latitude;
                        $animal->longitude = $request->longitude ? $request->longitude : $animal->longitude;
                        $animal->description = $request->description ? $request->description : $animal->description;
                        //prefered_photo treatment
                        if (!$request->prefered_photo) {
                            //TODO mirar si realmente es necesaria esta comprobación
                            if (!$animal->prefered_photo){
                                array_push($response['error_msg'], 'Main picture is required');
                            } else {
                                $animal->prefered_photo = $animal->prefered_photo;
                            }
                        } else {
                            //Set path of the ome files 
                            $path = $request->file('prefered_photo')->store("public/prefered_photo");
                            //Get the real route of the image
                            //It will be storaged in a private folder with a symlink so the we get the public route of the file in order to show it later
                            $animal->prefered_photo = substr($path, 6);
                        };
                            $animal->breed = $request->breed ? $request->breed : $animal->breed;
                            $animal->save();

                            $response = array('code' => 200,'animal' => $animal, 'msg'=> 'succes operation');

                        //Check if array of pictures exists and it has values before adding the images
                        if (!empty($request->images) && count($request->images) > 0){
                            //Call to the addimages function after the user is already created in order to add it's relative images
                            $response = AnimalController::addImages($animal, $request->images);
                        }
                        
                    } catch (\Exception $exception) {
                        //Internal server error response
                        $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                    }

                } else {
                    //User not found response
                    $response =  array('code' => 404, 'error_msg' => 'Animal not found');
                }

            } catch (\Throwable $exception) {
                //Internal server error response
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }

        } else {
            //Not receiving parameters response
            $response['error_msg'] = 'Nothing to update';
        }

        //Return the updateanimal view again with the response data in order to show the result of the animal update in the moment
        return view('updateanimal', ['response' => $response]);      
    }

}