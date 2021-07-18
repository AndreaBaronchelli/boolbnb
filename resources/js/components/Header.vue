<template>
    <header>
        <a href="#">BoolBnB</a>
        <SearchBar @searchText="search" />
    </header>
</template>

<script>
import SearchBar from "../components/SearchBar";

export default {
    name: "Header",
    components: {
        SearchBar
    },
    data() {
        return {};
    },
    methods: {
        test() {
            console.log(this.searchText);
        },
        search(searchText) {
            this.$emit("searchText", searchText);
        }
    }
};
</script>

<style lang="scss" scoped>
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>
