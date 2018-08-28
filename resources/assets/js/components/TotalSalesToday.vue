<template>
    <div>
        <h4 v-for="sale in sales" :key="sale.amount">&#8369; {{ formatPrice(sale.amount) }}</h4>
    </div>
</template>

<script>
    export default {
        props: ['current'],
        data() {
            return {
                sales: []
            }
        },
        created() {
            this.fetchHomepageUpdate();
            this.listenForChanges();
        },
        methods: {
            fetchHomepageUpdate() {
                axios.get('/sales_today').then((response) => {
                    this.sales = response.data;
                })
            },
            listenForChanges() {
                Echo.channel('homepage')
                .listen('SalesUpdated', (e) => {
                    
                    this.sales[0].amount = parseFloat(this.sales[0].amount) + parseFloat(e.amount);
                })
            },
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            }
        }
    }
</script>
