<template>
  <div class="container">
    <br />
    <table class="table table-striped">
      <thead>
        <tr>
          <th>COMMODITY</th>
          <th>NET WEIGHT (Kilos)</th>
          <th>TOTAL PRICE</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="commodity in purchasesToday['data']"
          :key="commodity.commodity_id"
        >
          <td>
            <span>{{ commodity.commodity_name[0].name }}</span>
          </td>
          <td>
            <span>{{ commodity.net }}</span>
          </td>
          <td>
            <span
              ><b>&#8369; {{ formatPrice(commodity.total) }}</b></span
            >
          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="text-danger">
          <th>TOTAL</th>
          <th>{{ formatPrice(purchasesToday["totals"] != null ? purchasesToday["totals"].net : 0) }}</th>
          <th>
            &#8369;
            {{ formatPrice(purchasesToday["totals"] != null ? purchasesToday["totals"].total : 0) }}
          </th>
        </tr>
      </tfoot>
    </table>
  </div>
</template>

<script>
export default {
  props: ["current"],
  data() {
    return {
      purchasesToday: []
    };
  },
  created() {
    this.listenForChanges();
    this.fetchPurchasesTodayUpdate();
  },
  methods: {
    fetchPurchasesTodayUpdate() {
      axios.get("/purchases/today").then(response => {
        this.purchasesToday = response.data;
      });
    },
    listenForChanges() {
      Echo.channel("homepage").listen("PurchasesUpdated", e => {
        //update purchases today
        this.fetchPurchasesTodayUpdate();
      });
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(2).replace(",", ".");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
  }
};
</script>
