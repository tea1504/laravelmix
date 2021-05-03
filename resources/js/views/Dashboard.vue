<template>
  <div class="wrapper">
    <spinner v-if="!isLoaded" />
    <navigation />
    <sidebar />
    <div class="content-wrapper" style="min-height: 823px">
      <router-view />
    </div>
    <foot />
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import User from "../apis/User";
import Foot from "./Foot.vue";
import Navigation from "./Navigation.vue";
import Sidebar from "./Sidebar.vue";
import Spinner from "./Spinner.vue";
export default {
  components: { Navigation, Sidebar, Foot, Spinner },
  data() {
    return {
      user: {
        firstName: "",
        lastName: "",
        image: "",
        department_id: 0,
      },
      isLoaded: true,
    };
  },
  methods: {
    ...mapActions(["setUser"]),
    layUser() {
      this.isLoaded = false;
      User.user()
        .then((res) => {
          this.user.firstName = res.data.first_name;
          this.user.lastName = res.data.last_name;
          this.user.image = res.data.image;
          this.user.department_id = res.data.department_id;
          this.setUser(this.user);
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
  computed: {
    ...mapGetters(["getUser"]),
  },
  mounted() {
    this.layUser();
  }
};
</script>

<style>
</style>