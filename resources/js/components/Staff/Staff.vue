<template>
  <div class="content pt-1">
    <router-view :isLoaded="isLoaded"/>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import Staff from "../../apis/Staff";
export default {
  data(){
    return {
      isLoaded: true,
    }
  },
  methods: {
    ...mapActions(["setStaff", "setStaffPagination"]),
    staffIndex() {
      this.isLoaded = false;
      Staff.index()
        .then((res) => {
          this.setStaff(res.data);
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
    this.staffIndex();
  }
};
</script>

<style>
</style>