<template>
    <div class="container">
        <h1>results</h1>
        <div class="main-content">
            <AdvancedSearch @searchArray="performingSearch" :query="query" />
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
    props: ["apartmentArray", 'query'],
    data() {
        return {
            // rooms: '',
            
        }
    },
    
    
    methods: {
        performingSearch(searchArray) {
            // this.rooms = searchArray;
            this.$emit('searchArray',searchArray);
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
    flex-wrap: wrap;
    justify-content:flex-start;
    color:#511d1f;
    h2{
        
        padding: 20px;
    }
}
.cards-container{
    padding: 20px 0;
    display: flex;
    flex-wrap: wrap;
}

</style>
