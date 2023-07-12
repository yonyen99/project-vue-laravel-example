<template>
  <div class="container">
    <div class="mb-3">
      <router-link to="/add" class="btn btn-primary">Add Book</router-link>
    </div>

    <div class="card" v-for="book in books" :key="book.id">
      <div class="row g-0">
        <div class="col-4 col-md-2">
          <img :src="book.image.file_url" alt="Book Image" class="card-img-start image-thumbnail" />
        </div>
        <div class="col-8 col-md-10">
          <div class="card-body">
            <h3 class="card-title">{{ book.title }}</h3>
            <p class="card-text">{{ book.description }}</p>
            <div>
              <button @click="deleteBook(book.id)" class="btn btn-danger">Delete</button>
              <router-link :to="`/edit/${book.id}`" class="btn btn-primary">Edit</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import http from '@/http-common.js';

export default {
  data() {
    return {
      books: [],
    };
  },
  methods: {
    fetchData() {
      http
        .get("/api/books")
        .then((response) => {
          this.books = response.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    deleteBook(id) {
      http
        .delete(`/api/books/${id}`)
        .then(() => {
          this.fetchData();
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
  mounted() {
    this.fetchData();
  },
};
</script>

<style scoped>
.image-thumbnail {
  max-width: 100%;
  height: auto;
}
</style>
