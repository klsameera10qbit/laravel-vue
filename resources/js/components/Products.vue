<template>
    <div>
        <div class="d-flex">
            <h4 class="p-2 flex-grow-1 bd-highlight text-center">
                All products
            </h4>
            <button
                type="button"
                class="btn btn-primary"
                @click="this.$router.push('/products/add')"
            >
                Add product
            </button>
        </div>

        <br />
        <div class="table-responsive">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id">
                        <td>{{ product.id }}</td>
                        <td>{{ product.title }}</td>
                        <td>{{ product.price }}</td>
                        <td>{{ dateTime(product.created_at) }}</td>
                        <td>{{ dateTime(product.updated_at) }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <router-link
                                    :to="{
                                        name: 'editProduct',
                                        params: { id: product.id },
                                    }"
                                    class="btn btn-primary"
                                    >Edit
                                </router-link>
                                <button
                                    class="btn btn-danger"
                                    @click="deleteProduct(product.id)"
                                >
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import moment from 'moment';

export default {

    data() {
        return {
            products: [],
        };
    },
    created() {
        this.$axios.get("/sanctum/csrf-cookie").then((response) => {
            this.$axios
                .get("/api/products")
                .then((response) => {
                    this.products = response.data.data;
                    console.log(this.products);
                })
                .catch(function (error) {
                    console.error(error);
                });
        });
    },
    methods: {
        deleteProduct(id) {
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios
                    .delete(`/api/products/${id}`)
                    .then((response) => {
                        let i = this.products
                            .map((item) => item.id)
                            .indexOf(id); // find index of your object
                        this.products.splice(i, 1);
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

    dateTime(value) {
      return moment(value).format('YYYY-MM-DD');
    },


// const data = await this.$axios.$get('/api/admin/big-questions')
//         this.questions = data.data.map((n) => {
//           n.updated_at = moment(data.data.updated_at).utc().format('YYYY/MM/DD');
//           return n;
//         });
};
</script>
