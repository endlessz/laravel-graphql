<?php

namespace App\Graphql\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Post;

class PostQuery extends Query {

	protected $attributes = [
		'name' => 'posts'
	];

	public function type()
	{
		return Type::listOf(GraphQL::type('Post'));
	}

	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'title' => ['name' => 'title', 'type' => Type::string()],
			'content' => ['name' => 'content', 'type' => Type::string()],
			'created_at' => ['name' => 'content', 'type' => Type::string()],
			'updated_at' => ['name' => 'content', 'type' => Type::string()]
		];
	}

	public function resolve($root, $args)
	{
		if (isset($args['id'])) {
			return Post::where('id', $args['id'])->get();
		}
		
		if (isset($args['title'])) {
			return Post::where('title', $args['title'])->get();
		}
		
		if (isset($args['content'])) {
			return Post::where('content', $args['content'])->get();
		}

		return Post::all();
	}
}
