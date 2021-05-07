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
import Department from "../../apis/Department";
export default {
  props: {
    isLoaded: Boolean,
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
    create() {
      this.isLoaded = false;
      Department.create()
        .then((res) => {
          this.isLoaded = true;
        })
        .catch((err) => {
          this.isLoaded = true;
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