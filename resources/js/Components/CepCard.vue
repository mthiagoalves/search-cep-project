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
                <a class="btn btn-success" @click="openUpdateModal(cep.id)">Atualizar</a>
            </div>
            <div class="col-12 col-sm-4 p-0">
                <a class="btn btn-danger" @click="openDeleteModal(cep.id)">Deletar</a>
            </div>
        </div>
        <CepUpdateModal :cep="cep" :cep-id="cep.id" :on-update="onUpdate" />
        <CepDeleteModal :cep="cep" :cep-id="cep.id" :on-delete="onDelete" />
    </div>
</template>

<script>
import CepDeleteModal from "@/Components/CepDeleteModal.vue";
import CepUpdateModal from "@/Components/CepUpdateModal.vue";


export default {
    props: {
        cep: Object,
        onCreate: Function
    },
    components: {
        CepDeleteModal,
        CepUpdateModal
    },
    methods: {
        openUpdateModal(cepId) {
            $("#updateCepModal-" + cepId).modal("show");
        },
        onUpdate(cep) {
            console.log("Atualizando o CEP:", cep);
        },
        openDeleteModal(cepId) {
            $("#deleteCepModal-" + cepId).modal("show");
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
