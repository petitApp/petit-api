<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animals;
use App\User;
use App\User_Favorite;
use Illuminate\Support\Facades\DB;
class FavoritesController extends Controller
{
    public function createFavoriteAnimal(Request $request){
        $response = array('code' => 400, 'error_msg' => []);

        try {
                $favorite = new User_Favorite();
                $favorite->id_animal = $request->id_animal;
                $favorite->id_user = $request->id_user;

                $favorite->save();
                $response = array('code' => 200, 'animal' => $favorite, 'msg' => 'Favorite created');

        }catch(\Exception $exception) {
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }
        return response($response,$response['code']);
    }
    public function deleteFavoriteAnimal(Request $request){
     
            try{
                $favorite = User_Favorite::find($request->id);
                    if(!empty($favorite)){
                    try{
                        $favorite->delete();
                        $response = array('code' => 200, 'animal' => $favorite, 'msg' => 'Favorite created');

                        }catch(\Exception $exception) {
                        $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                        }

                    }else {
                        $response = array('code' => 401, 'error_msg' => 'Unautorized');
                    }
            }catch (\Exception $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
                        
                            
                
     return response($response,$response['code']);
    }

   public function getAllFavoritesByUser(Request $request){

    $response = array('error_code' => 404, 'error_msg' => 'Favorite '.$request->id_user.' not found');

    $user = User::find($request->id_user);


    if(!empty($user)){
        $response = ['user_favorite' => $user->id, 'animals' => []];
        $animals = $user->petsFavorites;
   
        if (is_array($animals) || is_object($animals)){
            foreach ($animals as $animal) {
                $response['animal'][] = [
                    'id' => $animal->id,
                    'name' => $animal->name,
                    'type' => $animal->type,
                    'sex' => $animal->sex,
                    'age' => $animal->age,
                    'longitude' => $animal->longitude,
                    'latitude' => $animal->latitude,
                    'description' => $animal->description,
                    'id_owner' => $animal->id_owner,
                    'picture' => $animal->prefered_photo
                ];
            }
        }
      
    }
    return response()->json($response);
   }
   
}
