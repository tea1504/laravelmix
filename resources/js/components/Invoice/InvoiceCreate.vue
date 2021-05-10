<template>
  <div>
    <b-card
      header="Thêm mới hóa đơn"
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
        <b-form-select
          id="table_id"
          v-model="invoice.table_id"
          :options="table"
          :state="errors.table_id | check"
          aria-describedby="table_id_err"
        >
        </b-form-select>
        <b-form-invalid-feedback id="table_id_err" v-if="errors.table_id">
          {{ errors.table_id[0] }}
        </b-form-invalid-feedback>
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
      <b-button class="bg-teal" @click="create">Lưu</b-button>
      <b-button :to="{ name: 'InvoiceIndex' }">Trở về</b-button>
    </b-card>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import Invoice from "../../apis/Invoice";
import Table from "../../apis/Table";
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
    getBanTrong() {
      this.$emit("loading");
      Table.getBanTrong()
        .then((res) => {
          Array.from(res.data).forEach((arr) => {
            var temp = { text: null, value: null };
            temp.text = arr.name;
            temp.value = arr.id;
            this.table.push(temp);
          });
          this.$emit("loaded");
        })
        .catch((err) => {
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
    create() {
      Invoice.create(this.invoice)
        .then((res) => {
          this.getBanTrong();
          this.invoiceIndex();
          this.invoice.table_id = null;
          this.invoice.listOrder = [];
          this.errors = {};
        })
        .catch((err) => {
          if (err.response.status == 422) {
            this.errors = err.response.data.errors;
          }
        });
    },
  },
  filters: {
    check: function (value) {
      return value == null ? null : false;
    },
  },
  mounted() {
    this.getBanTrong();
    this.getMonAn();
    this.invoice.table_id = this.$route.query.table;
  },
};
</script>

<style>
</style>