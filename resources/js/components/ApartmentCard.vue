<template>
    <div class="card">
        <!-- DA RISOLVERE -->
        <img
            :src="`http://127.0.0.1:8000/storage/${apartment.image}`"
            :alt="apartment.title"
        />
        <h2>{{ apartment.title }}</h2>
        <div>
            <span>{{ apartment.address }}</span>
        </div>
        <div>
            <span>{{ apartment.square_meters }} mq</span>
        </div>
        <div>
            <span
                >Price per night: <strong>€{{ apartment.price }}</strong></span
            >
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
    width: 400px;
    text-align: center;
    border: 2px solid black;
    border-radius: 10px;
    margin: 10px;
    padding: 10px;
}

img {
    max-height: 220px;
}
</style>
