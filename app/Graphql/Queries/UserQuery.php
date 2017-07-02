<?php

namespace App\Graphql\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Support\Query;

use App\User;

class UserQuery extends Query
{
	protected $attributes = [
		'name' => 'users'
	];

	public function type()
	{
		return Type::listOf(GraphQL::type('User'));
	}

	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::string()],
			'name' => ['name' => 'name', 'type' => Type::string()],
			'email' => ['name' => 'email', 'type' => Type::string()]
		];
	}

	public function resolve($root, $args, $context, ResolveInfo $info)
	{
		$fields = $info->getFieldSelection($depth = 3);

		$users = User::query();

		foreach ($fields as $field => $keys) {
			if ($field === 'posts') {
				$users->with('posts');
			}
		}

		return $users->get();
	}
}
