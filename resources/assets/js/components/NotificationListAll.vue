<template>
    <div>
        <div class="page-header">
            <h1 id="timeline">Notifications</h1>
        </div>
        <ul class="timeline">
            <li v-for="(request, index) in requests" v-bind:key="index" :class="(request.notifications.notification_type.search('expense') > 0) ? 'timeline-inverted' : ''">
                <div class="timeline-badge info" v-if="request.notifications.notification_type === 'expense'">
                    <i class="material-icons">credit_card</i> 
                </div>
                <div class="timeline-badge warning" v-else-if="request.notifications.notification_type === 'cash advance'">
                    <i class="material-icons">attach_money</i>
                </div>
                <div class="timeline-badge success" v-else-if="request.notifications.notification_type === 'daily time record'">
                    <i class="material-icons">av_timer</i>
                </div>
                <div class="timeline-badge primary" v-else-if="request.notifications.notification_type === 'trips expense'">
                    <i class="material-icons">directions_bus</i>
                </div>
                <div class="timeline-badge secondary" v-else>
                    <i class="material-icons">article</i>
                </div>
                <div class="timeline-panel" :style="request.notifications.status === 'pending' ? 'background-color: #ffe9e9;' : ''" @click="seen(request.notifications.id)">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">{{ ((request.notifications.notification_type == "Expense")? (request.customer && request.customer.lname ? request.customer.lname+' ' : '')+request.customer.fname : (request.customer && request.customer.lname ? request.customer.lname+', ' : '')+request.customer.fname+' '+request.customer.mname) }}</h4>
                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> Served by {{ request.notifications.admin.name }} {{ request.time }}</small></p>
                    </div>
                    <div class="timeline-body">
                        <p>{{ request.notifications.message }}</p>
                    </div>
                </div>
            </li>
            <li class="show-more" v-show="next > 0">
                <button class="btn btn-primary btn-xl" @click="more"><i class="material-icons">add</i> <span>Show more ({{next}})</span></button>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                requests: [],
                count: 0,
                next: 0
            }
        },
    	methods: {
            more: function() {
                if(this.requests.length > 0) {
                    let id = this.requests[this.requests.length - 1].notifications.id;

                    axios.get('/notification/get', {
                        params: {
                            id: id,
                            per_page: 10
                        }
                    }).then((response) => {                        
                        this.requests = [...this.requests, ...response.data.notification]
                        this.next = response.data.next;
                    });
                }                
            },
            seen: function (id) {                
                axios.post('/notification/update/seen', {
                    notification: id
                })
                .then(function (response) {
                    if(response) {
                        window.location.href = response.data;
                    }
                })
                .catch(function (error) {
                    alert(error);
                });
            }
        },
        created() {
            // let user_id = document.head.querySelector('meta[name="user_id"]').content;
    
            axios.get('/notification/get').then((response) => {
                this.requests = [...this.requests, ...response.data.notification]
                
                this.count = response.data.count;
                this.next = response.data.next;
            });
    
        }
    }
</script>