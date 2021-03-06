import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./pages/Home.vue";
import Results from "./pages/Results.vue";
import ApartmentDetails from "./pages/ApartmentDetails.vue";
import Thanks from "./pages/Thanks.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/results/:search",
            name: "results",
            component: Results
        },
        {
            path: "/apartment=:slug",
            name: "apartment-details",
            component: ApartmentDetails
        },
        {
            path: "/thanks",
            name: "thanks",
            component: Thanks
        }
    ]
});

export default router;
