<script setup>
import CardPartnerBenifits from '../cards/CardPartnerBenifits.vue';


defineProps({
    lists: {
        type: Array,
        required: true
    },
    user: {
        type: Object,
        required: true
    }
});

</script>

<template>
    <!-- loop through lists and render CardPartnerBenifits for each item -->
    <div v-if="user.completed_tours>0" v-for="(list, index) in lists" :key="index">
        <CardPartnerBenifits 
            :name="list.name" 
            :image="list.image" 
            :details="list.details"
            :discount="list.discount_percentage"
            :location="list.location"
            :facebook="list.facebook"
            :phone="list.phone"
        />
    </div>
    <h3 v-else class="text-center text-gray-500 mt-10 text-lg">You must complete minimum one tour to unlock partner benifits</h3>



</template>

<style scoped>
</style>