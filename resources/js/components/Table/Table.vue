<template>
  <div class="content pt-1">
    <router-view :isLoaded="isLoaded" />
  </div>
</template>

<script>
import { mapActions } from "vuex";
import Table from "../../apis/Table";
export default {
  data() {
    return {
      isLoaded: true,
    };
  },
  methods: {
    ...mapActions(["setTable"]),
    tableIndex() {
      this.isLoaded = false;
      Table.index()
        .then((res) => {
          this.setTable(res.data);
          this.isLoaded = true;
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
          this.isLoaded = true;
        });
    },
  },
  mounted() {
    this.tableIndex();
  },
};
</script>

<style>
</style>