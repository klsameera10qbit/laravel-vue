<template>
    <div>
        <h4 class="text-center">Add product</h4>
        <div class="d-flex justify-content-xxl-center">
            <div class="card" style="width: 25rem;">
                <div class="card-body">
                    <form @submit.prevent="addProduct">
                        <div class="form-group">
                            <label>Title</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="product.title"
                            />
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Price</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="product.price"
                            />
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Description</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="product.description"
                            />
                        </div>
                        <br />
                        <button type="submit" class="btn btn-primary">
                            Add product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row"></div>
</template>

<script>
export default {
    data() {
        return {
            product: {},
        };
    },
    methods: {
        addProduct() {
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .post("/api/products", this.product)
                    .then((response) => {
                        this.$router.push({ name: "products" });
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            });
        },
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    },
};
</script>
