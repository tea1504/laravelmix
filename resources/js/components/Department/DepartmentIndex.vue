<template>
  <div>
    <b-card
      header="Danh sách các bộ phận"
      header-class="h1 font-weight-bold bg-gradient-teal"
    >
      <b-button class="bg-teal border-0 mb-1">
        <i class="fas fa-plus"></i> Thêm mới
      </b-button>

      <b-table
        striped
        hover
        outlined
        sticky-header="500px"
        :items="getDepartment"
        :fields="getFieldsDepartment"
        :busy="!isLoaded"
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
            :to="{ name: 'DepartmentEdit', params: { id: row.item.id } }"
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
            ><i class="fas fa-trash"></i
          ></b-button>
        </template>
      </b-table>
    </b-card>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
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
    };
  },
  methods: {},
  computed: {
    ...mapGetters(["getDepartment", "getFieldsDepartment"]),
  },
};
</script>

<style>
</style>