<?php

namespace Tests\Unit\Usecases;

use App\Entities\ResponseEntity;
use App\Entities\TodoListEntity;
use App\Entities\TodoListRequest;
use App\Repositories\TodoListRepository;
use App\Usecases\TodoListUsecase;
use Codeception\Specify;
use Illuminate\Http\Response;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Stubs\TodoListStub;

class TodoListUsecaseTest extends TestCase
{
    use Specify;

    /**
     * A basic unit test example.
     */
    public function test_get_all(): void
    {
        $todoListRepo = Mockery::mock(TodoListRepository::class);
        $todoListUsecase = new TodoListUsecase($todoListRepo);

        $todoListData = TodoListStub::getTodoLists();

        $todoListRepo->shouldReceive('getAll')
            ->once()
            ->andReturn([
                'data' => $todoListData,
                'status' => 'success',
            ]);

        $this->specify('success get data', function () use ($todoListUsecase, $todoListData) {
            $func = $todoListUsecase->getAll();

            $this->assertEquals([
                'data'   => $todoListData,
                'status' => 'success',
                'code'   => Response::HTTP_OK,
            ], $func);
        });

        $todoListRepo->shouldReceive('getAll')
            ->once()
            ->andReturn([
                'data' => [],
                'status' => 'error',
            ]);
        $this->specify('failed get todo list data', function () use ($todoListUsecase) {
            $func = $todoListUsecase->getAll();

            $this->assertEquals([
                'data'   => [],
                'status' => 'success',
                'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], $func);
        });
    }

    public function test_create(): void
    {
        $todoListRepo = Mockery::mock(TodoListRepository::class);
        $todoListUsecase = new TodoListUsecase($todoListRepo);

        $todoListStubbed = TodoListStub::getTodoList();
        $todoListReq = [
            'title'       => $todoListStubbed['title'],
            'description' => $todoListStubbed['description'],
            'doing_at'    => $todoListStubbed['doing_at'],
        ];

        $todoListRepo->shouldReceive('create')
            ->once()
            ->andReturn([
                'status' => ResponseEntity::SUCCESS,
            ]);
        $this->specify('success create todo list', function () use ($todoListUsecase, $todoListReq) {
            $func = $todoListUsecase->create($todoListReq);

            $this->assertEquals([
                'status' => ResponseEntity::SUCCESS,
                'code'   => Response::HTTP_CREATED,
            ], $func);
        });

        $todoListRepo->shouldReceive('create')
            ->once()
            ->andReturn([
                'status' => ResponseEntity::ERROR,
            ]);
        $this->specify('error create todo list', function () use ($todoListUsecase, $todoListReq) {
            $func = $todoListUsecase->create($todoListReq);

            $this->assertEquals([
                'status' => ResponseEntity::ERROR,
                'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], $func);
        });
    }

    public function test_sum(): void
    {
        $todoListRepo = Mockery::mock(TodoListRepository::class);
        $todoListUsecase = new TodoListUsecase($todoListRepo);

        $this->specify('success sum', function () use ($todoListUsecase) {
            $func = $todoListUsecase->sum(1, 2);

            $this->assertEquals(3, $func);
        });
        
        $this->specify('error sum', function () use ($todoListUsecase) {
            $func = $todoListUsecase->sum(1, 2);

            $this->assertNotEquals(4, $func);
        });
    }
}
