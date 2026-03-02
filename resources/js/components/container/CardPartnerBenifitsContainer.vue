<script setup>
import CardPartnerBenifits from '../cards/CardPartnerBenifits.vue';

defineProps({
    lists: {
        type: Array,
        required: true,
    },
    user: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <!-- loop through lists and render CardPartnerBenifits for each item -->
    <div
        v-if="user.completed_tours > 0"
        v-for="(list, index) in lists"
        :key="index"
    >
        <CardPartnerBenifits
            :name="list.name"
            :image="list.image"
            :details="list.details"
            :discount="list.discount_percentage"
            :location="list.location"
            :facebook="list.facebook"
            :phone="list.phone"
            :website="list.website"
        />
    </div>
    <h3 v-else class="mt-10 text-center text-lg text-gray-500">
        পার্টনার বেনিফিটগুলো আনলক করতে ইচ্ছেঘুড়ির সাথে অন্তত একটি ট্যুর সম্পন্ন
        করুন! 🎒
    </h3>
</template>

<style scoped></style>
