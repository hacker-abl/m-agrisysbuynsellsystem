<template>
	<li :data-notification-id="request.notifications.id" v-if="request.notifications.status === 'pending'" style="background-color: #ffe9e9;">
	    <a href="javascript:void(0);" @click.prevent="seen(request.notifications.id)" class="waves-effect waves-block">
            <div class="icon-circle bg-light-blue" style="position: inherit;top: -8px;" v-if="request.notifications.notification_type === 'expense'">
                <i class="material-icons">credit_card</i>
            </div>
            <div class="icon-circle bg-amber" style="position: inherit;top: -8px;" v-else-if="request.notifications.notification_type === 'cash advance'">
                <i class="material-icons">attach_money</i>
            </div>
            <div class="icon-circle bg-green" style="position: inherit;top: -8px;" v-else-if="request.notifications.notification_type === 'daily time record'">
                <i class="material-icons">av_timer</i>
            </div>
            <div class="icon-circle bg-blue-grey" style="position: inherit;top: -8px; background-color: #2e6da4 !important;" v-else-if="request.notifications.notification_type === 'trips expense'">
                <i class="material-icons">directions_bus</i>
            </div>
            <div class="icon-circle bg-grey" style="position: inherit;top: -8px;" v-else>
                <i class="material-icons">article</i>
            </div>
            <div class="menu-info">
                <h4>{{ ((request.notifications.notification_type == "Expense")? (request.customer && request.customer.lname ? request.customer.lname+' ' : '')+request.customer.fname : (request.customer && request.customer.lname ? request.customer.lname+', ' : '')+request.customer.fname+' '+request.customer.mname) }}</h4>
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
            <div class="icon-circle bg-light-blue" style="position: inherit;top: -8px;" v-if="request.notifications.notification_type === 'expense'">
                <i class="material-icons">credit_card</i>
            </div>
            <div class="icon-circle bg-amber" style="position: inherit;top: -8px;" v-else-if="request.notifications.notification_type === 'cash advance'">
                <i class="material-icons">attach_money</i>
            </div>
            <div class="icon-circle bg-green" style="position: inherit;top: -8px;" v-else-if="request.notifications.notification_type === 'daily time record'">
                <i class="material-icons">av_timer</i>
            </div>
            <div class="icon-circle bg-blue-grey" style="position: inherit;top: -8px; background-color: #2e6da4 !important;" v-else-if="request.notifications.notification_type === 'trips expense'">
                <i class="material-icons">directions_bus</i>
            </div>
            <div class="icon-circle bg-grey" style="position: inherit;top: -8px;" v-else>
                <i class="material-icons">article</i>
            </div>
            <div class="menu-info">
                <h4>{{ ((request.notifications.notification_type == "Expense")? (request.customer && request.customer.lname ? request.customer.lname+' ' : '')+request.customer.fname : (request.customer && request.customer.lname ? request.customer.lname+', ' : '')+request.customer.fname+' '+request.customer.mname) }}</h4>
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
