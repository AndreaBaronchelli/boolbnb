<template>
    <div class="searchbar">
        <div id="searchbox"></div>
        <router-link :to="{ name: 'results', params: { search: searchText } }">
            <button @click="clickFunction()">
                Search
            </button>
        </router-link>
    </div>
</template>

<script>
export default {
    name: "SearchBar",
    data() {
        return {
            searchText: 0
        };
    },
    mounted() {
        this.createSearchBar();
    },
    methods: {
        test() {
            this.getSearchValue();
        },
        createSearchBar() {
            var options = {
                searchOptions: {
                    key: "HWJIfN6faq5SWzGHD4GKXdsexiZdkTDa",
                    language: "en-GB",
                    limit: 5
                },
                autocompleteOptions: {
                    key: "HWJIfN6faq5SWzGHD4GKXdsexiZdkTDa",
                    language: "en-GB"
                }
            };
            var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
            var searchBoxHTML = ttSearchBox.getSearchBoxHTML();

            document.getElementById("searchbox").appendChild(searchBoxHTML);
        },
        getSearchValue() {
            var search = document.getElementsByClassName(
                "tt-search-box-input"
            )[0].value;
            return search;
        },
        clickFunction() {
            this.searchText = document.getElementsByClassName(
                "tt-search-box-input"
            )[0].value;
            this.$emit("searchText", this.getSearchValue());
        }
    }
};
</script>

<style lang="scss" scoped>
.searchbar {
    display: flex;
    align-items: center;
}
button {
    margin-left: 1rem;
}
</style>
