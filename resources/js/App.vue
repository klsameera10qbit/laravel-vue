<template>
    <div class="">
        <!-- <div class="text-center" style="margin: 20px 0px 20px 0px">
            <a href="https://shouts.dev/" target="_blank"
                ><img style="width:5vw" src="https://media-exp1.licdn.com/dms/image/C560BAQGon0TC_v24VA/company-logo_200_200/0/1630252854317?e=1651708800&v=beta&t=wvxOwoShhzTWyUc5tMgfc0oHEj46u6ss_oOoNX0LaJs" /></a
            ><br />
            <span class="text-secondary">10QBit Sample CRUD</span>
        </div> -->

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand">
                <img width="30" height="30" class="d-inline-block align-text-top" src="https://media-exp1.licdn.com/dms/image/C560BAQGon0TC_v24VA/company-logo_200_200/0/1630252854317?e=1651708800&v=beta&t=wvxOwoShhzTWyUc5tMgfc0oHEj46u6ss_oOoNX0LaJs" />
                </router-link>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse">
                    <!-- for logged-in user-->
                    <div class="navbar-nav" v-if="isLoggedIn">
                        <router-link to="/dashboard" class="nav-item nav-link"
                            >Dashboard</router-link
                        >
                        <router-link to="/products" class="nav-item nav-link"
                            >products</router-link
                        >
                        <a
                            class="nav-item nav-link"
                            style="cursor: pointer"
                            @click="logout"
                            >Logout</a
                        >
                    </div>
                    <!-- for non-logged user-->
                    <div class="navbar-nav" v-else>
                        <router-link to="/" class="nav-item nav-link"
                            >Home</router-link
                        >
                        <router-link to="/login" class="nav-item nav-link"
                            >login</router-link
                        >
                        <router-link to="/register" class="nav-item nav-link"
                            >Register
                        </router-link>
                        <router-link to="/about" class="nav-item nav-link"
                            >About</router-link
                        >
                    </div>
                </div>
            </div>
        </nav>
        <br />
        <router-view />
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
        };
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true;
        }
    },
    methods: {
        logout(e) {
            console.log("ss");
            e.preventDefault();
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .post("/api/logout")
                    .then((response) => {
                        if (response.data.success) {
                            window.location.href = "/";
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            });
        },
    },
};
</script>
