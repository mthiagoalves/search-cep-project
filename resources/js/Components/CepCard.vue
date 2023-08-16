<template>
    <div class="col-6 col-md-4 mb-1 p-2">
        <div class="card">
            <div class="card-body p-2">
                <h5 class="card-title">CEP: {{ cep.cep }}</h5>
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
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

@media(max-width: 756px){
    .card-body{
        min-height: 260px;
    }
}
</style>
