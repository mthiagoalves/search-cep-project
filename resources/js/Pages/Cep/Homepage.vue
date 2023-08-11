<template>
    <div class="container-fluid p-0 text-center">
        <Navbar :appName="appName" />
        <div class="container">
            <h1>Lista de CEPs</h1>
            <div class="row">
                <div v-for="cep in ceps" :key="cep.id" class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ cep.cep }}</h5>
                            <p class="card-text">
                                Logradouro: {{ cep.public_place }}
                            </p>
                            <p class="card-text">
                                Complemento: {{ cep.complement }}
                            </p>
                            <p class="card-text">Bairro: {{ cep.burgh }}</p>
                            <p class="card-text">Localidade: {{ cep.locality }}</p>
                            <p class="card-text">UF: {{ cep.state_acronym }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <Footer :footerText="footerText" />
    </div>
</template>

<script>
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";

export default {
  components: {
    Navbar,
    Footer
  },
  data() {
    return {
      appName: 'Buscar CEP',
      footerText: '© 2023, Thiago Alves - Teste feito para empresa Creditares',
    };
  },
  props: {
    ceps: Array
  }
};
</script>

<style scoped>
@media (min-width: 1280px){
    .container {
        max-width: 1100px;
    }
}
</style>
