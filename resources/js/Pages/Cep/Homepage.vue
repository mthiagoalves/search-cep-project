<template>
    <div class="container-fluid p-0 text-center">
      <Navbar :appName="appName" />
      <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-6 p-0 text-start d-none d-sm-block">
                <a class="btn btn-info" @click="openCreateModal">Cadastrar Novo Endereço</a>
            </div>
            <div class="col-12 col-sm-6 p-0 px-2 mb-3 d-block d-sm-none">
                <a class="btn btn-info w-100" @click="openCreateModal">Cadastrar Novo Endereço</a>
            </div>
            <div class="col-6 p-0 text-end d-none d-sm-block">
                <input type="text" placeholder="Buscar CEP">
            </div>
            <div class="col-12 col-sm-6 p-0 px-2 mb-3 d-block d-sm-none">
                <input type="text" placeholder="Buscar CEP" class="form-control">
            </div>
        </div>
        <h1 class="mb-3">Lista de CEPs</h1>
        <div class="row p-2 p-sm-0">
          <CepCard v-for="cep in ceps" :key="cep.id" :cep="cep" class="col-6 col-md-4 mb-4"/>
        </div>
      </div>
      <CepCreateModal :cep="cep" :on-create="onCreate" />

      <Footer :footerText="footerText" />
    </div>
  </template>

  <script>
  import Navbar from "@/Components/Navbar.vue";
  import Footer from "@/Components/Footer.vue";
  import CepCard from "@/Components/CepCard.vue";
  import CepCreateModal from "@/Components/CepCreateModal.vue";

  export default {
    components: {
      Navbar,
      Footer,
      CepCard,
      CepCreateModal
    },
    data() {
      return {
        appName: "Buscar CEP",
        footerText: "© 2023, Thiago Alves - Teste feito para empresa."
      };
    },
    props: {
      ceps: Array
    },
    methods: {
        openCreateModal() {
            $("#createCepModal").modal("show");
        },
        onCreate(cep) {
            console.log("Criando o CEP:", cep);
        }
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
