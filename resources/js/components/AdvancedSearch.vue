<template>
    <div class="block">
        <h3>Filters</h3>

        <div class="advanced-search">
            <div class="left">
                <!-- <input type="text" id="address"> -->
                <div class="cont-search">
                    <p>Search address</p>
                    <div id="advanced-searchbox"></div>
                </div>
                <div class="cont-select">
                    <label for="radius">Search radius</label>
                    <select v-model="radius" name="radius" id="radius">
                        <option value="10">10 km</option>
                        <option selected value="20">20 km</option>
                        <option value="30">30 km</option>
                        <option value="40">40 km</option>
                    </select>
                </div>
                <div class="cont-select">
                    <label for="rooms">Min rooms number</label>
                    <select v-model="rooms" name="rooms" id="rooms">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">4+</option>
                    </select>
                </div>
                <div class="cont-select">
                    <label for="beds">Min beds number</label>
                    <select v-model="beds" name="beds" id="beds">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">3+</option>
                    </select>
                </div>
            </div>
            <div class="right">
                <div class="services">
                    <div
                        class="service"
                        v-for="(service, index) in services"
                        :key="`${service.id} - ${index}`"
                    >
                        <input
                            type="checkbox"
                            class="checkbox"
                            v-model="checkedServices"
                            :name="service.name"
                            :id="service.id"
                            :value="service.id"
                        />
                        <label class="radio" id="radio" :for="service.id">{{
                            service.name
                        }}</label>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" @click="emitData">Search</button>
    </div>
</template>

<script>
import SearchBar from "./SearchBar.vue";
export default {
    name: "AdvancedSearch",
    props: ["query"],
    components: {
        SearchBar
    },
    data() {
        return {
            services: {},
            radius: 20,
            beds: 1,
            rooms: 1,
            checkedServices: []
        };
    },

    mounted() {
        this.createSearchBar();
        document.getElementsByClassName(
            "tt-search-box-input"
        )[0].value = decodeURI(this.query);
    },
    created() {
        this.getServices();
    },
    methods: {
        getServices() {
            axios
                .get("http://127.0.0.1:8000/api/service")
                .then(response => {
                    this.services = response.data;
                })
                .catch(err => {
                    console.log(err);
                });
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

            document
                .getElementById("advanced-searchbox")
                .appendChild(searchBoxHTML);
        },
        getSearchValue() {
            var search = document.getElementsByClassName(
                "tt-search-box-input"
            )[0].value;
            document.getElementById("address").value = search;
        },
        emitData() {
            var searchText = document.getElementsByClassName(
                "tt-search-box-input"
            )[0].value;

            if (searchText == "") {
                document.getElementsByClassName(
                    "tt-search-box-input"
                )[0].value = this.query;
                searchText = this.query;
            }
            this.$emit("searchArray", {
                rooms: this.rooms,
                beds: this.beds,
                radius: this.radius,
                checkedServices: this.checkedServices,
                search: searchText
            });
        }
    }
};
</script>

<style lang="scss" scoped>
@import "../../sass/_variables";
template {
    padding: 20px;
}
.block {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: white;
    border-radius: 10px;
    color: $thirdColor;
}
h3 {
    margin-bottom: 0;
}
.services {
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
}
.service {
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    width: 160px;
    margin-right: 20px;
}
p {
    margin-bottom: 5px;
    margin-top: 0;
    font-size: 14px;
}
.cont-select {
    display: flex;
    flex-direction: column;
    margin: 10px 20px 0 20px;
}
.cont-search {
    margin: 10px 20px 0 20px;
}
.cont-select label {
    margin-bottom: 5px;
}
.advanced-search {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: flex-start;
}
.left,
.right {
    width: 100%;
    display: flex;
    padding: 20px;
    flex-wrap: wrap;
    justify-content: flex-start;
}
.right {
    margin: 0 20px;
}
.right label {
    white-space: nowrap;
}

select {
    width: 240px;
    height: 52px;
    padding: 10px;
    border-color: $primeColor;
    color: $primeColor;
    cursor: pointer;
}
select:active,
select:visited,
select:target {
    border: none;
}
label {
    /* font-weight: bold; */
    font-size: 14px;
}
option {
    color: $primeColor;
}
.checkbox {
    position: absolute;
    z-index: -1;
    opacity: 0;
    margin: 30px;
}
.checkbox + label {
    position: relative;
    padding: 0 0 0 30px;
    cursor: pointer;
}
.checkbox + label:before {
    content: "";
    position: absolute;
    /* top: -35%; */
    left: 0;
    width: 14px;
    height: 14px;
    background: white;
    border: solid 1px $primeColor;
    transition: 0.2s;
}
/* .checkbox + label:after {
    content: "";
    position: absolute;
    top: -1px;
    left: 0px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #511d1f;
    transition: 0.2s;
} */
.checkbox:checked + label:before {
    background: $primeColor;
}
/* .checkbox:checked + label:after {
    left: 10px;
} */

button {
    height: 52px;
    line-height: 52px;
    font-size: 16px;
    background: $primeColor;
    text-decoration: none;
    color: white;
    padding: 0 10px;
    border-width: 0;
    margin: 1rem 0;
    cursor: pointer;
}
button:hover {
    background: $primeColor;
}
button {
    height: 52px;
    line-height: 52px;
    font-size: 16px;
    background: $primeColor;
    text-decoration: none;
    color: white;
    padding: 0 30px;
    border-width: 0;
    margin: 1rem 0;
}
button:hover {
    background: $primeColor;
}
</style>
