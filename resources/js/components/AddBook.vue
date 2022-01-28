<template>
    <div>
        <h4 class="text-center">Add product</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addproduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div><br>
                    <div class="form-group">
                        <label>Author</label>
                        <input type="text" class="form-control" v-model="product.author">
                    </div><br>
                    <button type="submit" class="btn btn-primary">Add product</button>
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
    methods: {
        addproduct() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/products', this.product)
                    .then(response => {
                        this.$router.push({name: 'products'})
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
