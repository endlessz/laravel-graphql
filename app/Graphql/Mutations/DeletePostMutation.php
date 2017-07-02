<?php

namespace App\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Post;

class DeletePostMutation extends Mutation {

	protected $attributes = [
		'name' => 'deletePost'
	];

	public function type()
	{
		return GraphQL::type('Post');
	}

	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())]
		];
	}

	public function resolve($root, $args)
	{
		$post = Post::find($args['id']);

		if(!$post)
		{
			return null;
		}

		$post->delete();

		return true;
	}
}
