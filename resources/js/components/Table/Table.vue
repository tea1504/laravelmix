<template>
  <div>
    <router-view :isLoaded="isLoaded"/>
  </div>
</template>

<script>
import Table from '../../apis/Table'
export default {
  data(){
    return {
      isLoaded: true,
    }
  },
  methods:{
    tableIndex(){
      Table
    }
  },
}
</script>

<style>

</style>