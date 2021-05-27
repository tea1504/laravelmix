<template>
  <div>
    <line-chart v-if="isLoaded" :data="data" :options="options" />
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
    year: Number,
    typeChart: Number,
  },
  data() {
    return {
      isLoaded: true,
      color: [
        "#00b894",
        "#fdcb6e",
        "#e17055",
        "#d63031",
        "#e84393",
        "#6c5ce7",
        "#0984e3",
        "#00cec9",
        "#ffeaa7",
        "#fab1a0",
        "#ff7675",
        "#fd79a8",
      ],
      data: {
        labels: [
          1,
          2,
          3,
          4,
          5,
          6,
          7,
          8,
          9,
          10,
          11,
          12,
          13,
          14,
          15,
          16,
          17,
          18,
          19,
          20,
          21,
          22,
          23,
          24,
          25,
          26,
          27,
          28,
          29,
          30,
          31,
        ],
        datasets: [],
      },
      options: {
        title: {
          display: true,
          text: "Biểu đồ doanh thu theo tháng",
        },
        interaction: {
          intersect: false,
        },
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true,
          },
        },
        responsive: true,
        maintainAspectRatio: false,
      },
      check: [
        false,
        false,
        false,
        false,
        false,
        false,
        false,
        false,
        false,
        false,
        false,
        false,
      ],
    };
  },
  methods: {
    layDoanhThuTheoThang() {
      this.isLoaded = false;
      this.data.datasets = [];
      BaoCao.layDoanhThuTheoThang({ nam: this.year, thang: 1 }).then((res) => {
        var temp = this.setUp(1);
        res.data.forEach((el) => {
          temp.data[el.ngay - 1] = el.doanhthu;
        });
        this.data.datasets.push(temp);
        this.check[0] = true;
        this.check.forEach((e) => {
          this.isLoaded = this.isLoaded && e;
        });
      });
      BaoCao.layDoanhThuTheoThang({ nam: this.year, thang: 2 }).then((res) => {
        var temp = this.setUp(2);
        res.data.forEach((el) => {
          temp.data[el.ngay - 1] = el.doanhthu;
        });
        this.data.datasets.push(temp);
        this.check[1] = true;
        this.check.forEach((e) => {
          this.isLoaded = this.isLoaded && e;
        });
      });
      BaoCao.layDoanhThuTheoThang({ nam: this.year, thang: 3 }).then((res) => {
        var temp = this.setUp(3);
        res.data.forEach((el) => {
          temp.data[el.ngay - 1] = el.doanhthu;
        });
        this.data.datasets.push(temp);
        this.check[2] = true;
        this.check.forEach((e) => {
          this.isLoaded = this.isLoaded && e;
        });
      });
      BaoCao.layDoanhThuTheoThang({ nam: this.year, thang: 4 }).then((res) => {
        var temp = this.setUp(4);
        res.data.forEach((el) => {
          temp.data[el.ngay - 1] = el.doanhthu;
        });
        this.data.datasets.push(temp);
        this.check[3] = true;
        this.check.forEach((e) => {
          this.isLoaded = this.isLoaded && e;
        });
      });
      BaoCao.layDoanhThuTheoThang({ nam: this.year, thang: 5 }).then((res) => {
        var temp = this.setUp(5);
        res.data.forEach((el) => {
          temp.data[el.ngay - 1] = el.doanhthu;
        });
        this.data.datasets.push(temp);
        this.check[4] = true;
        this.check.forEach((e) => {
          this.isLoaded = this.isLoaded && e;
        });
      });
      BaoCao.layDoanhThuTheoThang({ nam: this.year, thang: 6 }).then((res) => {
        var temp = this.setUp(6);
        res.data.forEach((el) => {
          temp.data[el.ngay - 1] = el.doanhthu;
        });
        this.data.datasets.push(temp);
        this.check[5] = true;
        this.check.forEach((e) => {
          this.isLoaded = this.isLoaded && e;
        });
      });
      BaoCao.layDoanhThuTheoThang({ nam: this.year, thang: 7 }).then((res) => {
        var temp = this.setUp(7);
        res.data.forEach((el) => {
          temp.data[el.ngay - 1] = el.doanhthu;
        });
        this.data.datasets.push(temp);
        this.check[6] = true;
        this.check.forEach((e) => {
          this.isLoaded = this.isLoaded && e;
        });
      });
      BaoCao.layDoanhThuTheoThang({ nam: this.year, thang: 8 }).then((res) => {
        var temp = this.setUp(8);
        res.data.forEach((el) => {
          temp.data[el.ngay - 1] = el.doanhthu;
        });
        this.data.datasets.push(temp);
        this.check[7] = true;
        this.check.forEach((e) => {
          this.isLoaded = this.isLoaded && e;
        });
      });
      BaoCao.layDoanhThuTheoThang({ nam: this.year, thang: 9 }).then((res) => {
        var temp = this.setUp(9);
        res.data.forEach((el) => {
          temp.data[el.ngay - 1] = el.doanhthu;
        });
        this.data.datasets.push(temp);
        this.check[8] = true;
        this.check.forEach((e) => {
          this.isLoaded = this.isLoaded && e;
        });
      });
      BaoCao.layDoanhThuTheoThang({ nam: this.year, thang: 10 }).then((res) => {
        var temp = this.setUp(10);
        res.data.forEach((el) => {
          temp.data[el.ngay - 1] = el.doanhthu;
        });
        this.data.datasets.push(temp);
        this.check[9] = true;
        this.check.forEach((e) => {
          this.isLoaded = this.isLoaded && e;
        });
      });
      BaoCao.layDoanhThuTheoThang({ nam: this.year, thang: 11 }).then((res) => {
        var temp = this.setUp(11);
        res.data.forEach((el) => {
          temp.data[el.ngay - 1] = el.doanhthu;
        });
        this.data.datasets.push(temp);
        this.check[10] = true;
        this.check.forEach((e) => {
          this.isLoaded = this.isLoaded && e;
        });
      });
      BaoCao.layDoanhThuTheoThang({ nam: this.year, thang: 12 }).then((res) => {
        var temp = this.setUp(12);
        res.data.forEach((el) => {
          temp.data[el.ngay - 1] = el.doanhthu;
        });
        this.data.datasets.push(temp);
        this.check[11] = true;
        this.check.forEach((e) => {
          this.isLoaded = this.isLoaded && e;
        });
      });
    },
    setUp(month) {
      var temp = {};
      temp.label = "Tháng " + month;
      temp.data = [];
      temp.backgroundColor = this.color[month - 1];
      for (var i = 1; i <= 31; i++) {
        temp.data.push(0);
      }
      return temp;
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