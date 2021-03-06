<?php

namespace App\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Post;

class CreatePostMutation extends Mutation {

	protected $attributes = [
		'name' => 'createPost'
	];

	public function type()
	{
		return GraphQL::type('Post');
	}

	public function args()
	{
		return [
			'title' 	=> ['name' => 'title', 'type' => Type::string()],
			'content' 	=> ['name' => 'content', 'type' => Type::string()],
			'user_id' 	=> ['name' => 'user_id', 'type' => Type::int()],
		];
	}

	public function rules()
	{
		return [
			'title'	 	=> ['required'],
			'content' 	=> ['required'],
			'user_id' 	=> ['required']
		];
	}

	public function resolve($root, $args)
	{
		$post = Post::create([
			'title' 	=> $args['title'],
			'content'	=> $args['content'],
			'user_id'	=> $args['user_id'],
		]);

		return $post;
	}
}
