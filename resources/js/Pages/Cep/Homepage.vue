<template>
    <div>
      <Navbar :appName="appName" />
      <h1>Lista de CEPs</h1>
      <ul>
        <li v-for="cep in ceps" :key="cep.id">{{ cep.cep }}</li>
      </ul>
      <Footer :footerText="footerText" />
    </div>
  </template>

  <script>
  import Navbar from '@/components/Navbar.vue';
  import Footer from '@/components/Footer.vue';

  export default {
    components: {
      Navbar,
      Footer
    },
    data() {
      return {
        appName: 'Buscar CEP',
        ceps: [],
        footerText: '© 2023, Thiago Alves - Teste feito para empresa Creditares'
      };
    }
  };
  </script>
