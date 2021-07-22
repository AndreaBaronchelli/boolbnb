<template>
    <header>
        <div class="container">
            <router-link :to="{ name: 'home' }">
                <img
                    class="logo"
                    :src="`./images/boolBnb.png`"
                    alt="boolBnb.png"
                />
            </router-link>
            <div class="register">
                <!-- <router-link :to="{ name: 'login' }">
                    <p> Login</p>
                </router-link>
                <router-link :to="{ name: 'home' }">
                    <p>Register</p>
                </router-link> -->

                <a href="http://127.0.0.1:8000/login">
                    
                    <p> Login</p>

                </a>

                <a href="http://127.0.0.1:8000/register">
                    <p>Register</p>
                </a>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {};
    },
    methods: {
        test() {
            console.log(this.searchText);
        },
        search(searchText) {
            this.$emit("searchText", searchText);
        }
    }
};
</script>

<style lang="scss" scoped>
header {
    padding: 10px 20px;
    background: white;
    position: relative;
    box-shadow: 5px 0 10px black;

    z-index: 10;
    .container {
        display: flex;
        justify-content: space-between;
        .register {
            display: flex;
            justify-content: center;
            align-items: center;
            a {
                text-decoration: none;
                margin-left: 20px;
                color: #fb5a5f;
                font-size: 18px;
            }
        }
    }
    .logo {
        width: 160px;
    }
}
</style>
