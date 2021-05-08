<template>
  <div>
    <b-form-group
      label="Tên bàn :"
      label-cols-lg="2"
      label-align="left"
      label-align-sm="right"
      label-class="font-weight-bold"
    >
      <b-form-input
        type="text"
        id="name"
        placeholder="Ví dụ: Bàn 1"
        v-model="type.name"
        :state="errors.name | check"
        aria-describedby="name_err"
      >
      </b-form-input>
      <b-form-invalid-feedback id="name_err" v-if="errors.name">
        {{ errors.name[0] }}
      </b-form-invalid-feedback>
    </b-form-group>
    <b-row>
      <b-col offset="2">
        <b-button class="bg-teal border-0" @click="update">Lưu</b-button>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import Type from "../../apis/Type";
export default {
  props: {
    id: Number,
  },
  data() {
    return {
      type: {
        name: null,
      },
      errors: [],
    };
  },
  methods: {
    ...mapActions(["setType"]),
    typeIndex() {
      this.$emit("loading");
      Type.index()
        .then((res) => {
          this.setType(res.data);
          this.$emit("loaded");
        })
        .catch((err) => {
          if (err.response.status == 401) {
            localStorage.removeItem("token");
            this.$router.push({
              name: "Login",
              query: { redirect: to.fullPath },
            });
          }
          this.$emit("loaded");
        });
    },
    update() {
      this.$emit("loading");
      Type.update(this.type, this.id)
        .then((res) => {
          this.$swal("Lưu thành công").then(() => {
            this.show();
            this.errors = [];
            this.typeIndex();
          });
          this.$emit("loaded");
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
          } else if (err.response.status == 422) {
            this.errors = err.response.data.errors;
          } else {
            this.$swal({
              icon: "error",
              title: "Lỗi",
              text: "Không thể lưu dữ liệu. Hãy thử lại sau.",
            });
          }
          this.$emit("loaded");
        });
    },
    show() {
      this.$emit("loading");
      Type.show(this.id)
        .then((res) => {
          this.type = res.data;
          this.$emit("loaded");
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
              text: "Không thể lấy dữ liệu. Hãy thử lại sau.",
            });
          }
          this.$emit("loaded");
        });
    },
  },
  mounted() {
    this.show();
  },
  filters: {
    check: function (value) {
      return value == null ? null : false;
    },
  },
};
</script>

<style>

</style>