<template>
    <div class="footer">
        <div class="container">
            <div class="credits">
                © Created by Class #30's Team 4 😎
            </div>
            <div class="logo">
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-twitter"></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Footer"
};
</script>

<style lang="scss" scoped>
.footer {
    width: 100%;
    background: #a63c3f;
    position: fixed;
    bottom: 0;
    z-index: 10;
    .container {
        height: 100%;
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        color: white;
        font-size: 18px;
        i {
            padding:10px;
        }
    }
    .credits,
    .logo{
            padding:10px 20px;
        }
}
</style>
