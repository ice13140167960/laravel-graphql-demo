<?php


namespace App\GraphQL\Type;


use App\Task;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TaskType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Task',
        'description' => 'A task',
        'model'=>Task::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of a task'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of a task'
            ],
            'is_completed' => [
                'type' => Type::boolean(),
                'description' => 'The status of a task'
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('User')),
                'description' => 'The user of a task'
            ],
        ];
    }
}
