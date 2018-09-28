require('./bootstrap')

Vue.component('site-menu', require('./components/SiteMenu.vue'))

const app = new Vue({
    el: '#app'
})