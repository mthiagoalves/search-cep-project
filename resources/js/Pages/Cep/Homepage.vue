<template>
    <div class="container-fluid p-0 text-center">
      <Navbar :appName="appName" />
      <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-6 p-0 text-start">
                <a href="#" class="btn-new">Cadastrar Novo Endereço</a>
            </div>
            <div class="col-6 p-0 text-end">
                <input type="text" placeholder="Buscar CEP">
            </div>
        </div>
        <h1 class="mb-3">Lista de CEPs</h1>
        <div class="row">
          <CepCard v-for="cep in ceps" :key="cep.id" :cep="cep" class="col-6 col-md-4 mb-4"/>
        </div>
      </div>
      <Footer :footerText="footerText" />
    </div>
  </template>

  <script>
  import Navbar from "@/Components/Navbar.vue";
  import Footer from "@/Components/Footer.vue";
  import CepCard from "@/Components/CepCard.vue";

  export default {
    components: {
      Navbar,
      Footer,
      CepCard
    },
    data() {
      return {
        appName: "Buscar CEP",
        footerText: "© 2023, Thiago Alves - Teste feito para empresa."
      };
    },
    props: {
      ceps: Array
    }
  };
  </script>

  <style scoped>
    .btn-new{
        background-color: #f4f4f4;
        border: .5px solid #198754;
        padding: 11px;
        transition: .5s ease-in-out;
    }

    .btn-new:hover{
        background-color: #c2c6c6;
    }

  @media (min-width: 1280px) {
    .container {
      max-width: 1100px;
    }
  }
  </style>
