<template>
    <div class="cont">
        <main class="container">
            <div class="img">
                <img
                    class="sfondo"
                    :src="`./images/santorini.jpg`"
                    alt="boolBnb.png"
                />
            </div>
            <h1>Where would you like to go?</h1>
            <div class="searchbar"><SearchBar @searchText="search" /></div>
            <div class="sponsored">
                <h2>Our monthly apartments</h2>
                <div class="sponsored-apartments">
                    <ApartmentCard
                        v-for="apartment in apartments"
                        :key="apartment.id"
                        :apartment="apartment"
                    />
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import SearchBar from "../components/SearchBar.vue";
import ApartmentCard from "../components/ApartmentCard.vue";
export default {
    name: "Home",
    components: {
        SearchBar,
        ApartmentCard
    },
    data() {
        return {
            apartments: []
        };
    },
    mounted() {
        this.getSponsoredApartments();
    },
    methods: {
        search(searchText) {
            this.$emit("searchText", searchText);
        },
        getSponsoredApartments() {
            axios
                .get(`http://127.0.0.1:8000/api/sponsoredApartments`)
                .then(response => {
                    console.log(response.data.apartments.data);
                    this.apartments = response.data.apartments.data;
                    console.log(this.apartments);
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

.cont {
    padding: 150px 0 70px 0;
}
h1 {
    position: relative;
    z-index: 3;
}
.sponsored {
    position: relative;
    z-index: 3;
    text-align: center;
    color: $secondColor;
    padding-top: 200px;
}
.sponsored-apartments {
    display: flex;
    flex-wrap: wrap;
}
.img {
    /*  padding-top:70px; */
    position: absolute;
    top: 0;
    left: 0;
    height: 500px;
    width: 100vw;
    background: white;
    .sfondo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: opacity(50%);
        /* filter: grayscale(50%); */
    }
}

.searchbar {
    width: 100%;
}
</style>
