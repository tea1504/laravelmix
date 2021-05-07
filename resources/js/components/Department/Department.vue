<template>
  <div class="content pt-1">
    <router-view :isLoaded="isLoaded" v-on:loaded="isLoaded = true" v-on:loading="isLoaded = false"/>
    <spinner v-if="!isLoaded" />
  </div>
</template>

<script>
import { mapActions } from "vuex";
import Department from "../../apis/Department";
import Spinner from "../../views/Spinner.vue";
export default {
  components: { Spinner },
  data() {
    return {
      isLoaded: true,
    };
  },
  methods: {
    ...mapActions(["setDepartment"]),
    departmentIndex() {
      this.isLoaded = false;
      Department.index()
        .then((res) => {
          this.setDepartment(res.data);
          this.isLoaded = true;
        })
        .catch((err) => {
          if (err.response.status == 401) {
            localStorage.removeItem("token");
            this.$router.push({ name: "Login" });
          }
          this.isLoaded = true;
        });
    },
  },
  mounted() {
    this.departmentIndex();
  },
};
</script>

<style>
</style>