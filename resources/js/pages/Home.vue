<template>
    <main class="container">
        <h1>Homepage</h1>
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
.searchbar {
    width: 100%;
}
</style>
