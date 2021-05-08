<template>
  <div class="content pt-1">
    <router-view :isLoaded="isLoaded" />
  </div>
</template>

<script>
import Type from '../../apis/Type'
import { mapActions } from 'vuex';
export default {
  data() {
    return {
      isLoaded: true,
    };
  },
  methods: {
    ...mapActions(["setType"]),
    typeIndex() {
      this.isLoaded = false;
      Type.index()
        .then((res) => {
          this.setType(res.data);
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
    this.typeIndex();
  },
};
</script>

<style>
</style>