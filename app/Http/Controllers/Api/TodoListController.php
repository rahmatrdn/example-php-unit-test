<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function getAll() : JsonResponse {
        
        return response()->json([
            'status' => 'success',
        ]);
    }
}
