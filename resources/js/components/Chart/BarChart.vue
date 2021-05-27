<script>
import { Bar } from "vue-chartjs";

export default {
  extends: Bar,
  props: {
    data: Object,
    options: Object,
  },
  mounted() {
    this.renderChart(this.data, this.options);
  },
  watch:{
    data(){
      this.$data._chart.update()
    }
  }
};
</script>