<?php

namespace Tests\Unit\Stubs;

use Tests\Unit\Helper;

class TodoListStub
{
    public static function getTodoLists(): array
    {
        return [
            [
                'id' => rand(1, 100),
                'title' => Helper::generateRandomString(10),
                'description' => Helper::generateRandomString(100),
                'doing_at' => date('Y-m-d H:i:s'),
                'is_completed' => false,
            ],
        ];
    }

    public static function getTodoList(): array
    {
        return self::getTodoLists()[0];
    }
}