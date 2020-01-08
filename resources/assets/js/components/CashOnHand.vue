<template>
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Cash</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in cashier" :key="user.id">
                <td>{{ user.name }}</td>
                <td>&#8369; {{ formatPrice(user.amount) }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['current'],
        data() {
            return {
                cashier: []
            }
        },
        created() {
            this.fetchHomepageUpdate();
            this.listenForChanges();
        },
        methods: {
            fetchHomepageUpdate() {
                axios.get('/cash_on_hand').then((response) => {
                    this.cashier = response.data;

                })
            },
            listenForChanges() {
                Echo.channel('homepage')
                .listen('CashierCashUpdated', (e) => {

                    axios.get('/cash_on_hand').then((response) => {
                    this.cashier = response.data;
                    })

                })
            },
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            }
        }
    }
</script>
