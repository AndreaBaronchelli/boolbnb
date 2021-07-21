<template>
    <div class="block">
        <h3>AdvancedSearch</h3>
        <div class="advanced-search">
            <div class="left">
                <div id="advanced-searchbox"></div>
                <!-- <input type="text" id="address"> -->
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
                

        <div id="advanced-searchbox"></div>
        <!-- <input type="text" id="address"> -->
        <label for="radius">Search radius</label>
        <select v-model="radius" name="radius" id="radius">
            <option value="10">10 km</option>
            <option selected value="20">20 km</option>
            <option value="30">30 km</option>
            <option value="40">40 km</option>
        </select>
        <label for="rooms">Min rooms number</label>
        <select v-model="rooms" name="rooms" id="rooms">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">4+</option>
        </select>
        <label for="beds">Min beds number</label>
        <select v-model="beds" name="beds" id="beds">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">3+</option>
        </select>

        <!-- <button >test</button> -->

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
            <div class="right">
                <!-- <button >test</button> -->
                <div class="services">
                    <div class="service" 
                        v-for="(service, index) in services" 
                        :key="`${service.id} - ${index}`">
                        <input
                        type="checkbox" class="checkbox"
                        v-model="checkedServices[index]" 
                        :name="service.name" 
                        :id="service.id">
                        <label class="radio" id="radio" :for="service.id">{{service.name}}</label>
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
        )[0].value = this.query;
    },
    created() {
        this.getServices();
    },
    methods: {
        // test() {
        //     console.log(this.radius, this.beds, this.rooms, this.checkedServices);
        //     console.log(document.getElementsByClassName("tt-search-box-input")[0].value);
        // },
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

<style>
template {
    padding: 20px;
}
.block{
    display: flex;
    flex-direction: column;
    align-items: center;
    background:white;
    border-radius: 10px;
    padding: 10px;
    color:#511d1f;
}
.cont-select{
    display: flex;
    flex-direction: column;
}
.cont-select label{
    margin-bottom: 5px;
}
.advanced-search {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.left,
.right{
    display: flex;
    flex-direction: column;
    width: 250px;
    padding: 20px;
}
.left{
    margin-bottom: 20px;
    justify-content: space-between;

}
select{
    padding:10px;
    background: white;
    padding: 10px;
    border-radius: 10px;
    margin-right: 20px;
    color: #511d1f;
}
select {
    padding: 10px;
    border-color: #fb5a5f;
    color: #fb5a5f;
}
select:active,
select:visited,
select:target {
    border: none;
}
label {
    margin-top: 1rem;
    margin-bottom: 0.5rem;
    font-weight: bold;
}
option {
    color: #fb5a5f;
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
	content: '';
	position: absolute;
	top:-35%;
	left: 0;
	width: 20px;
	height: 20px;
	background: white;
    border:solid 1px #fb5a5f;
	transition: .2s;
}
.checkbox + label:after {
	content: '';
	position: absolute;
	top: -1px;
	left: 0px;
	width: 10px;
	height: 10px;
	border-radius: 50%;
	background: #511d1f;
	transition: .2s;
}
.checkbox:checked + label:before {
	background: #fb5a5f;
    content: "";
    position: absolute;
    top: -35%;
    left: 0;
    width: 20px;
    height: 20px;
    border-radius: 25%;
    background: #fb5a5f;
    transition: 0.2s;
}
.checkbox + label:after {
    content: "";
    position: absolute;
    top: -1px;
    left: 0px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #fff;
    transition: 0.2s;
}
.checkbox:checked + label:before {
    background: #511d1f;
}
.checkbox:checked + label:after {
    left: 10px;
}
.service{
    height: 30px;
    margin-top: 0.2rem;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    width: 100%;

}

.form {
    display: flex;
    flex-direction: column;
}
button {
    height: 52px;
   line-height:52px;
   font-size: 16px;
   background:#fb5a5f;
   text-decoration: none;
   color:white;
   padding: 0 30px;
   border-width: 0;
   margin:1rem 0;
}
button:hover{
    background:#fd7d82;
    line-height: 52px;
    font-size: 16px;
    background: #fb5a5f;
    text-decoration: none;
    color: white;
    padding: 0 10px;
    border-width: 0;
    margin: 1rem 0;
}
button:hover {
    background: #fd7d82;
}
</style>
