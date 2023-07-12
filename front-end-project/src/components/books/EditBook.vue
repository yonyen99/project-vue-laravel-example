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
      <div class="col-4">
        <input type="file" @change="onFileChange" class="form-control" />
      </div>
      <button type="submit" class="btn btn-primary">Update Book</button>
    </form>
  </div>
</template>
  
  <script>
import http from "@/http-common.js";

export default {
  data() {
    return {
      book: {
        title: "",
        description: "",
        image: null,
      },
    };
  },
  methods: {
    fetchBook() {
      const bookId = this.$route.params.id;
      http
        .get(`/api/books/${bookId}`)
        .then((response) => {
          this.book = response.data.data;
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
    updateBook() {
      
      const bookId = this.$route.params.id;
      const newBook = {
        title: this.title,
        description: this.description,
        image: this.image, // Pass the image file to the API
      };
      http
        .put(`/api/books/${bookId}`, newBook)
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
.image-thumbnail {
  max-width: 100%;
  height: auto;
}
</style>