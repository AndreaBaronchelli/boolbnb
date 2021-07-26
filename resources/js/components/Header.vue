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
            <div class="register" v-if="this.user.user_name != ''">
                <a href="http://127.0.0.1:8000/admin"
                    >Ciao {{ this.user.user_name }}</a
                >
            </div>
            <div v-else class="register">
                <a href="http://127.0.0.1:8000/login">
                    <p>Login</p>
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
    props: ["user"],
    data() {
        return {};
    },
    methods: {
        search(searchText) {
            this.$emit("searchText", searchText);
        }
    }
};
</script>

<style lang="scss" scoped>
header {
    background: white;
    position: fixed;
    top: 0;
    width: 100%;
    box-shadow: 0 2px 10px black;
    z-index: 10;
    .container {
        padding: 10px 20px;
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
