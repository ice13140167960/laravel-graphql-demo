<?php


namespace App\GraphQL\Query;


use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Log;
use Rebing\GraphQL\Support\Query;
use App\User;
use Rebing\GraphQL\Support\SelectFields;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'users'
    ];

    public function type():Type
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function args():array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info, SelectFields $fields)
    {
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        $user = User::select($select)->with($with);
        if(isset($args["id"])){
            $user=$user->where("id",$args["id"]);
        }
        return $user->get();
    }
}
