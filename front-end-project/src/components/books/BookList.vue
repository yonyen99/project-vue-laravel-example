<template>
    <div class="container">
      <div class="mb-3">
        <router-link to="/add" class="btn btn-primary">Add Book</router-link>
      </div>
  
      <ul class="list-group">
        <li class="list-group-item" v-for="book in books" :key="book.id">
          <h3>{{ book.title }}</h3>
          <p>{{ book.description }}</p>
          <div>
            <button @click="deleteBook(book.id)" class="btn btn-danger">Delete</button>
            <router-link :to="`/edit/${book.id}`" class="btn btn-primary">Edit</router-link>
          </div>
        </li>
      </ul>
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
</style>
  