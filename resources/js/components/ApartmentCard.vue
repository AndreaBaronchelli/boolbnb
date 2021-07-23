<template>
    <div class="card">
        <!-- DA RISOLVERE -->
        <div class="img-cont">
            <img
                :src="`http://127.0.0.1:8000/storage/${apartment.image}`"
                :alt="apartment.title"
            />
        </div>

        <h2>{{ apartment.title }}</h2>
        <div>
            <p>{{ apartment.address }}</p>
        </div>

        <div>
            <p>{{ apartment.square_meters }} mq</p>
        </div>
        <div>
            <p>
                Price per night: <strong>€{{ apartment.price }}</strong>
            </p>
        </div>
        <router-link
            :to="{
                name: 'apartment-details',
                params: { slug: apartment.slug }
            }"
            >See Details</router-link
        >
    </div>
</template>

<script>
export default {
    name: "ApartmentCard",
    props: ["apartment"]
};
</script>

<style lang="scss" scoped>
.card {
    width: 250px;
    text-align: center;
    background: white;
    border-radius: 10px;
    padding: 20px 10px;
    margin: 10px;
    font-size: 16px;
    p {
        margin-bottom: 5px;
    }
    p:last-child {
        margin-bottom: 15px;
    }
    h2{
        color:#a63c3f;
    }
}
a{
    text-decoration: none;
    color:#fb5a5f;
    font-size: 18px;
}


.img-cont {
    width: 80%;
    margin-left: 10%;
    height: 150px;
    img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
}
</style>
