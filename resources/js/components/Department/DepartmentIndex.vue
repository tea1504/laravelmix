<template>
  <div>
    <b-card
      header="Danh sách các bộ phận"
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
        :items="getDepartment"
        :fields="getFieldsDepartment"
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
      title="Chỉnh sửa bộ phận"
      hide-footer
    >
      <department-edit :id="id"/>
    </b-modal>
    <b-modal
      id="modal-create"
      size="xl"
      scrollable
      title="Thêm mới bộ phận"
      header-bg-variant="teal"
      hide-footer
    >
      <department-create v-on:loading="$emit('loading')" v-on:loaded="$emit('loaded')"/>
    </b-modal>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import DepartmentEdit from "./DepartmentEdit.vue";
import DepartmentCreate from "./DepartmentCreate";
export default {
  components: { DepartmentEdit, DepartmentCreate },
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
    xoa(id){
      console.log(id);
    }
  },
  computed: {
    ...mapGetters(["getDepartment", "getFieldsDepartment"]),
  },
  mounted() {
    this.filterOn = this.getFieldsDepartment.map((x) => x["key"]);
    this.totalRows = this.getDepartment.length;
  },
  watch: {
    getDepartment: function (val) {
      this.totalRows = val.length;
    },
  },
};
</script>

<style>
</style>