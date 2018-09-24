<template>
	<li :data-notification-id="request.notifications.id" v-if="request.notifications.status === 'pending'" style="background-color: #ffe9e9;">
	    <a href="javascript:void(0);" @click.prevent="seen(request.notifications.id)" class="waves-effect waves-block">
            <div class="icon-circle bg-blue-grey" style="position: inherit;top: -8px;">
                <i class="material-icons" v-if="request.notifications.notification_type === 'expense'">credit_card</i>
                <i class="material-icons" v-if="request.notifications.notification_type === 'cash advance'">attach_money</i>
                <i class="material-icons" v-if="request.notifications.notification_type === 'daily time record'">av_timer</i>
                <i class="material-icons" v-if="request.notifications.notification_type === 'trips expense'">directions_bus</i>
            </div>
            <div class="menu-info">
                <h4>{{ ((request.notifications.notification_type == "Expense")? request.customer.lname+' '+request.customer.fname : request.customer.lname+', '+request.customer.fname+' '+request.customer.mname) }}</h4>
                <p>
					{{ request.notifications.notification_type }}
                </p>
                <p>
                    <i class="material-icons">access_time</i> Served by {{ request.notifications.admin.name }} {{ request.time }}
                </p>
            </div>
	    </a>
	</li>
    <li :data-notification-id="request.notifications.id" v-else>
	    <a href="javascript:void(0);" @click.prevent="seen(request.notifications.id)" class="waves-effect waves-block">
            <div class="icon-circle bg-blue-grey" style="position: inherit;top: -8px;">
                <i class="material-icons" v-if="request.notifications.notification_type === 'expense'">credit_card</i>
                <i class="material-icons" v-if="request.notifications.notification_type === 'cash advance'">attach_money</i>
                <i class="material-icons" v-if="request.notifications.notification_type === 'daily time record'">av_timer</i>
                <i class="material-icons" v-if="request.notifications.notification_type === 'trips expense'">directions_bus</i>
            </div>
            <div class="menu-info">
                <h4>{{ ((request.notifications.notification_type == "Expense")? request.customer.lname+' '+request.customer.fname : request.customer.lname+', '+request.customer.fname+' '+request.customer.mname) }}</h4>
                <p>
					{{ request.notifications.notification_type }}
                </p>
                <p>
                    <i class="material-icons">access_time</i> Served by {{ request.notifications.admin.name }} {{ request.time }}
                </p>
            </div>
	    </a>
	</li>
</template>

<script>
    export default {
    	props: ['request'],
        methods: {
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
            $('li.body a').on('click', function (event) {
                event.stopPropagation();
            });
        }
    }
</script>
