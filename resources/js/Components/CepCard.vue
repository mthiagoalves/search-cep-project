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
            <div class="col-4 p-0">
                <a href="" class="btn-update">Atualizar</a>
            </div>
            <div class="col-4 p-0">
                <a class="btn-delete" data-toggle="modal" data-target="#deleteCepModal">Deletar</a>
            </div>
        </div>
        <CepDeleteModal :cep="cep" :on-delete="onDelete" />
    </div>
</template>

<script>
import CepDeleteModal from "@/Components/CepDeleteModal.vue";

export default {
    props: {
        cep: Object
    },
    components: {
        CepDeleteModal
    },
    methods: {
        onDelete(cep) {
            console.log("Deletando o CEP:", cep);
        }
    }
};
</script>

<style scoped>
.btn-update {
    background-color: #196a877a;
    border: .5px solid #47b4dc;
    padding: 11px;
    cursor: pointer;
    transition: .5s ease-in-out;
}

.btn-update:hover {
    background-color: #47b4dc;
}

.btn-delete {
    background-color: #cd5d7f7a;
    border: .5px solid #fd86aa;
    padding: 11px;
    cursor: pointer;
    transition: .5s ease-in-out;
}

.btn-delete:hover {
    background-color: #fd86aa;
}

.card {
    margin-bottom: 1rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>
