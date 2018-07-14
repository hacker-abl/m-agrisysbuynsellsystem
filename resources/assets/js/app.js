
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

Vue.component('notification-counter', require('./components/NotificationCounter.vue'));
Vue.component('notification-content', require('./components/NotificationContent.vue'));
Vue.component('notification-list', require('./components/NotificationList.vue')); 

const request = new Vue({
    el: '#request',
    data: {
		requests: []
    },
    methods: {
    	// requestApproved: function(notification){
    	// 	axios.get('notification/approve', {params: {id: notification.id}}).then((response) => {
	    		
	    // 	});
    	// },
    	// requestCancelled: function(notification){
        //     axios.get('notification/cancel', {params: {id: notification.id}}).then((response) => {
                
        //     });
    	// },
        // paginate: function(offset){
        //     var id = offset.id;

        //     axios.get('/notification/retrieve/request/more/'+id).then((response) => {
        //         var data = response.data;
        //         if(data) {
        //             for (var i = 0; i < data.length; i++) {
        //                 this.requests.push(data[i]);
        //             };
        //         }
        //     });
        // }
    },
    created() {
    	axios.get('/notification/get').then((response) => {
            this.requests = response.data;
        });

        window.Echo.channel('notifications.cashier')
            .listen('NewNotification', e => {
                this.requests.unshift(e.notification);
            });

    }
});