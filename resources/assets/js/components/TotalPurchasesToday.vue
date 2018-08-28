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

                    var totalMonth = parseFloat($( "#totalPurchasesMonth" ).text().replace(/[^\d.]/g, '')) + parseFloat(e.total);
                    var valueMonth = (totalMonth/1).toFixed(2).replace(',', '.');
                    valueMonth = valueMonth.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $( "#totalPurchasesMonth" ).html("&#8369; "+valueMonth);

                    var totalYear = parseFloat($( "#totalPurchasesYear" ).text().replace(/[^\d.]/g, '')) + parseFloat(e.total);
                    var valueYear = (totalYear/1).toFixed(2).replace(',', '.');
                    valueYear = valueYear.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $( "#totalPurchasesYear" ).html("&#8369; "+valueYear);
                })
            },
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            }
        }
    }
</script>
