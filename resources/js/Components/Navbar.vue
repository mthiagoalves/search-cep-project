<template>
    <nav class="navbar">
      <div class="navbar-brand">
        <a class="navbar-item" href="#">
          {{ appName }}
        </a>
      </div>
    </nav>
  </template>
  
  <script>
  export default {
    props: {
      appName: String
    }
  };
  </script>
  
  <style scoped>
  .navbar {
    background-color: #333;
    color: #fff;
    padding: 1rem;
  }
  </style>
  