<template>
  <div class="main">
    <div class="error-page">
      <h2 class="headline text-warning">404</h2>

      <div class="error-content">
        <h3>
          <i class="fas fa-exclamation-triangle text-warning"></i> Lỗi! Không
          tìm thấy trang
        </h3>
        <p>
          We could not find the page you were looking for. Meanwhile, you may
          <a
            @click="$router.push({ name: 'Dashboard' })"
            class="text-warning"
            style="cursor: pointer"
            >return to dashboard</a
          >
          or try using the search form.
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.main {
  display: flex;
  height: 100vh;
  justify-content: center;
  align-items: center;
}
</style>