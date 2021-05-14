<template>
  <div class="content pt-2">
    <phuc-vu />
    <hr />
    <thu-ngan />
    <hr />
    <bep />
  </div>
</template>

<script>
import Bep from "../components/StaffFunction/Bep.vue";
import PhucVu from "../components/StaffFunction/PhucVu.vue";
import ThuNgan from "../components/StaffFunction/ThuNgan.vue";
export default {
  components: { PhucVu, Bep, ThuNgan },
};
</script>

<style>
</style>