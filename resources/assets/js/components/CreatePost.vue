<template>
 <v-container fluid>
    <v-layout row wrap>
      <v-flex xs12 md6 offset-md3>
        <v-card>
          <v-toolbar class="blue">
            <v-toolbar-title style="color:white;">Create New Post</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-text-field label="Title" class="mt-1" v-model="title" required></v-text-field>

            <v-text-field label="Content" v-model="content" multi-line required></v-text-field>
          </v-card-text>

            <div class="ma-2 pb-2">
              <v-btn primary dark block @click="createPost()">Create</v-btn>
            </div>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
	import gql from 'graphql-tag'

	const createPostMutation = gql`
	  mutation createPost($title: String!, $content: String!, $user_id: Int!) {
	    createPost(title: $title, content: $content, user_id: $user_id) {
	      id
	      title
	      content
	    }
	  }
	`;

    export default {
		data: () => ({
			title: '',
			content: '',
		    loading: 0,
		}),

		props: {
		    title: {
		      type: String,
		      required: true,
		    },
		 	content: {
		      type: String,
		      required: true,
		    },
		    user_id: {
		      type: Number,
		      required: true,
		    },
		},

		methods: {
			createPost() {
				this.$apollo.mutate({
					mutation: createPostMutation,
					variables: {
						title: this.title,
						content: this.content,
						user_id: 1,
					},
				}).then(data => {
			    	console.log('Done Create Post.');
			    }).catch((error) => {
			      	console.error(error)
			    });
			}
		}
    }
</script>
