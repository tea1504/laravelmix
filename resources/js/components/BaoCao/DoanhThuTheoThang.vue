<template>
  <div>
    <bar-chart
      v-if="isLoaded && typeChart == 1"
      :data="data"
      :options="options"
    />
    <horizontal-bar-chart
      v-if="isLoaded && typeChart == 2"
      :data="data"
      :options="options"
    />
    <line-chart
      v-if="isLoaded && typeChart == 3"
      :data="data"
      :options="options"
    />
    <pie-chart
      v-if="isLoaded && typeChart == 4"
      :data="data"
      :options="options"
    />
    <doughnut-chart
      v-if="isLoaded && typeChart == 5"
      :data="data"
      :options="options"
    />
  </div>
</template>

<script>
import BarChart from "../Chart/BarChart.vue";
import BaoCao from "../../apis/BaoCao";
import LineChart from "../Chart/LineChart.vue";
import PieChart from "../Chart/PieChart.vue";
import HorizontalBarChart from "../Chart/HorizontalBarChart.vue";
import DoughnutChart from "../Chart/DoughnutChart.vue";
export default {
  components: {
    BarChart,
    LineChart,
    PieChart,
    HorizontalBarChart,
    DoughnutChart,
  },
  props: {
    month: Number,
    year: Number,
    typeChart: Number,
  },
  data() {
    return {
      isLoaded: true,
      data: {
        labels: [],
        datasets: [
          {
            label: "VNĐ",
            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            backgroundColor: "#00b894",
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
    layDoanhThuTheoThang() {
      this.isLoaded = false;
      this.data.labels = [];
      this.data.datasets[0].data = [];
      if (this.month == 2) {
        for (var i = 1; i <= 28; i++) {
          this.data.datasets[0].data.push(0);
          this.data.labels.push(i + "/" + this.month);
        }
      } else if (this.month ==1 ||this.month ==3||this.month ==5||this.month ==7||this.month ==8||this.month ==10||this.month ==12) {
        for (var i = 1; i <= 31; i++) {
          this.data.datasets[0].data.push(0);
          this.data.labels.push(i + "/" + this.month);
        }
      } else {
        for (var i = 1; i <= 30; i++) {
          this.data.datasets[0].data.push(0);
          this.data.labels.push(i + "/" + this.month);
        }
      }
      BaoCao.layDoanhThuTheoThang({ nam: this.year, thang: this.month })
        .then((res) => {
          res.data.forEach((el) => {
            this.data.datasets[0].data[el.ngay - 1] = el.doanhthu;
          });
          console.log(this.data);
          this.isLoaded = true;
        })
        .catch((err) => {
          this.isLoaded = true;
        });
    },
  },
  mounted() {
    this.layDoanhThuTheoThang();
  },
  watch: {
    year() {
      this.layDoanhThuTheoThang();
    },
    month() {
      this.layDoanhThuTheoThang();
    },
  },
};
</script>

<style>
</style>