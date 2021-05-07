<template>
  <div>
    <spinner v-if="!isLoaded"/>
  </div>
</template>

<script>
import Spinner from '../../views/Spinner.vue'
export default {
  components: { Spinner },
  props:{
    isLoaded: Boolean,
  }
}
</script>

<style>

</style>