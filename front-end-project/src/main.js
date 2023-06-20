import { createApp } from "vue";
import App from "./App.vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap/dist/js/bootstrap.js";
import { createRouter, createWebHistory } from "vue-router";
import BookList from "./components/books/BookList.vue";
import AddBook from "./components/books/AddBook.vue";
import EditBook from "./components/books/EditBook.vue";

const routes = [
  { path: "/", component: BookList },
  { path: "/add", component: AddBook },
  { path: "/edit/:id", component: EditBook },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

const app = createApp(App);
app.use(router);
app.mount("#app");
