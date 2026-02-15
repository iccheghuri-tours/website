<script setup>
defineProps({
  name: String,
  image: String,
  details: String
})
</script>

<template>
  <div class="benefit-card">
    <h3 class="benefit-name">{{ name }}</h3>

    <div class="benefit-content">
      <div class="logo-wrapper">
        <img :src="image" :alt="name" class="brand-logo" />
      </div>
      <p class="benefit-details">
        {{ details }}
      </p>
    </div>
  </div>
</template>

<style scoped>
/* Mobile-first Dark Theme */
.benefit-card {
  background-color: #1e1e1e;
  border: 1px solid #333;
  border-radius: 12px;
  padding: 16px;
  margin-bottom: 12px;
  color: #ffffff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}

.benefit-name {
  font-size: 0.85rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #999;
  margin: 0 0 10px 0;
  border-bottom: 1px solid #333;
  padding-bottom: 8px;
}

.benefit-content {
  display: flex;
  align-items: center;
  gap: 16px;
}

.logo-wrapper {
  flex-shrink: 0;
  width: 50px;
  height: 50px;
  background-color: #2a2a2a;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.brand-logo {
  max-width: 80%;
  max-height: 80%;
  object-fit: contain;
}

.benefit-details {
  font-size: 1rem;
  line-height: 1.4;
  margin: 0;
  color: #e0e0e0;
  font-weight: 500;
}
</style>