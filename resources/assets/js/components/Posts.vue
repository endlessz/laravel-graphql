<template>
	<div class="container">
	    <template v-if="loading > 0">
	    	<center>
		        <v-progress-circular indeterminate v-bind:size="70" v-bind:width="5" class="primary--text mt-5"></v-progress-circular>
		    </center>
	    </template>
	    <template v-else>
	    	<template class="mt-2" v-for="post in posts">
		       <v-layout>
		        	<v-flex xs12 sm6 offset-sm3>
					    <v-card>
					        <v-card-media :src="generateImageUrl(post.id)" height="200px">
					        </v-card-media>
					        <v-card-title primary-title>
					          <div>
					            <h3 class="headline mb-0">
					            	<a href="" style="text-decoration:none;">{{ post.title }}</a>
					            </h3>
					            <div>{{ post.content }}</div>
					          </div>
					        </v-card-title>
					        <v-card-actions>
					          <v-btn flat class="blue--text">Like</v-btn>
					          <v-btn flat class="blue--text">Share</v-btn>
					        </v-card-actions>
					      </v-card>
			      	</v-flex>
			  	</v-layout>
		  	</template>
	    </template>
    </div>
</template>

<script>
	import gql from 'graphql-tag'

	const postsQuery = gql`
		  query fetchPosts {
		    posts {
		      id
		      title
		      content
		    }
		  }
		`;

    export default {
		data: () => ({
		    posts: [],
		    loading: 0,
		}),
        apollo: {
        	posts: {
        		query: postsQuery,
        		loadingKey: 'loading',
        		result(data) {
			        console.log(data);
			    },
        	}
        },
        methods: {
		    generateImageUrl: function (id) {
		      return 'http://lorempixel.com/700/200/sports/' + id
		    }
		},
    }
</script>
