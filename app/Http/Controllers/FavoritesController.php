<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animals;
use App\User;
use App\User_Favorite;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
{
    public function createFavoriteAnimal(Request $request)
    {
        $response = array('code' => 400, 'error_msg' => []);

        try {
            $favorite = new User_Favorite();
            $favorite->id_animal = $request->id_animal;
            $favorite->id_user = $request->id_user;

            $favorite->save();
            $response = array('code' => 200, 'animal' => $favorite, 'msg' => 'Favorite created');
        } catch (\Exception $exception) {
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }
        return response($response, $response['code']);
    }
    public function deleteFavoriteAnimal(Request $request)
    {
        $response = array('code' => 400, 'error_msg' => []);
        try {
            $favorite = User_Favorite::find($request->id);
            if (!empty($favorite)) {
                try {
                    $favorite->delete();
                    $response = array('code' => 200, 'animal' => $favorite, 'msg' => 'Favorite created');
                } catch (\Exception $exception) {
                    $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                }
            } else {
                $response = array('code' => 401, 'error_msg' => 'Unautorized');
            }
        } catch (\Exception $exception) {
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }
        return response($response, $response['code']);
    }

    public function getAllFavoritesByUser($id)
    {
        $response = array('code' => 400, 'error_msg' => []);
        try {
            $user = User::find($id);
            if (!empty($user)) {
                $response = ['user_favorite' => $user->id, 'animals' => []];
                $animals = $user->petsFavorites;
                return   $response = array('code' => 200, 'animal' => $animals, 'msg' => 'Favorite created');
            } else {
                $response = array('code' => 401, 'error_msg' => 'Unautorized');
            }
        } catch (\Exception $exception) {
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }
        return response($response, $response['code']);
    }
}
