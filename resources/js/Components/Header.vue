<template>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{ title }}</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">    </head>
    <body>
      <Navbar :appName="appName" />
      <slot></slot>
      <Footer :footerText="footerText" />
    </body>
  </template>

  <script>
  import Navbar from '@/Components/Navbar.vue';
  import Footer from '@/Components/Footer.vue';

  export default {
    components: {
      Navbar,
      Footer
    },
    props: {
      title: String,
      appName: String,
      footerText: String
    }
  };
  </script>
