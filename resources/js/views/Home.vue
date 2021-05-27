<template>
  <div class="content pt-2">
    <quan-ly v-if="isQuanLy" />
    <phuc-vu v-if="isPhucVu" />
    <thu-ngan v-if="isThuNgan" />
    <bep v-if="isBep" />
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import Bep from "../components/StaffFunction/Bep.vue";
import PhucVu from "../components/StaffFunction/PhucVu.vue";
import QuanLy from "../components/StaffFunction/QuanLy.vue";
import ThuNgan from "../components/StaffFunction/ThuNgan.vue";
export default {
  components: { PhucVu, Bep, ThuNgan, QuanLy },
  computed: {
    ...mapGetters(["getUser", "isQuanLy", "isThuNgan", "isBep", "isPhucVu"]),
  },
};
</script>

<style>
</style>