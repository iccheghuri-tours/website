<script setup>
import { usePage } from '@inertiajs/vue3';

    const {props} = usePage();
    const user = props.user;
</script>

<template>
  <h1>{{ user.name }}</h1>
  <h1>{{ user.points }}</h1>
</template>

<style scoped>
</style>