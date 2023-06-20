<template>
    <div class="container">
      <form @submit.prevent="updateBook" class="p-3">
        <div class="mb-3">
          <label class="form-label">Title</label>
          <input type="text" v-model="book.title" class="form-control" />
        </div>
  
        <div class="mb-3">
          <label class="form-label">Description</label>
          <input type="text" v-model="book.description" class="form-control" />
        </div>
  
        <button type="submit" class="btn btn-primary">Update Book</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    data() {
      return {
        book: {
          title: "",
          description: "",
        },
      };
    },
    methods: {
      fetchBook() {
        const bookId = this.$route.params.id;
        axios.get(`http://127.0.0.1:8000/api/books/${bookId}`)
          .then((response) => {
            this.book = response.data.data;
          })
          .catch((error) => {
            console.error(error);
          });
      },
      updateBook() {
        const bookId = this.$route.params.id;
        axios.put(`http://127.0.0.1:8000/api/books/${bookId}`, this.book)
          .then(() => {
            this.$router.push("/");
          })
          .catch((error) => {
            console.error(error);
          });
      },
    },
    mounted() {
      this.fetchBook();
    },
  };
  </script>
  
  <style scoped>
  
  </style>
  