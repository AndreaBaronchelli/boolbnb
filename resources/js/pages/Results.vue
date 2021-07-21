<template>
    <div class="container">
        <h1>results</h1>
        <div class="main-content">
            <AdvancedSearch @searchArray="performingSearch" :query="query" />
            <!-- <div v-if="(apartmentsArray = [])">
                <h2>No results found</h2>
            </div> -->
            <div v-if="!apartmentsArray">Loading...</div>
            <div class="cards-container" v-else>
                <ApartmentCard
                    v-for="apartment in apartmentsArray"
                    :key="apartment.id"
                    :apartment="apartment"
                    :query="query"
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
    data() {
        return {
            query: ""
        };
    },
    components: {
        ApartmentCard,
        AdvancedSearch
    },
    data() {
        return {
            apartmentsArray: null
        };
    },
    created() {
        this.performSearch();
    },
    methods: {
        performSearch() {
            this.query = this.$route.params.search;
            axios
                .get(
                    `http://127.0.0.1:8000/api/apartment/${this.$route.params.search}`
                )
                .then(response => {
                    //console.log(response.data);
                    this.apartmentsArray = response.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },
        performingSearch(searchArray) {
            // this.rooms = searchArray;
            this.$emit("searchArray", searchArray);
            // console.log(this.rooms);
            // axios.get(`http://127.0.0.1:8000/api/apartment/${searchText}`)
            // .then(response => {

            // })
            // .catch(err => {
            //     console.log(err);
            // })
        }
    }
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
