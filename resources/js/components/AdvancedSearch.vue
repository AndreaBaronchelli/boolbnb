<template>
    <div class="advanced-search">
        <h3>AdvancedSearch</h3>
        <form class="form" action="">
            <div id="advanced-searchbox"></div>
            <!-- <input type="text" id="address"> -->
            <label for="radius">Search radius</label>
            <select name="radius" id="radius">
                <option value="10">10 km</option>
                <option selected value="20">20 km</option>
                <option value="30">30 km</option>
                <option value="40">40 km</option>
            </select>
            <label for="rooms">Min rooms number</label>
            <select name="rooms" id="rooms">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">4+</option>
            </select>
            <label for="beds">Min beds number</label>
            <select name="beds" id="beds">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">3+</option>
            </select>
            
            <div class="services">
                <div class="service" v-for="service in services" :key="service.id">
                    <input
                    type="checkbox" :name="service.name" :id="service.id">
                    <label :for="service.id">{{service.name}}</label>
                </div>
            </div>
            <button type="submit">Search</button>
        </form>
    </div>
</template>

<script>
import SearchBar from "./SearchBar.vue";
export default {
    name: "AdvancedSearch",
    components: {
        SearchBar
    },
    data() {
        return {
            services: {},
        }
    },
    mounted() {
        this.createSearchBar();
    },
    created() {
        this.getServices();
    },
    methods: {
        getServices() {
            axios.get("http://127.0.0.1:8000/api/service")
            .then(response => {
                this.services = response.data;
            }).catch(err => {
                console.log(err);
            })
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

            document.getElementById("advanced-searchbox").appendChild(searchBoxHTML);
        },
        getSearchValue() {
            var search = document.getElementsByClassName(
                "tt-search-box-input"
            )[0].value;
            document.getElementById('address').value = search;
        }
    }
};
</script>

<style>
.advanced-search {
    display: flex;
    flex-direction: column;
}

.form {
    display: flex;
    flex-direction: column;

}
</style>
