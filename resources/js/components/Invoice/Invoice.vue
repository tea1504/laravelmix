<template>
  <div class="content pt-1">
    <router-view  :isLoaded="isLoaded" v-on:loading="isLoaded = false" v-on:loaded="isLoaded = true"/>
    <spinner v-if="!isLoaded" />
  </div>
</template>

<script>
import { mapActions } from "vuex";
import Invoice from "../../apis/Invoice";
import Spinner from "../../views/Spinner.vue";
export default {
  components: { Spinner },
  data() {
    return {
      isLoaded: true,
    };
  },
  methods: {
    ...mapActions(["setInvoice"]),
    invoiceIndex() {
      this.isLoaded = false;
      Invoice.index()
        .then((res) => {
          this.setInvoice(res.data);
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
          } else {
            this.$swal({
              icon: "error",
              title: "Lỗi",
              text: "Không lấy dữ liệu. Hãy thử lại sau.",
            });
          }
          this.isLoaded = true;
        });
    },
  },
  mounted(){
    this.invoiceIndex();
  },
};
</script>

<style>
</style>