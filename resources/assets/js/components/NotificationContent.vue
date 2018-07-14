<template>
	<li :data-notification-id="request.notifications.id">
	    <a href="javascript:void(0);" class="waves-effect waves-block">
            <div class="icon-circle bg-blue-grey">
                <i class="material-icons">comment</i>
            </div>
            <div class="menu-info">
                <h4>{{request.customer.lname+', '+request.customer.fname+' '+request.customer.mname}}</h4>
                <p>
					Cash Advance request
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
    	props: ['request']
    }
</script>
