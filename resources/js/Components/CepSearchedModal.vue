<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="searchedCepModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalhes do CEP</h5>
                    <button type="button" class="close" aria-label="Fechar" @click="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p v-if="cepDetails">CEP: {{ cepDetails.cep }}</p>
                    <p v-if="cepDetails">Logradouro: {{ cepDetails.logradouro }}</p>
                    <p v-if="cepDetails">Complemento: {{ cepDetails.complemento }}</p>
                    <p v-if="cepDetails">Bairro: {{ cepDetails.bairro }}</p>
                    <p v-if="cepDetails">Localidade: {{ cepDetails.localidade }}</p>
                    <p v-if="cepDetails">UF: {{ cepDetails.uf }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        cepDetails: Object
    },
    methods: {
        closeModal() {
            this.$emit('close-modal');
        }
    }
};
</script>
