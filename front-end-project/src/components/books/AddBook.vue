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

      <div class="mb-3">
        <label class="form-label">Image</label>
        <input type="file" @change="onFileChange" class="form-control" />
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
      image: null, // Store the selected image file
    };
  },
  methods: {
    addBook() {
      const newBook = {
        title: this.title,
        description: this.description,
        image: this.image, // Pass the image file to the API
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
    onFileChange(event) {
      // Retrieve the selected image file
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = () => {
          // Convert the image to base64 encoding
          const base64Image = reader.result;
          this.image = base64Image; // Store the base64 encoded image
        };
        reader.readAsDataURL(file);
      }
    },
  },
};
</script>

<style scoped>
</style>
