<template>
  <div>
    <b-card
      header="Chỉnh sửa hóa đơn"
      header-class="h1 font-weight-bold bg-gradient-teal"
    >
      <b-form-group
        label="Bàn :"
        label-cols-sm="2"
        label-cols-lg="1"
        label-align="left"
        label-align-sm="right"
        label-class="font-weight-bold"
      >
        <b-form-input disabled :value="invoice.table_id"></b-form-input>
      </b-form-group>
      <b-button v-b-modal.modal-1>Thêm món</b-button>

      <b-modal
        scrollable
        size="xl"
        id="modal-1"
        title="Thêm món"
        ok-only
        ok-title="Xong"
      >
        <add-dish :listDish="listDish" :add="add" />
      </b-modal>
      <list-oder :listOrder="invoice.listOrder" :edit="edit" :xoa="xoa" />
      <b-button class="bg-teal" @click="update">Lưu</b-button>
      <b-button @click="back">Trở về</b-button>
    </b-card>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import Invoice from "../../apis/Invoice";
import Type from "../../apis/Type";
import AddDish from "./AddDish.vue";
import ListOder from "./ListOder.vue";
export default {
  components: { AddDish, ListOder },
  data() {
    return {
      invoice: {
        table_id: null,
        listOrder: [],
      },
      errors: {},
      table: [],
      listDish: [],
    };
  },
  methods: {
    ...mapActions(["setInvoice"]),
    invoiceIndex() {
      this.$emit("loading");
      Invoice.index()
        .then((res) => {
          this.setInvoice(res.data);
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
    getMonAn() {
      Type.getDetail()
        .then((res) => {
          var temp = [];
          var temp2 = [];
          temp = res.data;
          temp.forEach((arr) => {
            temp2 = arr;
            var temp3 = temp2.dishes.filter((res) => res.is_serving != 0);
            temp2.dishes = temp3;
            this.listDish.push(temp2);
          });
        })
        .catch((err) => {});
    },
    add(dish, amount) {
      var index = this.invoice.listOrder.findIndex(
        (element) => element.dish.id == dish.id
      );
      if (index == -1)
        this.invoice.listOrder.push({ dish: dish, amount: amount });
      else {
        this.invoice.listOrder[index].amount =
          eval(this.invoice.listOrder[index].amount) + eval(amount);
      }
      console.log(this.invoice.listOrder);
    },
    edit(dish, amount) {
      var index = this.invoice.listOrder.findIndex(
        (element) => element.dish.id == dish.id
      );
      this.invoice.listOrder[index].amount = amount;
    },
    xoa(dish) {
      var index = this.invoice.listOrder.findIndex(
        (element) => element.dish.id == dish.id
      );
      this.invoice.listOrder.splice(index, 1);
    },
    update() {
      Invoice.update(this.invoice, this.$route.params.id)
        .then((res) => {
          this.invoiceIndex();
          this.show();
          this.errors = {};
        })
        .catch((err) => {
          if (err.response.status == 422) {
            this.errors = err.response.data.errors;
          }
        });
    },
    show() {
      this.invoice.listOrder = [];
      Invoice.show(this.$route.params.id)
        .then((res) => {
          this.invoice.table_id = res.data.table.name;
          Array.from(res.data.dishes).forEach((arr) => {
            var temp = { dish: {}, amount: 0 };
            temp.dish = arr;
            temp.amount = arr.pivot.amount;
            this.invoice.listOrder.push(temp);
          });
        })
        .catch((err) => {});
    },
    back() {
      if (this.$route.query.table) {
        this.$router.push({ name: "ThemMon" });
      } else this.$router.push({ name: "InvoiceIndex" });
    },
  },
  filters: {
    check: function (value) {
      return value == null ? null : false;
    },
  },
  mounted() {
    this.show();
    this.getMonAn();
  },
};
</script>

<style>
</style>