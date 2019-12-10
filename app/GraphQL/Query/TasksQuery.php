<?php


namespace App\GraphQL\Query;


use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use App\Task;
use Rebing\GraphQL\Support\SelectFields;

class TasksQuery extends Query
{
    protected $attributes = [
        'name' => 'tasks'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Task'));
    }

    public function args():array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'title' => ['name' => 'title', 'type' => Type::string()],
            'user_id' => ['name' => 'user_id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info, SelectFields $fields)
    {
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        $task = Task::select($select)->with($with);
        if(isset($args["id"])){
            $task=$task->where("id",$args["id"]);
        }
        if(isset($args["title"])){
            $task=$task->where("title",$args["title"]);
        }
        if(isset($args["user_id"])){
            $task=$task->where("user_id",$args["user_id"]);
        }
        return $task->get();
    }
}
