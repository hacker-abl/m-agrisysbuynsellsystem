<template>
    <div>
        <h4 v-for="expense in expenses" :key="expense.amount">&#8369; {{ formatPrice(expense.amount) }}</h4>
    </div>
</template>

<script>
    export default {
        props: ['current'],
        data() {
            return {
                expenses: []
            }
        },
        created() {
            this.fetchHomepageUpdate();
            this.listenForChanges();
        },
        methods: {
            fetchHomepageUpdate() {
                axios.get('/expenses_today').then((response) => {
                    this.expenses = response.data;

                })
            },
            listenForChanges() {
                Echo.channel('homepage')
                .listen('ExpensesUpdated', (e) => {

                    this.expenses[0].amount = parseFloat(this.expenses[0].amount) + parseFloat(e.amount);
                    
                    var totalMonth = parseFloat($( "#totalExpensesMonth" ).text().replace(/[^\d.]/g, '')) + parseFloat(e.amount);
                    var valueMonth = (totalMonth/1).toFixed(2).replace(',', '.');
                    valueMonth = valueMonth.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $( "#totalExpensesMonth" ).html("&#8369; "+valueMonth);

                    var totalYear = parseFloat($( "#totalExpensesYear" ).text().replace(/[^\d.]/g, '')) + parseFloat(e.amount);
                    var valueYear = (totalYear/1).toFixed(2).replace(',', '.');
                    valueYear = valueYear.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $( "#totalExpensesYear" ).html("&#8369; "+valueYear);
                })
            },
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            }
        }
    }
</script>
