<script setup>
import { usePage } from '@inertiajs/vue3';

    const {props} = usePage();
    const user = props.user;
    const regularDeals = props.regularDeals;
    const pointDeals = props.pointDeals;
</script>

<template>
  <h1>{{ user.name }}</h1>
  <h1>{{ user.points }}</h1>
  <h1>{{ regularDeals[0].name }}</h1>
  <h1>{{ pointDeals[0].details }}</h1>
</template>

<style scoped>
</style>