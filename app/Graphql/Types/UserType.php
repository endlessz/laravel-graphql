<?php

namespace App\Graphql\Types;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType {

    protected $attributes = [
        'name' => 'User',
        'description' => 'The Schema of a User Type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the user'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the user'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of the user'
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created_at of the user'
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created_at of the user'
            ]
        ];
    }
}
