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

                    var totalMonth = parseFloat($( "#totalSalesMonth" ).text().replace(/[^\d.]/g, '')) + parseFloat(e.amount);
                    var valueMonth = (totalMonth/1).toFixed(2).replace(',', '.');
                    valueMonth = valueMonth.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $( "#totalSalesMonth" ).html("&#8369; "+valueMonth);

                    var totalYear = parseFloat($( "#totalSalesYear" ).text().replace(/[^\d.]/g, '')) + parseFloat(e.amount);
                    var valueYear = (totalYear/1).toFixed(2).replace(',', '.');
                    valueYear = valueYear.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $( "#totalSalesYear" ).html("&#8369; "+valueYear);
                })
            },
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            }
        }
    }
</script>
