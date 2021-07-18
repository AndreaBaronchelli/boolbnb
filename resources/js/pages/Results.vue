<template>

<div>

    <h1>results</h1>
    <div class="cards-container">
        <ApartmentCard v-for="apartment in apartmentArray" :key="apartment.id"
            :apartment="apartment"
        />
    </div>


</div>


</template>

<script>
import ApartmentCard from "../components/ApartmentCard.vue"
export default {
    name: "Results",
    components: {
        ApartmentCard
    },
    props: ['apartmentArray'],
};
</script>

<style lang="scss" scoped>
    .cards-container {
        display: flex;
        flex-basis: calc(100% / 5 - 10px);
    }
</style>
