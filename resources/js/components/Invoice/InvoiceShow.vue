<template>
  <div class="invoice p-3 mb-3">
    <h4>
      <i class="fas fa-hamburger"></i> Nhà hàng FoodVue
      <small class="float-right"
        >Ngày: {{ new Date().toLocaleDateString("vi") }}</small
      >
    </h4>
    <b-row>
      <b-col md="6">
        <b-row>
          <b-col class="text-right font-weight-bold">
            Nhân viên:
          </b-col>
          <b-col > {{ invoice.staff }} </b-col>
        </b-row>
        <b-row>
          <b-col class="text-right font-weight-bold"> Vị trí: </b-col>
          <b-col > {{ invoice.table }} </b-col>
        </b-row>
        <b-row>
          <b-col class="text-right font-weight-bold">
            Số hóa đơn:
          </b-col>
          <b-col > {{ "#" + invoice.id }} </b-col>
        </b-row>
      </b-col>
      <b-col md="6">
        <b-row>
          <b-col class="text-right font-weight-bold"> Ngày lập: </b-col>
          <b-col > {{ invoice.date | date }} </b-col>
        </b-row>
        <b-row>
          <b-col class="text-right font-weight-bold"> Giờ vào: </b-col>
          <b-col > {{ invoice.check_in }} </b-col>
        </b-row>
        <b-row>
          <b-col class="text-right font-weight-bold"> Giờ ra: </b-col>
          <b-col > {{ invoice.check_out }} </b-col>
        </b-row>
      </b-col>
    </b-row>
    <b-table
      :items="items"
      :fields="fields"
      striped
      hover
      sticky-header="500px"
      class="mt-3"
    >
      <template #table-busy>
        <div class="text-center text-success my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>
      <template #cell(stt)="row">
        {{ row.index + 1 }}
      </template>
      <template #cell(subtotal)="row">
        {{ row.value | money }}
      </template>
      <template #cell(price)="row">
        {{ row.value | money }}
      </template>
      <template #custom-foot>
        <b-tr>
          <b-th colspan="4" class="text-right">Tổng tiền :</b-th>
          <b-th class="text-right font-weight-normal">{{ total | money }}</b-th>
        </b-tr>
      </template>
    </b-table>
  </div>
</template>

<script>
import Invoice from "../../apis/Invoice";
export default {
  props: {
    isLoaded: Boolean,
    id: Number,
  },
  data() {
    return {
      items: [],
      fields: [
        {
          key: "stt",
          label: "Số thứ tự",
        },
        {
          key: "name",
          label: "Tên",
          sortable: true,
        },
        {
          key: "price",
          label: "Giá",
          sortable: true,
          tdClass: "text-right",
          thClass: "text-center",
        },
        {
          key: "amount",
          label: "Số lượng",
          sortable: true,
          tdClass: "text-right",
          thClass: "text-center",
        },
        {
          key: "subtotal",
          label: "Thành tiền",
          sortable: true,
          tdClass: "text-right",
          thClass: "text-center",
        },
      ],
      total: 0,
      invoice: {
        id: 0,
        check_in: null,
        check_out: null,
        date: null,
        staff: null,
        table: null,
      },
    };
  },
  methods: {
    getDetail() {
      this.$emit("loading");
      Invoice.getDetail(this.id)
        .then((res) => {
          Array.from(res.data).forEach((arr) => {
            var temp = {
              name: null,
              price: 0.0,
              amount: 0,
              subtotal: 0,
            };
            temp.name = arr.name;
            temp.price = arr.pivot.price;
            temp.amount = arr.pivot.amount;
            temp.subtotal = temp.price * temp.amount;
            this.total += temp.subtotal;
            this.items.push(temp);
          });
          this.$emit("loaded");
        })
        .catch((err) => {
          if (err.response.status == 401) {
            localStorage.removeItem("token");
            this.$router.push({
              name: "Login",
              query: {
                redirect: to.fullPath,
              },
            });
          } else {
            this.$swal({
              icon: "error",
              title: "Lỗi",
              text: "Không lấy dữ liệu. Hãy thử lại sau.",
            });
          }
          this.$emit("loaded");
        });
    },
    show() {
      this.$emit("loading");
      Invoice.show(this.id)
        .then((res) => {
          this.invoice.id = res.data.id;
          this.invoice.check_in = res.data.check_in;
          this.invoice.check_out = res.data.check_out;
          this.invoice.date = res.data.date;
          this.invoice.staff =
            res.data.staff.last_name + " " + res.data.staff.first_name;
          this.invoice.table = res.data.table.name;
          this.$emit("loaded");
        })
        .catch((err) => {
          this.$emit("loaded");
        });
    },
  },
  mounted() {
    this.getDetail();
    this.show();
  },
  filters: {
    money: function (value) {
      return new Intl.NumberFormat("de-DE").format(value) + " vnđ";
    },
  },
};
</script>

<style>
</style>