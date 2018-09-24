
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

Vue.component('total-sales-today', require('./components/TotalSalesToday.vue'));
Vue.component('total-purchases-today', require('./components/TotalPurchasesToday.vue'));
Vue.component('total-balance-today', require('./components/TotalBalanceToday.vue'));
Vue.component('total-expenses-today', require('./components/TotalExpensesToday.vue'));
Vue.component('cash-on-hand', require('./components/CashOnHand.vue'));

if(document.getElementById('request')) {
    const request = new Vue({
        el: '#request',
        data: {
            requests: [],
            count: 0
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
            // let user_id = document.head.querySelector('meta[name="user_id"]').content;
    
            axios.get('/notification/get').then((response) => {
                this.requests = response.data.notification;
                this.count = response.data.count;
            });
    
            window.Echo.channel('notifications.cashier')
                .listen('NewNotification', e => {
                    // console.log(e);
                    this.requests.unshift(e.notification);
                });
    
        }
    });
}
