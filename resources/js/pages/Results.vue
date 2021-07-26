<template>
    <div class="container">
        <!-- <h1>results</h1> -->
        <div class="main-content">
            <AdvancedSearch @searchArray="performingSearch" :query="query" />
            <div v-if="apartmentsArray.length === 0">
                <h2>No results found</h2>
            </div>
            <div v-else-if="!apartmentsArray">Loading...</div>
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
            query: "",
            search: "",
            apartmentsArray: null
        };
    },
    components: {
        ApartmentCard,
        AdvancedSearch
    },
    created() {
        this.performSearch();
    },

    methods: {
        performSearch() {
            this.query = this.$route.params.search;
            this.search = encodeURI(this.$route.params.search);
            axios
                .get(`http://127.0.0.1:8000/api/apartment/${this.search}`)
                .then(response => {
                    this.apartmentsArray = response.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },
        performingSearch(searchArray) {
            if (searchArray.search != this.search) {
                this.$router.push({
                    name: "results",
                    params: { search: encodeURI(searchArray.search) }
                });
            }
            var services = "0";
            if (searchArray.checkedServices.length > 0) {
                services = searchArray.checkedServices;
            }

            axios
                .get(
                    `http://127.0.0.1:8000/api/apartment/advancedSearch/${searchArray.search}&${searchArray.radius}&${searchArray.rooms}&${searchArray.beds}&${services}`
                )
                .then(response => {
                    this.apartmentsArray = response.data;
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style lang="scss" scoped>
@import "../../sass/_variables";
.container {
    padding: 100px 0 100px 0;
}
.main-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    color: $secondColor;
    h2 {
        padding: 20px;
    }
}
.cards-container {
    padding: 20px 0;
    display: flex;
    flex-wrap: wrap;
}
</style>
