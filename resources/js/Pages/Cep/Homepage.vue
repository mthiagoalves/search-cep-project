<template>
    <div>
      <Header :title="pageTitle" :appName="appName" :footerText="footerText">
        <div class="container mt-5">
          <h1 class="mb-4">Lista de CEPs</h1>
          <div class="row">
            <div v-for="cep in ceps" :key="cep.id" class="col-md-4 mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{ cep.cep }}</h5>
                  <p class="card-text">Logradouro: {{ cep.public_place }}</p>
                  <p class="card-text">Bairro: {{ cep.burgh }}</p>
                  <p class="card-text">Localidade: {{ cep.locality }}</p>
                  <p class="card-text">UF: {{ cep.state_acronym }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </Header>
    </div>
  </template>

  <script>
  import Header from '@/Components/Header.vue';

  export default {
    components: {
      Header
    },
    data() {
      return {
        pageTitle: 'Minha Página Vue',
        appName: 'Buscar CEP',
        footerText: '© 2023, Thiago Alves - Teste feito para empresa Creditares',
        ceps: []
      };
    }
  };
  </script>
