<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class apiController extends Controller
{
        /** 
         * Retornar a lista de usuários
         * @return JsonResponse Retorna os usuários
         */

         
    public function index(): JsonResponse{
        return response()->json([
            'status' => true,
            'users' => "Lista usuários"
        ], 200);
    }
}
