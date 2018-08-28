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
                    }else if(e.partial){
                        this.balance[0].amount = parseFloat(this.balance[0].amount) - parseFloat(e.partial);
                    }else{
                        this.balance[0].amount = parseFloat(this.balance[0].amount) + parseFloat(e.amount);
                    }

                })
            },
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            }
        }
    }
</script>
