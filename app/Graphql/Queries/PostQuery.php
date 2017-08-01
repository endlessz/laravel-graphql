<?php

namespace App\Graphql\Queries;

use App\Post;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;

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
			'id' 		 => ['name' => 'id', 'type' => Type::int()],
			'title'	     => ['name' => 'title', 'type' => Type::string()],
			'content' 	 => ['name' => 'content', 'type' => Type::string()],
			'user_id'	 => ['name' => 'user_id', 'type' => Type::int()],
			'created_at' => ['name' => 'created_at', 'type' => Type::string()],
			'updated_at' => ['name' => 'updated_at', 'type' => Type::string()],
			'paginate'	 => ['name' => 'paginate', 'type' => Type::int()],
			'page'		 => ['name' => 'page', 'type' => Type::int()],
		];
	}

	public function resolve($root, $args)
	{
		$postBuilder = \DB::table('posts');
		$paginate = $args['paginate'] ?? 5;
		$page =  $args['page'] ?? 1;

		if (isset($args['id'])) {
			return $postBuilder->where('id', $args['id'])->get();
		}
		
		if (isset($args['title'])) {
			$postBuilder->where('title', 'like', $args['title'] . '%');
		}

		if (isset($args['user_id'])) {
			$postBuilder->where('user_id', $args['user_id']);
		}

		return $postBuilder->paginate($paginate, ['*'], 'page', $page);
	}
}
