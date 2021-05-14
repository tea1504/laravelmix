<template>
  <div>
    <b-card>
      <b-row class="p-5">
        <b-col md="" class="avatar">
          <b-img :src="getUserInfo.image" fluid :alt="getUserInfo.name"></b-img>
        </b-col>
        <b-col md="9">
          <b-row>
            <b-col>
              <span class="h3"
                >{{ getUserInfo.last_name }} {{ getUserInfo.first_name }}</span
              >
              <br />
              <span class="h3 text-teal">{{
                getUserInfo.department_id | department
              }}</span>
            </b-col>
            <b-col> </b-col>
          </b-row>
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["getUserInfo"]),
  },
  filters: {
    department: function (value) {
      if (value == 1) return "Quản lý";
      else if (value == 2) return "Thu ngân";
      else if (value == 3) return "Bếp";
      else return "Phục vụ";
    },
  },
};
</script>

<style scoped>
.avatar {
  position: relative;
}
.avatar .file {
  position: absolute;
  bottom: 0;
}
</style>