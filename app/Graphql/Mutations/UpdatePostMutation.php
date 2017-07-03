<?php

namespace App\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Post;

class UpdatePostMutation extends Mutation {

	protected $attributes = [
		'name' => 'updatePost'
	];

	public function type()
	{
		return GraphQL::type('Post');
	}

	public function args()
	{
		return [
			'id' 		=> ['name' => 'id', 'type' => Type::int()],
			'title' 	=> ['name' => 'title', 'type' => Type::string()],
			'content' 	=> ['name' => 'content', 'type' => Type::string()],
		];
	}

	public function rules()
	{
		return [
			'id' 		=> ['required'],
			'title'	 	=> ['required'],
			'content' 	=> ['required'],
		];
	}

	public function resolve($root, $args)
	{
		$post = Post::find($args['id']);

		if (!$post) {
			return null;
		}

		$post->title = $args['title'];
		$post->content = $args['content'];
		$post->save();

		return $post;
	}
}
