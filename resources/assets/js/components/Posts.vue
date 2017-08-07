<template>
    <div class="container">
        <template v-if="loading > 0">
	      Loading
	    </template>
	    <template v-else>
	      <ul>
	        <li v-for="post in posts" >
	          {{ post.title }}
	        </li>
	      </ul>
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
        }
    }
</script>
