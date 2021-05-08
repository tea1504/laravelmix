<template>
  <div>
    <b-form-group
      label="Tên loại món ăn :"
      label-cols-lg="2"
      label-align="left"
      label-align-sm="right"
      label-class="font-weight-bold"
    >
      <b-form-input
        type="text"
        id="name"
        placeholder="Ví dụ: Món chiên xào"
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
        <b-button class="bg-teal border-0" @click="create">Lưu</b-button>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import Type from "../../apis/Type";
export default {
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
    tableIndex() {
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
    create() {
      this.$emit("loading");
      Type.create(this.type)
        .then((res) => {
          this.$swal("Lưu thành công").then(() => {
            this.type.name = null;
            this.errors = [];
            this.tableIndex();
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