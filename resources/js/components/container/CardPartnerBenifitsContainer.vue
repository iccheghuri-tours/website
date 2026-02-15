<script setup>
import CardPartnerBenifits from '../cards/CardPartnerBenifits.vue';


defineProps({
    lists: {
        type: Array,
        required: true
    }
});

</script>

<template>
    <!-- loop through lists and render CardPartnerBenifits for each item -->
    <div v-for="(list, index) in lists" :key="index">
        <CardPartnerBenifits 
            :name="list.name" 
            :image="list.image" 
            :details="list.details"
            :discount="list.discount_percentage"
        />
    </div>



</template>

<style scoped>
</style>