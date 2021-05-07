<template>
  <div>
    <router-view :isLoaded="isLoaded" />
  </div>
</template>

<script>
import Table from "../../apis/Table";
export default {
  data() {
    return {
      isLoaded: true,
    };
  },
  methods: {
    tableIndex() {
      this.isLoaded = false;
      Table.index()
        .then((res) => {
          console.log(res);
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