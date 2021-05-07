<template>
  <div>
    <b-form-group
      label="Tên bộ phận :"
      label-cols-lg="2"
      label-align="left"
      label-align-sm="right"
      label-class="font-weight-bold"
    >
      <b-form-input
        type="text"
        id="name"
        placeholder="Ví dụ: Quản lý"
        v-model="department.name"
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
import Department from "../../apis/Department";
export default {
  props: {
    id: Number,
  },
  data() {
    return {
      department: {
        name: null,
      },
      errors: [],
    };
  },
  methods: {
    ...mapActions(["setDepartment"]),
    show() {
      this.$emit("loading");
      Department.show(id)
        .then((res) => {
          this.$emit("loaded");
        })
        .catch((err) => {
          this.$emit("loaded");
        });
    },
    departmentIndex() {
      this.$emit("loading");
      Department.index()
        .then((res) => {
          this.setDepartment(res.data);
          this.$emit("loaded");
        })
        .catch((err) => {
          if (err.response.status == 401) {
            localStorage.removeItem("token");
            this.$router.push({ name: "Login" });
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
  mounted(){
    this.show();
  }
};
</script>

<style>
</style>