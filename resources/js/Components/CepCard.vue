<template>
    <div class="card p-3">
        <div class="card-body p-0">
            <h5 class="card-title">{{ cep.cep }}</h5>
            <p class="card-text">Logradouro: {{ cep.public_place }}</p>
            <p class="card-text">Complemento: {{ cep.complement }}</p>
            <p class="card-text">Bairro: {{ cep.burgh }}</p>
            <p class="card-text">Localidade: {{ cep.locality }}</p>
            <p class="card-text">UF: {{ cep.state_acronym }}</p>
        </div>
        <div class="row justify-content-between my-3">
            <div class="col-12 col-sm-4 mb-2 m-sm-0 p-0">
                <a class="btn btn-success" @click="openUpdateModal">Atualizar</a>
            </div>
            <div class="col-12 col-sm-4 p-0">
                <a class="btn btn-danger" @click="openDeleteModal">Deletar</a>
            </div>
        </div>
        <CepUpdateModal :cep="cep" :on-update="onUpdate" />
        <CepDeleteModal :cep="cep" :on-delete="onDelete" />
    </div>
</template>

<script>
import CepDeleteModal from "@/Components/CepDeleteModal.vue";
import CepUpdateModal from "@/Components/CepUpdateModal.vue";


export default {
    props: {
        cep: Object
    },
    components: {
        CepDeleteModal,
        CepUpdateModal
    },
    methods: {
        openUpdateModal() {
            $("#updateCepModal").modal("show");
        },
        onUpdate(cep) {
            console.log("Atualizando o CEP:", cep);
        },
        openDeleteModal() {
            $("#deleteCepModal").modal("show");
        },
        onDelete(cep) {
            console.log("Deletando o CEP:", cep);
        }
    }
};
</script>

<style scoped>

.card {
    margin-bottom: 1rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>
