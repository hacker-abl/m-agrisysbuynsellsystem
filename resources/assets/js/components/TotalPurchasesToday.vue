<template>
    <div>
        <h4 v-for="purchase in purchases" :key="purchase.total">&#8369; {{ formatPrice(purchase.total) }}</h4>
    </div>
</template>

<script>
    export default {
        props: ['current'],
        data() {
            return {
                purchases: []
            }
        },
        created() {
            this.fetchHomepageUpdate();
            this.listenForChanges();
        },
        methods: {
            fetchHomepageUpdate() {
                axios.get('/purchases_today').then((response) => {
                    this.purchases = response.data;
                })
            },
            listenForChanges() {
                Echo.channel('homepage')
                .listen('PurchasesUpdated', (e) => {
                    
                    this.purchases[0].total = parseFloat(this.purchases[0].total) + parseFloat(e.total);
                })
            },
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            }
        }
    }
</script>
