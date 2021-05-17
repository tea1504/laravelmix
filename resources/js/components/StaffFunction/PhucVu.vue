<template>
  <div>
    <b-row cols-lg="3" cols-md="2" cols-sm="1">
      <b-col @click="$router.push({ name: 'GoiMon' })" style="cursor: pointer">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>Gọi món</h3>
            <p>Tạo mới hóa đơn</p>
          </div>
          <div class="icon">
            <i class="fab fa-accessible-icon"></i>
          </div>
        </div>
      </b-col>
      <b-col @click="$router.push({ name: 'ThemMon' })" style="cursor: pointer">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>Thêm món</h3>
            <p>Chỉnh sửa hóa đơn</p>
          </div>
          <div class="icon">
            <i class="fab fa-accessible-icon"></i>
          </div>
        </div>
      </b-col>
      <b-col @click="$router.push({ name: 'LenMon' })" style="cursor: pointer">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>Lên món</h3>
            <p>có {{slMonLen}} món</p>
          </div>
          <div class="icon">
            <i class="fab fa-accessible-icon"></i>
          </div>
        </div>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import Other from "../../apis/Other";
export default {
  data() {
    return {
      slMonLen: 0,
    };
  },
  methods: {
    demMonCho() {
      Other.demMonCho().then((res) => {
        this.slMonLen = res.data[0].c;
      });
    },
  },
  mounted() {
    this.demMonCho();
  },
};
</script>

<style>
</style>