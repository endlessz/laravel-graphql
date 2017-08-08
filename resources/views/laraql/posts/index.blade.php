@extends('laraql.main-layout')

@section('content')
	<posts></posts>

	<v-btn href="/posts/create" class="blue" dark fixed bottom right fab>
        <v-icon>add</v-icon>
    </v-btn>
@endsection
