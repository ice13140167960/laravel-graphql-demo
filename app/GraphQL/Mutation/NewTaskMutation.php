<?php


namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use App\Task;

class NewTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newTask'
    ];

    public function type():Type
    {
        return GraphQL::type('Task');
    }

    public function args():array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $task = new Task();

        $task->title = $args['title'];
        $task->save();

        return Task::find($task->id);
    }
}
