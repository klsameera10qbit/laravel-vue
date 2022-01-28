<template>
    <div>
        <h4 class="text-center">Edit product</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateProduct">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="product.title">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" v-model="product.price">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="product.description">
                    </div>
                    <button type="submit" class="btn btn-primary">Update product</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            product: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/products/${this.$route.params.id}`)
                .then(response => {
                    this.product = response.data.data;
                    
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateProduct() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.put(`/api/products/${this.$route.params.id}`, this.product)
                    .then(response => {
                        this.$router.push({name: 'products'});
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
