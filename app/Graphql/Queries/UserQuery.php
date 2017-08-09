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
			'id' => ['name' => 'id', 'type' => Type::int()],
			'name' => ['name' => 'name', 'type' => Type::string()],
			'email' => ['name' => 'email', 'type' => Type::string()],
			'paginate'	 => ['name' => 'paginate', 'type' => Type::int()],
			'page'		 => ['name' => 'page', 'type' => Type::int()],
		];
	}

	public function resolve($root, $args)
	{
		$userBuilder = new User;
		$paginate = $args['paginate'] ?? 5;
		$page =  $args['page'] ?? 1;

		if (isset($args['id'])) {
			return $userBuilder->where('id', $args['id'])->get();
		}
		
		if (isset($args['name'])) {
			$userBuilder = $userBuilder->where('name', 'like', $args['name'] . '%');
		}

		if (isset($args['email'])) {
			$userBuilder = $userBuilder->where('email', $args['email']);
		}

		return $userBuilder->paginate($paginate, ['*'], 'page', $page);
	}
}
