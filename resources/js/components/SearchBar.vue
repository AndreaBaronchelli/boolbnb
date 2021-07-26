<template>
    <div class="searchbar">
        <div id="searchbox"></div>
        <!-- <router-link :to="{ name: 'results', params: { search: searchText } }"> -->
            <button class="button" @click="clickFunction()">
                Search
            </button>
        <!-- </router-link> -->
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
            if (this.searchText != "") {
                this.$router.push({name: 'results', params: { search: encodeURI(this.searchText) }})
                console.log(this.searchText);
            }
        }
    }
};
</script>

<style lang="scss" scoped>
@import "../../sass/_variables";
.searchbar {
    display: flex;
    align-items: center;
    justify-content: center;
}
#searchbox {
    width: 50%;
}
.button {
    height: 52px;
    line-height: 52px;
    font-size: 16px;
    background: $primeColor;
    text-decoration: none;
    color: white;
    padding: 0 10px;
    position: relative;
    z-index: 8;
    cursor: pointer;
}
.button:hover {
    background: $primeColor;
}
a {
    text-decoration: none;
}
</style>
