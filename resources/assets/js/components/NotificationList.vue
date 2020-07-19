<template>
    <ul class="dropdown-menu">
        <li class="header">NOTIFICATIONS</li>
        <li class="body">
            <ul class="menu">
                <notification-content v-for="(request, index) in requests" :request="request" v-bind:key="index"></notification-content>
                <li v-show="requests && requests.length === 0">
                    <a href="javascript:;" class="text-center" style="color: gray">
                        No request
                    </a>
                </li>
            </ul>
        </li>
        <li class="footer">
            <a href="/notifications">View All Notifications</a>
        </li>
    </ul>
</template>

<script>
    export default {
    	props: ['requests'],
    	methods: {
            // more: function(data, e) {
            //     e.stopPropagation();
            //     var offset = data.notifications.id;

            //     this.$emit('pagination', {
            //         id: offset
            //     });
            // }
        }
    }
</script>
