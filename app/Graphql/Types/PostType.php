<?php

namespace App\Graphql\Types;

use GraphQl;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType {

    protected $attributes = [
        'name' => 'Post',
        'description' => 'The Schema of a Post Type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of the post'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The title of the post'
            ],
            'content' => [
                'type' => Type::string(),
                'description' => 'The content of the post'
            ],
            'user_id' => [
                'type' => Type::int(),
                'description' => 'The user_id of the post'
            ],
            'user' => [
                'type' => GraphQL::type('User'),
                'description' => 'The user of the post',
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created_at of the post'
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created_at of the post'
            ]
        ];
    }
}