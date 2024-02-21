<?php

namespace App\Repositories;

use App\Entities\ResponseEntity;
use App\Entities\TodoList;
use App\Entities\TodoListEntity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TodoListRepository
{
    public function getAll(): array
    {
        try {
            $data = DB::select('SELECT * FROM todo_lists');

            $response = [
                'status' => ResponseEntity::SUCCESS,
                'data'   => $data,
            ];
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            $response = [
                'status'        => ResponseEntity::ERROR,
                'error_message' => 'Failed to get data from database.',
                'code'          => 500,
            ];
        }

        return $response;
    }

    public function create(TodoListEntity $data): array
    {
        try {
            DB::table('todo_lists')->insert([
                'title'       => $data->title,
                'description' => $data->description,
                'doing_at'    => $data->doing_at,
                'created_at'  => $data->createdAt,
                'updated_at'  => $data->updatedAt,
            ]);

            $response = [
                'status' => ResponseEntity::SUCCESS,
            ];
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            $response = [
                'status'        => ResponseEntity::ERROR,
                'error_message' => 'Failed to insert data to database.',
                'code'          => 500,
            ];
        }

        return $response;
    }
}
