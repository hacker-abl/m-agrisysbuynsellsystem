<template>
  <div>
    <b-table
      ref="table"
      :items="items"
      :fields="fields"
      per-page="5"
      :current-page="currentPage"
      striped
      hover
      foot-clone
    >
      <template v-slot:foot(commodity)>
        <span class="text-danger">TOTAL</span>
      </template>
      <template v-slot:foot(net_weight)>
        <span class="text-danger">
          {{
            formatPrice(
              purchasesToday["totals"] != null
                ? purchasesToday["totals"].net
                : 0
            )
          }}
        </span>
      </template>
      <template v-slot:foot(total_amount)>
        <span class="text-danger">
          &#8369;
          {{
            formatPrice(
              purchasesToday["totals"] != null
                ? purchasesToday["totals"].total
                : 0
            )
          }}
        </span>
      </template>
    </b-table>
    <b-row>
      <b-col md="6">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link"
              >Showing {{ startEntry }} to {{ endEntry }} of
              {{ totalRows }} entries</a
            >
          </li>
        </ul>
      </b-col>
      <b-col md="6">
        <b-pagination
          style="float:right"
          v-model="currentPage"
          :total-rows="totalRows"
          per-page="5"
          aria-controls="table"
          prev-text="Previous"
          next-text="Next"
          :hide-goto-end-buttons="true"
        >
        </b-pagination>
      </b-col>
    </b-row>
    <!-- <table class="table table-striped">
      <thead>
        <tr>
          <th>COMMODITY</th>
          <th>NET WEIGHT (Kilos)</th>
          <th>TOTAL AMOUNT</th>
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
    </table> -->
  </div>
</template>

<script>
export default {
  props: ["current"],
  data() {
    return {
      purchasesToday: [],
      currentPage: 1,
      totalRows: 0,
      fields: [
        {
          key: "commodity",
          label: "COMMODITY",
          sortable: true
        },
        {
          key: "net_weight",
          label: "NET WEIGHT",
          sortable: true
        },
        {
          key: "total_amount",
          label: "TOTAL AMOUNT",
          sortable: true
        }
      ],
      items: []
    };
  },
  created() {
    this.listenForChanges();
    this.fetchPurchasesTodayUpdate();
  },
  computed: {
    startEntry() {
      if (this.totalRows == 0) {
        return 0;
      }

      let start = (this.currentPage - 1) * 5 + 1;
      return start;
    },
    endEntry() {
      if (this.totalRows == 0) {
        return 0;
      }

      let end = this.currentPage * 5;
      return end < this.totalRows ? end : this.totalRows;
    }
  },
  methods: {
    fetchPurchasesTodayUpdate() {
      axios.get("/purchases/today").then(response => {
        let self = this;
        this.purchasesToday = response.data;

        $.each(this.purchasesToday.data, function(key, value) {
          self.items.push({
            commodity: value.commodity_name[0].name,
            net_weight: self.formatPrice(value.net),
            total_amount: "₱ " + self.formatPrice(value.total)
          });
        });

        this.totalRows = this.items.length;
        this.$refs.table.refresh();
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
