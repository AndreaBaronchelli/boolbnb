<template>
    <div class="container">
        <h1>results</h1>
        <div class="main-content">
            <AdvancedSearch />
            <div v-if="Array.isArray(apartmentArray)">
                <h2>No results found</h2>
            </div>
            <div class="cards-container" v-else>
                <ApartmentCard
                    v-for="apartment in apartmentArray"
                    :key="apartment.id"
                    :apartment="apartment"
                />
            </div>
        </div>
    </div>
</template>

<script>
import ApartmentCard from "../components/ApartmentCard.vue";
import AdvancedSearch from "../components/AdvancedSearch.vue";
export default {
    name: "Results",
    components: {
        ApartmentCard,
        AdvancedSearch
    },
    props: ["apartmentArray"]
};
</script>

<style lang="scss" scoped>
.main-content {
    display: flex;
}
.cards-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
}
</style>
