<template>
    <Navbar :appName="appName" />
    <div class="container-fluid p-0 text-center header-padding">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-6 p-0 text-start d-none d-sm-block">
                    <a class="btn btn-info" @click="openCreateModal"
                        >Cadastrar Novo Endereço</a
                    >
                </div>
                <div class="col-12 col-sm-6 p-0 px-2 mb-3 d-block d-sm-none">
                    <a class="btn btn-info w-100" @click="openCreateModal"
                        >Cadastrar Novo Endereço</a
                    >
                </div>
                <div class="col-4 p-0 text-end d-none d-sm-block search">
                    <i class="fa fa-search"></i>
                    <input
                        type="text"
                        placeholder="Buscar CEP"
                        v-model="searchedCep"
                        @keyup.enter="findCep"
                        class="form-control"
                    />
                    <button class="btn btn-primary" @click="findCep">
                        Buscar
                    </button>
                </div>
                <div
                    class="col-12 col-sm-6 p-0 px-2 mb-3 d-block d-sm-none search"
                >
                    <i class="fa fa-search"></i>
                    <input
                        type="text"
                        placeholder="Buscar CEP"
                        v-model="searchedCep"
                        @keyup.enter="findCep"
                        class="form-control"
                    />
                    <button class="btn btn-primary" @click="findCep">
                        Buscar
                    </button>
                </div>
            </div>
            <h1 class="mb-3">Lista de CEPs</h1>
            <div class="row p-2 p-sm-0">
                <CepCard
                    v-for="cep in ceps"
                    :key="cep.id"
                    :cep="cep"
                    v-if="ceps.length > 0"
                    :on-create="updateCeps"
                />
                <div v-else class="col-12">
                    <p>Nenhum CEP cadastrado</p>
                </div>
            </div>
        </div>
        <CepCreateModal :cep="cep" :on-create="onCreate" />
        <CepSearchedModal
            :cep-details="searchedCepDetails"
            @hide-modal="HideSearchedModal"
        />
    </div>
    <Footer :footerText="footerText" />
</template>

<script>
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
import CepCard from "@/Components/CepCard.vue";
import CepCreateModal from "@/Components/CepCreateModal.vue";
import CepSearchedModal from "@/Components/CepSearchedModal.vue";

export default {
    components: {
        Navbar,
        Footer,
        CepCard,
        CepCreateModal,
        CepSearchedModal,
    },
    data() {
        return {
            appName: "Buscar CEP",
            footerText: "© 2023, Thiago Alves - Teste feito para empresa.",
            searchedCep: "",
            searchedCepDetails: null,
            searchedModalVisible: false,
        };
    },
    props: {
        ceps: Array,
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
                const response = await fetch("/getAllCeps");

                if (response.ok) {
                    const data = await response.json();
                    this.ceps = data;
                } else {
                    console.error("Erro ao obter lista de CEPs");
                }
            } catch (error) {
                console.error("Erro na requisição:", error);
            }
        },
        async findCep() {
            try {
                const response = await fetch(`/${this.searchedCep}`);
                const data = await response.json();

                if (response.ok) {
                    console.log(data);
                    if (Array.isArray(data) && data.length === 1) {
                        this.searchedCepDetails = data[0];
                    } else {
                        this.searchedCepDetails = data;
                    }
                    $("#searchedCepModal").modal("show");
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Erro ao buscar CEP",
                        text: data.message,
                    });
                }
            } catch (error) {
                console.error("Erro na requisição:", error);
            }
        },
        HideSearchedModal() {
            this.searchedCepDetails = null;
            $("#searchedCepModal").modal("hide");
        },
    },
};
</script>

<style scoped>
.btn-new {
    background-color: #f4f4f4;
    border: 0.5px solid #198754;
    padding: 11px;
    transition: 0.5s ease-in-out;
}

.btn-new:hover {
    background-color: #c2c6c6;
}

.header-padding {
    padding-bottom: 70px !important;
}
.search {
    position: relative;
}

.search .fa-search {
    position: absolute;
    top: 12px;
    left: 10px;
}

.search input {
    text-indent: 25px;
    border: 2px solid #d6d4d4;
}

.search button {
    position: absolute;
    right: 3px;
    top: 3px;
}

@media (max-width: 756px) {
    .search .fa-search {
        position: absolute;
        top: 12px;
        left:20px;
    }
    .search button {
        position: absolute;
        right: 10px;
        top: 3px;
    }
}
</style>
