<template>
    <div>
        <h4 v-for="bal in balance" :key="bal.amount">&#8369; {{ formatPrice(bal.amount) }}</h4>
    </div>
</template>

<script>
    export default {
        props: ['current'],
        data() {
            return {
                balance: []
            }
        },
        created() {
            this.fetchHomepageUpdate();
            this.listenForChanges();
        },
        methods: {
            fetchHomepageUpdate() {
                axios.get('/balance_today').then((response) => {
                    this.balance = response.data;
                })
            },
            listenForChanges() {
                Echo.channel('homepage')
                .listen('BalanceUpdated', (e) => {
                    if(e.paymentamount){
                        this.balance[0].amount = parseFloat(this.balance[0].amount) - parseFloat(e.paymentamount);
                            if(this.balance[0].amount < 0){
                                this.balance[0].amount = 0;
                            }
                        var totalYear = parseFloat($( "#totalBalanceYear" ).text().replace(/[^\d.]/g, '')) - parseFloat(e.paymentamount);
                        var totalMonth = parseFloat($( "#totalBalanceMonth" ).text().replace(/[^\d.]/g, '')) - parseFloat(e.paymentamount);
                    }else if(e.partial){
                        this.balance[0].amount = parseFloat(this.balance[0].amount) - parseFloat(e.partial);
                            if(this.balance[0].amount < 0){
                                this.balance[0].amount = 0;
                            }
                        var totalYear = parseFloat($( "#totalBalanceYear" ).text().replace(/[^\d.]/g, '')) - parseFloat(e.partial);
                        var totalMonth = parseFloat($( "#totalBalanceMonth" ).text().replace(/[^\d.]/g, '')) - parseFloat(e.partial);
                    }else{
                        this.balance[0].amount = parseFloat(this.balance[0].amount) + parseFloat(e.amount);
                            if(this.balance[0].amount < 0){
                                this.balance[0].amount = 0;
                            }
                        var totalYear = parseFloat($( "#totalBalanceYear" ).text().replace(/[^\d.]/g, '')) + parseFloat(e.amount);
                        var totalMonth = parseFloat($( "#totalBalanceMonth" ).text().replace(/[^\d.]/g, '')) + parseFloat(e.amount);
                    }

                    var valueMonth = (totalMonth/1).toFixed(2).replace(',', '.');
                    valueMonth = valueMonth.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $( "#totalBalanceMonth" ).html("&#8369; "+valueMonth);

                    var valueYear = (totalYear/1).toFixed(2).replace(',', '.');
                    valueYear = valueYear.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $( "#totalBalanceYear" ).html("&#8369; "+valueYear);

                })
            },
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            }
        }
    }
</script>
