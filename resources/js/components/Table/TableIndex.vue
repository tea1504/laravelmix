<template>
  <div>
    <spinner v-if="!isLoaded" />
    <b-card
      header="Danh sách bàn"
      header-class="h1 font-weight-bold bg-gradient-teal"
    >
      <b-button v-b-modal.modal-create class="bg-teal border-0 mb-1">
        <i class="fas fa-plus"></i> Thêm mới
      </b-button>
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
        :items="getTable"
        :fields="getFieldsTable"
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
        <template #cell(created_at)="row">
          {{ row.value | date }}
        </template>
        <template #cell(updated_at)="row">
          {{ row.value | date }}
        </template>
        <template #cell(actions)="row">
          <b-button
            v-b-modal.modal-edit
            @click="id = row.item.id"
            size="sm"
            pill
            class="bg-teal"
            style="border: none"
            v-b-tooltip.hover
            title="Sửa"
            ><i class="fas fa-pen"></i
          ></b-button>
          <b-button
            size="sm"
            pill
            variant="danger"
            style="border: none"
            v-b-tooltip.hover
            title="Xóa"
            @click="xoa(row.item.id)"
            ><i class="fas fa-trash"></i
          ></b-button>
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
      id="modal-edit"
      size="xl"
      scrollable
      title="Chỉnh sửa bàn"
      header-bg-variant="teal"
      hide-footer
    >
      <table-edit :id="id" />
    </b-modal>
    <b-modal
      id="modal-create"
      size="xl"
      scrollable
      title="Thêm mới bàn"
      header-bg-variant="teal"
      hide-footer
    >
      <table-create
        v-on:loading="$emit('loading')"
        v-on:loaded="$emit('loaded')"
      />
    </b-modal>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Table from "../../apis/Table";
import Spinner from "../../views/Spinner.vue";
import TableCreate from "./TableCreate.vue";
import TableEdit from "./TableEdit.vue";
export default {
  components: { Spinner, TableCreate, TableEdit },
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
    ...mapActions(["setTable"]),
    tableIndex() {
      this.$emit("loading");
      Table.index()
        .then((res) => {
          this.setTable(res.data);
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
          Table.delete(id)
            .then((res) => {
              this.$swal("Đã xóa thành công").then(() => {
                this.tableIndex();
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
              }
              this.$emit("loaded");
            });
        } else {
          this.$swal("Đã hủy xóa");
        }
      });
    },
  },
  computed: {
    ...mapGetters(["getTable", "getFieldsTable"]),
  },
  mounted() {
    this.filterOn = this.getFieldsTable.map((x) => x["key"]);
    this.totalRows = this.getTable.length;
  },
  watch: {
    getTable: function (val) {
      this.totalRows = val.length;
    },
  },
};
</script>

<style>
</style>