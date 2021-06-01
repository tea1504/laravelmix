<template>
  <div class="p-1">
    <b-card header-tag="header" header-class="card-header">
      <template #header>
        <h3 class="card-title">
          <i class="fas fa-chart-pie mr-1"></i>
          Doanh thu theo các tháng trong năm
        </h3>
        <div class="card-tools">
          <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
              <a
                class="nav-link"
                :class="{ active: loaiNam == 1 }"
                style="cursor: pointer"
                @click="loaiNam = 1"
                data-toggle="tab"
                >Bar</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                :class="{ active: loaiNam == 2 }"
                style="cursor: pointer"
                @click="loaiNam = 2"
                data-toggle="tab"
                >Horizontal bar</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                :class="{ active: loaiNam == 3 }"
                style="cursor: pointer"
                @click="loaiNam = 3"
                data-toggle="tab"
                >Line</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                :class="{ active: loaiNam == 4 }"
                style="cursor: pointer"
                @click="loaiNam = 4"
                data-toggle="tab"
                >Pie</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                :class="{ active: loaiNam == 5 }"
                style="cursor: pointer"
                @click="loaiNam = 5"
                data-toggle="tab"
                >Doughnut</a
              >
            </li>
            <li class="nav-item mx-1">
              <b-form-select
                :options="yearOpt"
                v-model="yearLoaiNam"
              ></b-form-select>
            </li>
          </ul>
        </div>
      </template>
      <doanh-thu-theo-nam :year="yearLoaiNam" :typeChart="loaiNam" />
    </b-card>
    <b-card header-tag="header" header-class="card-header">
      <template #header>
        <h3 class="card-title">
          <i class="fas fa-chart-pie mr-1"></i>
          Doanh thu theo các ngày trong tháng
        </h3>
        <div class="card-tools">
          <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
              <a
                class="nav-link"
                :class="{ active: loaiThang == 1 }"
                style="cursor: pointer"
                @click="loaiThang = 1"
                data-toggle="tab"
                >Bar</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                :class="{ active: loaiThang == 2 }"
                style="cursor: pointer"
                @click="loaiThang = 2"
                data-toggle="tab"
                >Horizontal bar</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                :class="{ active: loaiThang == 3 }"
                style="cursor: pointer"
                @click="loaiThang = 3"
                data-toggle="tab"
                >Line</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                :class="{ active: loaiThang == 4 }"
                style="cursor: pointer"
                @click="loaiThang = 4"
                data-toggle="tab"
                >Pie</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                :class="{ active: loaiThang == 5 }"
                style="cursor: pointer"
                @click="loaiThang = 5"
                data-toggle="tab"
                >Doughnut</a
              >
            </li>
            <li class="nav-item mx-1">
              <b-form-select
                :options="yearOpt"
                v-model="yearLoaiThang"
              ></b-form-select>
            </li>
            <li class="nav-item mx-1">
              <b-form-select
                :options="monthOpt"
                v-model="monthLoaiThang"
              ></b-form-select>
            </li>
          </ul>
        </div>
      </template>
      <doanh-thu-theo-thang
        :year="yearLoaiThang"
        :month="monthLoaiThang"
        :typeChart="loaiThang"
      />
    </b-card>
    <b-card header-tag="header" header-class="card-header">
      <template #header>
        <h3 class="card-title">
          <i class="fas fa-chart-pie mr-1"></i>
          So sánh doanh thu theo tháng
        </h3>
        <div class="card-tools">
          <ul class="nav nav-pills ml-auto">
            <li class="nav-item mx-1">
              <b-form-select
                :options="yearOpt"
                v-model="yearLoaiThangSS"
              ></b-form-select>
            </li>
          </ul>
        </div>
      </template>
      <so-sanh-doanh-thu-theo-thang
        :year="yearLoaiThangSS"
      />
    </b-card>
  </div>
</template>

<script>
import DoanhThuTheoNam from "./DoanhThuTheoNam.vue";
import DoanhThuTheoThang from "./DoanhThuTheoThang.vue";
import SoSanhDoanhThuTheoThang from './SoSanhDoanhThuTheoThang.vue';
export default {
  components: { DoanhThuTheoNam, DoanhThuTheoThang, SoSanhDoanhThuTheoThang },
  data() {
    return {
      yearOpt: [],
      monthOpt: [],
      yearLoaiNam: 2021,
      yearLoaiThang: 2021,
      monthLoaiThang: 1,
      loaiNam: 1,
      loaiThang: 3,
      yearLoaiThangSS: 2021,
    };
  },
  methods: {
    getYear() {
      var now = new Date().getFullYear();
      this.yearOpt.push({
        value: now - 1,
        text: now - 1,
      });
      this.yearOpt.push({
        value: now,
        text: now,
      });
      this.yearOpt.push({
        value: now + 1,
        text: now + 1,
      });
    },
    getMonth() {
      for (var i = 1; i <= 12; i++) {
        this.monthOpt.push({
          value: i,
          text: "tháng " + i,
        });
      }
    },
  },
  mounted() {
    this.getYear();
    this.getMonth();
  },
};
</script>

<style>
</style>