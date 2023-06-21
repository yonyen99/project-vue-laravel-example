<template>
  <div class="container">
    <form @submit.prevent="addBook" class="p-3">
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" v-model="title" class="form-control" />
      </div>

      <div class="mb-3">
        <label class="form-label">Description</label>
        <input type="text" v-model="description" class="form-control" />
      </div>

      <button type="submit" class="btn btn-primary">Add Book</button>
    </form>
  </div>
</template>
  
  <script>
import http from '@/http-common.js';


export default {
  data() {
    return {
      title: "",
      description: "",
    };
  },
  methods: {
    addBook() {
      const newBook = {
        title: this.title,
        description: this.description,
      };

      http
        .post("/api/books", newBook)
        .then(() => {
          this.$router.push("/");
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>
  
  <style scoped>
</style>
  