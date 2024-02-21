<?php

namespace App\Entities;

class TodoListEntity
{
    const DB_TABLE_NAME = "todo_lists";

    public function __construct(
        public string $title,
        public string $description,
        public string $doing_at,
        public string $createdAt,
        public string $updatedAt,
    ) {
    }
}