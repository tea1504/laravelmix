<template>
  <div>
    <router-view />
    <spinner v-if="!isLoaded" />
  </div>
</template>

<script>
import Spinner from "../../views/Spinner.vue";
export default {
  components: { Spinner },
  data() {
    return {
      isLoaded: true,
    };
  },
};
</script>

<style>
</style>