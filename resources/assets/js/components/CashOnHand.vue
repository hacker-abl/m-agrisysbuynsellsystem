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
    >
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
    </table> -->
  </div>
</template>

<script>
export default {
  props: ["current"],
  data() {
    return {
      cashier: [],
      currentPage: 1,
      totalRows: 0,
      fields: [
        {
          key: "name",
          sortable: true
        },
        {
          key: "cash",
          sortable: true
        }
      ],
      items: []
    };
  },
  created() {
    this.fetchHomepageUpdate();
    this.listenForChanges();
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
    fetchHomepageUpdate() {
      axios.get("/cash_on_hand").then(response => {
        let self = this;
        this.cashier = response.data;

        $.each(this.cashier, function(key, value) {
          self.items.push({
            name: value.name,
            cash: "₱ " + self.formatPrice(value.amount)
          });
        });

        this.totalRows = this.items.length;
        this.$refs.table.refresh();
      });
    },
    listenForChanges() {
      Echo.channel("homepage").listen("CashierCashUpdated", e => {
        axios.get("/cash_on_hand").then(response => {
          this.fetchHomepageUpdate();
        });
      });
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(2).replace(",", ".");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
  }
};
</script>
