<template>
  <div>
    <router-view :isLoaded="isLoaded"/>
  </div>
</template>

<script>
export default {
  data(){
    return {
      isLoaded: true,
    }
  }
}
</script>

<style>

</style>