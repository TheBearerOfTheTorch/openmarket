
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data:{
        msg:"Update New Post New:",
        content:'',
        posts:[],
        postId:'',
        privsteMsgs:[]
    },

    ready: function(){
        this.created();
    },

    created(){
        axios.get('http://localhost/openmarket/index.php/getMessages')
        .then(response =>{
            console.log(response.data);//show if success
            app.privsteMsgs = respond.data;//we are puting data into our posts
        })
        .catch(function (error){
            console.log(error);//run if we have error
        })
    },

    methods:{
    }
});
