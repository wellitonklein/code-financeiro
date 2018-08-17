import LocalStorage from './services/localStorage'

require('materialize-css')
window.Vue = require('vue')
require('vue-resource')

Vue.http.options.root = "http://0.0.0.0:8000/api"

require('./router')

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
