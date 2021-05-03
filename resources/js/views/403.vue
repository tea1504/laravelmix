<template>
  <div class="main">
    <div class="error-page">
      <h2 class="headline text-danger">403</h2>

      <div class="error-content">
        <h3>
          <i class="fas fa-exclamation-triangle text-danger"></i> Lỗi! Quyền truy cập
        </h3>

        <p>
          We could not find the page you were looking for. Meanwhile, you may
          <a @click="$router.push({name: 'Dashboard'})" class="text-danger" style="cursor: pointer;">return to dashboard</a> or try using the
          search form.
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.main{
    display: flex;
    height: 100vh;
    justify-content: center;
    align-items: center;
}
</style>