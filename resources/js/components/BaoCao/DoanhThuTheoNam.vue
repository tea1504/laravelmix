<template>
  <div>
    <bar-chart v-if="isLoaded && typeChart == 1" :data="data" :options="options" />
    <horizontal-bar-chart v-if="isLoaded && typeChart == 2" :data="data" :options="options" />
    <line-chart v-if="isLoaded && typeChart == 3" :data="data" :options="options" />
    <pie-chart v-if="isLoaded && typeChart == 4" :data="data" :options="options" />
    <doughnut-chart v-if="isLoaded && typeChart == 5" :data="data" :options="options" />
  </div>
</template>

<script>
import BarChart from "../Chart/BarChart.vue";
import BaoCao from "../../apis/BaoCao";
import LineChart from "../Chart/LineChart.vue";
import PieChart from "../Chart/PieChart.vue";
import HorizontalBarChart from "../Chart/HorizontalBarChart.vue";
import DoughnutChart from '../Chart/DoughnutChart.vue';
export default {
  components: { BarChart, LineChart, PieChart, HorizontalBarChart, DoughnutChart },
  props: {
    year: Number,
    typeChart: Number,
  },
  data() {
    return {
      isLoaded: true,
      data: {
        labels: ['tháng 1', 'tháng 2', 'tháng 3', 'tháng 4', 'tháng 5', 'tháng 6', 'tháng 7', 'tháng 8', 'tháng 9', 'tháng 10', 'tháng 11', 'tháng 12'],
        datasets: [
          {
            label: "VNĐ",
            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            backgroundColor: ["#00b894", "#fdcb6e", "#e17055", "#d63031", "#e84393", "#6c5ce7", "#0984e3", "#00cec9", "#ffeaa7", "#fab1a0", "#ff7675", "#fd79a8"],
          },
        ],
      },
      options: {
        title: {
          display: true,
          text: "Biểu đồ doanh thu theo tháng",
        },
        responsive: true,
        maintainAspectRatio: false,
      },
    };
  },
  methods: {
    layDoanhThuTheoNam() {
      this.isLoaded = false;
      this.data.datasets[0].data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      BaoCao.layDoanhThuTheoNam({ nam: this.year })
        .then((res) => {
          res.data.forEach((el) => {
            this.data.datasets[0].data[el.thang - 1] = el.doanhthu;
          });
          this.isLoaded = true;
        })
        .catch((err) => {
          this.isLoaded = true;
        });
    },
  },
  mounted() {
    this.layDoanhThuTheoNam();
  },
  watch: {
    year() {
      this.layDoanhThuTheoNamF();
    },
  },
};
</script>

<style>
</style>