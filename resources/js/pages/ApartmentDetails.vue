<template>
    <div class="container">
        <router-link
            :to="{ name: 'results', params: { search: this.query } }">
            Back to results
        </router-link>
        <div v-if="apartment">
            <div class="cont-img-info">
                <div class="img-cont">
                <img
                :src="`http://127.0.0.1:8000/storage/${apartment.image}`"
                :alt="apartment.title"
                />
                </div>
                <div class="info-cont">
                    <h2>{{ apartment.title }}</h2>
                    <div>
                        <p>{{ apartment.address }}</p>
                    </div>
                    <div>
                        <p>
                            Rooms: <strong>{{ apartment.rooms }}</strong>
                        </p>
                    </div>
                    <div>
                        <p>
                            Beds: <strong>{{ apartment.beds }}</strong>
                        </p>
                    </div>
                    <div>
                        <p>{{ apartment.square_meters }} mq</p>
                    </div>
                    <div>
                        <p>
                            Price per night:
                            <strong>€{{ apartment.price }}</strong>
                        </p>
                    </div>
                    Available services:
                    <div>
                        <ul>
                            <li v-for="service in apartment.services" :key="service.id">
                                <strong>{{ service.name }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="map" class="map"></div>
            </div>
            <div class="cont-form">
                <MessageForm :apartment_id="apartment.id" :user="user" />

            </div>
        </div>
        <div v-else>Loading...</div>
    </div>
</template>

<script>
import axios from "axios";
import tt from "@tomtom-international/web-sdk-maps";
import MessageForm from "../components/MessageForm.vue";

export default {
    name: "ApartmentDetails",
    components: {
        MessageForm
    },
    data() {
        return {
            apartment: null
        };
    },
    props: ["query", "user"],
    created() {
        this.getDetails();
    },
    updated() {
        this.createMap();
    },
    methods: {
        getDetails() {
            axios
                .get(
                    `http://127.0.0.1:8000/api/apartment=${this.$route.params.slug}`
                )
                .then(response => {
                    this.apartment = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        createMap() {
            tt.setProductInfo("BoolBnB", "1.0");
            tt.map({
                key: "4j77acI2RkgcxaYW2waGQ74SEPwpmFML",
                container: "map",
                center: [this.apartment.longitude, this.apartment.latitude], //Roma
                zoom: 16
            });
            // var marker = new tt.Marker()
            //     .setLngLat([this.apartment.longitude, this.apartment.latitude])
            //     .addTo(map);
        }
    }
};
</script>

<style lang="scss" scoped>
.container{
    padding:100px 0 70px 0;
}
.cont-img-info{
    background: white;
    padding:20px;
    border-radius: 10px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    color:#511d1f;
    margin-top: 20px;
}
a{
    text-decoration: none;
    color:#fb5a5f;
    padding-bottom: 20px;
    font-size: 18px;

}
.img-cont,
.map,
.info-cont{
    margin:10px;
}
.info-cont{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    h2{
        margin: 0 0 10px 0;
        color:#a63c3f;
    }
    p{
        margin: 5px 0;
    }
}
.cont-form{
    width: 100%;
}
img {
    height: 300px;
}
#map {
    width: 300px;
    height: 300px;
}
</style>
