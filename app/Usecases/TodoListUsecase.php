<?php

namespace App\Usecases;

use App\Entities\ResponseEntity;
use App\Entities\TodoList;
use App\Entities\TodoListEntity;
use App\Entities\TodoListRequest;
use App\Repositories\TodoListRepository;
use Illuminate\Http\Response;

class TodoListUsecase
{
    public function __construct(
        private TodoListRepository $todoListRepo
    ) {
    }

    public function getAll(): array
    {
        $result = $this->todoListRepo->getAll();

        $statusCode = Response::HTTP_OK;
        if ($result['status'] !== ResponseEntity::SUCCESS) {
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return [
            'data'   => $result['data'],
            'status' => 'success',
            'code'   => $statusCode
        ];
    }

    public function create(array $todoListReq): array
    {
        $todoList = new TodoListEntity(
            title: $todoListReq['title'],
            description: $todoListReq['description'],
            doing_at: $todoListReq['doing_at'],
            createdAt: date('Y-m-d H:i:s'),
            updatedAt: date('Y-m-d H:i:s'),
        );

        $result = $this->todoListRepo->create($todoList);

        $statusCode = Response::HTTP_CREATED;
        if ($result['status'] !== ResponseEntity::SUCCESS) {
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return [
            'status' => $result['status'],
            'code'   => $statusCode
        ];
    }

    // example unit test with simple function
    public function sum(int $a, int $b): int
    {
        return $a + $b;
    }
}
