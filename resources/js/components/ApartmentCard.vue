<template>
<div>
    <div class="card">
        <img
        :src="`http://127.0.0.1:8000/storage/${apartment.image}`"
        :alt="apartment.title"/>
        
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
            >See Details
        </router-link>
    </div>
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
    margin:10px;
    font-size: 16px;
    p{
        margin-bottom: 5px;
    }
}

.img-cont{
    width: 80%;
    margin-left: 10%;
    height: 100px;
    img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
}
</style>
