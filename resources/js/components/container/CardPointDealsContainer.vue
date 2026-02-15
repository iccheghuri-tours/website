<script setup>
import CardPointDeals from '../cards/CardPointDeals.vue';

defineProps({
    lists: {
        type: Array,
        required: true
    },
    userPoints:{
        type: Number,
        required: true
    }
});
    
</script>

<template>
    <!--loop through lists and render CardPointDeals for each item-->
  <div v-for="(list, index) in lists" :key="index">
    <CardPointDeals 
        :title="list.name" 
        :details="list.details" 
        :points="list.points_required"
        :userPoints="userPoints"
        />
  </div>
        
</template>

<style scoped>
</style>