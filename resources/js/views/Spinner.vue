<template>
  <div>
    <b-spinner variant="success" label="Spinning"></b-spinner>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
div {
  position: fixed;
  top: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #cccc;
  width: 100vw;
  height: 100vh;
  z-index: 9999;
}
</style>