<template>
    <Navbar :appName="appName" />
    <div class="container-fluid p-0 text-center header-padding">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-6 p-0 text-start d-none d-sm-block">
                    <a class="btn btn-info" @click="openCreateModal">Cadastrar Novo Endereço</a>
                </div>
                <div class="col-12 col-sm-6 p-0 px-2 mb-3 d-block d-sm-none">
                    <a class="btn btn-info w-100" @click="openCreateModal">Cadastrar Novo Endereço</a>
                </div>
                <div class="col-6 p-0 text-end d-none d-sm-block">
                    <input type="text" placeholder="Buscar CEP" v-model="searchedCep">
                    <button class="btn btn-primary" @click="findCep">Buscar</button>
                </div>
                <div class="col-12 col-sm-6 p-0 px-2 mb-3 d-block d-sm-none">
                    <input type="text" placeholder="Buscar CEP" class="form-control" v-model="searchedCep">
                    <button class="btn btn-primary" @click="findCep">Buscar</button>
                </div>
            </div>
            <h1 class="mb-3">Lista de CEPs</h1>
            <div class="row p-2 p-sm-0">
                <CepCard v-for="cep in ceps" :key="cep.id" :cep="cep" :on-create="updateCeps" class="col-6 col-md-4 mb-1" />
            </div>
        </div>
        <CepCreateModal :cep="cep" :on-create="onCreate" />
        <div class="modal fade" tabindex="-1" role="dialog" id="searchedCepModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalhes do CEP</h5>
                        <button type="button" class="close" aria-label="Fechar" @click="closeSearchedModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p v-if="searchedCep">CEP: {{ cep }}</p>
                        <p v-if="searchedCep">Logradouro: {{ public_place }}</p>
                        <!-- ...outros campos... -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Footer :footerText="footerText" />
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
            footerText: "© 2023, Thiago Alves - Teste feito para empresa.",
            searchedCep: "",
            searchedCepDetails: null,
            searchedModalVisible: false
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
        },
        async updateCeps() {

            try {
                const response = await fetch('/getAllCeps');

                if (response.ok) {
                    const data = await response.json();
                    this.ceps = data;
                } else {
                    console.error('Erro ao obter lista de CEPs');
                }
            } catch (error) {
                console.error('Erro na requisição:', error);
            }
        },
        async findCep() {
            try {
                const response = await fetch(`/${this.searchedCep}`);
                const data = await response.json();

                if (response.ok) {
                    this.searchedCepDetails = data;
                    $("#searchedCepModal").modal("show"); // Exibe o modal
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro ao buscar CEP',
                        text: data.message,
                    });
                }
            } catch (error) {
                console.error('Erro na requisição:', error);
            }
        },

        closeSearchedModal() {
            this.searchedCepDetails = null; // Limpa os detalhes do CEP
            $("#searchedCepModal").modal("hide"); // Fecha o modal
        }
    }
};
</script>

<style scoped>
.btn-new {
    background-color: #f4f4f4;
    border: .5px solid #198754;
    padding: 11px;
    transition: .5s ease-in-out;
}

.btn-new:hover {
    background-color: #c2c6c6;
}

.header-padding {
    padding-bottom: 70px !important;
}
</style>
