<template>
    <main class="container">
        <div class="img">
            <img class="sfondo" :src="`./images/santorini.jpg`" alt="boolBnb.png">
        </div>
        <h1>Where would you like to go?</h1>
        <div class="searchbar"><SearchBar @searchText="search" /></div>
    </main>
</template>

<script>
import SearchBar from "../components/SearchBar.vue";
export default {
    name: "Home",
    components: {
        SearchBar
    },
    methods: {
        search(searchText) {
            this.$emit("searchText", searchText);
        }
    }
};
</script>

<style lang="scss" scoped>
.cotainer{
    position: relative;
}

.img{
    position: absolute;
    top:0;
    left:0;
    height: 100vh;
    width: 100vw;
    background: white;
    .sfondo{
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* filter: opacity(50%); */
        /* filter: grayscale(50%); */
}
    
}
    
.searchbar {
    width: 100%;
}
</style>
