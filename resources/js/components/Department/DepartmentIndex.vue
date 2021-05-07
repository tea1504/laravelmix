<template>
  <div>
    <b-card
      header="Danh sách các bộ phận"
      header-class="h1 font-weight-bold bg-gradient-teal"
    >
      <b-button class="bg-teal border-0 mb-1">
        <i class="fas fa-plus"></i> Thêm mới
      </b-button>

      <b-table striped hover outlined sticky-header="500px"> </b-table>
    </b-card>
  </div>
</template>

<script>
export default {
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
};
</script>

<style>
</style>