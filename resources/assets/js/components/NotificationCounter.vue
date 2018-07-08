<template>
    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
        <i class="material-icons">notifications</i>
        <span class="label-count" v-show="count != 0">{{ count }}</span>
    </a>
</template>

<script>
    export default {
        props: ['count'],
        created() {
            console.log(this.count);
        }
    }
</script>
