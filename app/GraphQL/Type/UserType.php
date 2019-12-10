<?php


namespace App\GraphQL\Type;

use App\GraphQL\Query\TasksQuery;
use App\Task;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Log;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A user',
        'model'=>User::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of a task'
            ],
            'username' => [
                'type' => Type::string(),
                'description' => 'The username of a user'
            ],
            'sex' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The sex of a user',
                'resolve'=>function($root,$args){
                    return '222';
                },
            ],
            'tasks'=>[
                'type'=>Type::listOf(GraphQL::type('Task')),
                'args'=>(new TasksQuery)->args(),
                'query'         => function(array $args, $query, $ctx) {
                    foreach($args as $key=>$value){
                        $query->where('tasks.'.$key, $value);
                    }
                    return $query;
                }
            ],
        ];
    }
}
