<template>
  <div>
    <b-card
      header="Danh sách hóa đơn"
      header-class="h1 font-weight-bold bg-gradient-teal"
    >
      <b-button :to="{ name: 'InvoiceCreate' }" class="bg-teal border-0 mb-1"
        ><i class="fas fa-plus"></i> Thêm mới</b-button
      >
      <b-row>
        <b-col md="6">
          <b-form-group label="Số dòng" label-align="left" label-cols-sm="2">
            <b-form-select
              v-model="perPage"
              :options="pageOptions"
            ></b-form-select>
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label="Tìm kiếm" label-align="right" label-cols-sm="2">
            <b-form-input
              v-model="filter"
              type="search"
              placeholder="Nhập để tìm kiếm"
            ></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>
      <b-table
        striped
        hover
        outlined
        sticky-header="500px"
        :items="getInvoice"
        :fields="getFieldsInvoice"
        :busy="!isLoaded"
        :per-page="perPage"
        :current-page="currentPage"
        :filter="filter"
        :filter-included-fields="filterOn"
      >
        <template #table-busy>
          <div class="text-center text-success my-2">
            <b-spinner class="align-middle"></b-spinner>
            <strong>Loading...</strong>
          </div>
        </template>
        <template #cell(date)="row">
          {{ row.value | date }}
        </template>
        <template #cell(is_paid)="row">
          <b-badge pill variant="success" v-if="row.value"
            >Đã thanh toán</b-badge
          >
          <b-badge pill variant="danger" v-else>Chưa thanh toán</b-badge>
        </template>
        <template #cell(table)="row">
          {{ row.value.name }}
        </template>
        <template #cell(staff)="row">
          {{ row.value.last_name }} {{ row.value.first_name }}
        </template>
        <template #cell(actions)="row">
          <b-button
            :to="{ name: 'InvoiceEdit', params: { id: row.item.id } }"
            size="sm"
            pill
            class="bg-teal"
            style="border: none"
            v-b-tooltip.hover
            title="Sửa"
            v-if="!row.item.is_paid"
            ><i class="fas fa-pen"></i
          ></b-button>
          <b-button
            @click="xoa(row.item.id)"
            size="sm"
            pill
            variant="danger"
            style="border: none"
            v-b-tooltip.hover
            title="Xóa"
            v-if="!row.item.is_paid"
            ><i class="fas fa-trash"></i
          ></b-button>
          <b-button
            @click="thanhtoan(row.item.id)"
            size="sm"
            pill
            variant="warning"
            style="border: none"
            v-b-tooltip.hover
            title="Thanh toán"
            v-if="!row.item.is_paid"
            ><i class="fas fa-file-invoice-dollar"></i
          ></b-button>
          <b-button
            v-b-modal.modal-show
            @click="id = row.item.id"
            size="sm"
            pill
            style="border: none"
            v-b-tooltip.hover
            title="Xem chi tiết"
            v-if="row.item.is_paid"
            ><i class="fas fa-eye"></i
          ></b-button>
        </template>
        <template #cell(created_at)="row">
          {{ row.value | date }}
        </template>
        <template #cell(updated_at)="row">
          {{ row.value | date }}
        </template>
      </b-table>
      <b-row>
        <b-col md="6">
          <small class="form-text text-muted">
            Từ {{ (currentPage - 1) * perPage + 1 }} đến
            {{
              perPage * currentPage > totalRows
                ? totalRows
                : perPage * currentPage
            }}
            trong {{ totalRows }} kết quả</small
          >
        </b-col>
        <b-col md="6">
          <b-pagination
            align="right"
            v-model="currentPage"
            :total-rows="totalRows"
            :per-page="perPage"
          >
          </b-pagination>
        </b-col>
      </b-row>
    </b-card>
    <b-modal
      id="modal-show"
      size="xl"
      scrollable
      :title="'Hóa đơn #' + id"
      header-bg-variant="teal"
      hide-footer
    >
      <invoice-show :id="id" :isLoaded="isLoaded" />
    </b-modal>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Invoice from "../../apis/Invoice";
import InvoiceShow from "./InvoiceShow.vue";
export default {
  components: { InvoiceShow },
  props: {
    isLoaded: Boolean,
  },
  data() {
    return {
      totalRows: 1,
      currentPage: 1,
      perPage: 5,
      pageOptions: [5, 10, 15, { value: 100, text: "Hiển thị tất cả" }],
      sortBy: "",
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      filterOn: [],
      id: 0,
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
    xoa(id) {
      this.$swal({
        title: "Bạn chắc chắn muốn xóa?",
        showCancelButton: true,
        confirmButtonText: `Xóa`,
      }).then((result) => {
        if (result.isConfirmed) {
          this.$emit("loading");
          Invoice.delete(id)
            .then((res) => {
              this.$swal("Đã xóa thành công").then(() => {
                this.invoiceIndex();
              });
              this.$emit("loaded");
            })
            .catch((err) => {
              if (err.response.status == 401) {
                localStorage.removeItem("token");
                this.$router.push({ name: "Login" });
              }
              this.$emit("loaded");
            });
        } else {
          this.$swal("Đã hủy xóa");
        }
      });
    },
    thanhtoan(id) {
      this.$swal({
        title: "Thanh toán hóa đơn #" + id + " ?",
        showCancelButton: true,
        confirmButtonText: `Thanh toán`,
      }).then((result) => {
        if (result.isConfirmed) {
          this.$emit("loading");
          Invoice.thanhToan(id)
            .then((res) => {
              this.invoiceIndex();
              this.$emit("loaded");
            })
            .catch((err) => {
              if (err.response.status == 401) {
                localStorage.removeItem("token");
                this.$router.push({ name: "Login" });
              }
              this.$emit("loaded");
            });
        }
      });
    },
  },
  computed: {
    ...mapGetters(["getInvoice", "getFieldsInvoice"]),
  },
  mounted() {
    this.filterOn = this.getFieldsInvoice.map((x) => x["key"]);
    this.totalRows = this.getInvoice.length;
  },
  watch: {
    getInvoice: function (val) {
      this.totalRows = val.length;
    },
  },
};
</script>

<style>
</style>