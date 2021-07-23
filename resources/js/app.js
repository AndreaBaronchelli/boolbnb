

require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');



//INIT VUE MAIN INSTANCE
import App from './App.vue';
import router from './routes';


const root = new Vue({
    el: '#root',
    router: router,
    render: h => h(App)
});


