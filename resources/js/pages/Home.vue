<template>
<div class="cont">
    <main class="container">
        <div class="img">
            <img class="sfondo" :src="`./images/santorini.jpg`" alt="boolBnb.png">
        </div>
        <h1>Where would you like to go?</h1>
        <div class="searchbar"><SearchBar @searchText="search" /></div>
        <div class="sponsored">
            <ApartmentCard/>
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
        ApartmentCard,
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
.cont{
    padding:150px 0 70px 0;
}
h1{
    position: relative;
    z-index: 3;
}
.sponsored{
    position: relative;
    z-index: 3;
}
.img{
   /*  padding-top:70px; */
    position: absolute;
    top:0;
    left:0;
    height: 500px;
    width: 100vw;
    background: white;
    .sfondo{
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
