
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');

import Vue from 'vue';
import Vuetify from 'vuetify'
import { ApolloClient, createBatchingNetworkInterface } from 'apollo-client';
import VueApollo from 'vue-apollo';

const apolloClient = new ApolloClient({
  networkInterface: createBatchingNetworkInterface({
    uri: '/graphql',
  }),

  connectToDevTools: true,
});

Vue.use(Vuetify)
Vue.use(VueApollo);

// Components
Vue.component('posts', require('./components/Posts.vue'));
Vue.component('create-post', require('./components/CreatePost.vue'));

const apolloProvider = new VueApollo({
  defaultClient: apolloClient,
});

const app = new Vue({
    el: '#app',
    apolloProvider
});
