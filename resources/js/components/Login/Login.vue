<template>
  <div id="container">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="../../index2.html" class="h1"><b>Food</b>Vue</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Đăng nhập bằng tài khoản nhân viên</p>

          <form @submit.prevent="login">
            <div class="input-group mb-3">
              <input
                type="text"
                class="form-control"
                placeholder="Tài khoản"
                v-model="form.username"
                :class="{ 'is-invalid': errors.username }"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
              <span class="invalid-feedback" v-if="errors.username">{{
                errors.username[0]
              }}</span>
            </div>
            <div class="input-group mb-3">
              <input
                type="password"
                class="form-control"
                placeholder="Mật khẩu"
                v-model="form.password"
                :class="{ 'is-invalid': errors.password }"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              <span class="invalid-feedback" v-if="errors.password">{{
                errors.password[0]
              }}</span>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember" />
                  <label for="remember"> Remember Me </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">
                  Sign In
                </button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
          </p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <spinner v-if="!isLoaded" />
  </div>
</template>

<script>
import User from "../../apis/User";
import Spinner from "../../views/Spinner.vue";
import { mapMutations } from "vuex";
export default {
  components: { Spinner },
  data() {
    return {
      user: {
        firstName: "",
        lastName: "",
        image: "",
        department_id: 0,
      },
      isLoaded: true,
      form: {
        username: "",
        password: "",
        device_name: "Browser",
      },
      errors: {
        username: null,
        password: null,
      },
    };
  },
  methods: {
    ...mapMutations(["setUser", "setUserInfo"]),
    login() {
      this.isLoaded = false;
      User.login(this.form)
        .then((res) => {
          localStorage.setItem("token", res.data);
          User.user()
            .then((res) => {
              this.user.firstName = res.data.first_name;
              this.user.lastName = res.data.last_name;
              this.user.image = res.data.image;
              this.user.department_id = res.data.department_id;
              this.setUser(this.user);
              this.setUserInfo(res.data);
              this.isLoaded = true;
              if (this.$route.query.redirect) {
                this.$router.push(this.$route.query.redirect);
              } else this.$router.push({ name: "Home" });
            })
            .catch((err) => {
              if (err.response.status == 401) {
                localStorage.removeItem("token");
                this.$router.push({ name: "Login" });
              }
              this.isLoaded = true;
            });
        })
        .catch((err) => {
          if (err.response.status == 422)
            this.errors = err.response.data.errors;
          this.isLoaded = true;
        });
    },
  },
};
</script>

<style scoped>
#container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}
</style>