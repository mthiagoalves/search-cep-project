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
                    <p v-if="cepDetails">Logradouro: {{ cepDetails.logradouro ? `${cepDetails.logradouro}` : `${cepDetails.public_place}` }}</p>
                    <p v-if="cepDetails">Complemento: {{ cepDetails.complemento ? `${cepDetails.complemento}` : (cepDetails.complement ? `${cepDetails.complement}` : '') }}</p>
                    <p v-if="cepDetails">Bairro: {{ cepDetails.bairro ? `${cepDetails.bairro}` : `${cepDetails.burgh}` }}</p>
                    <p v-if="cepDetails">Localidade: {{ cepDetails.localidade ? `${cepDetails.localidade}` : `${cepDetails.locality}` }}</p>
                    <p v-if="cepDetails">UF: {{ cepDetails.uf ? `${cepDetails.uf}` : `${cepDetails.state_acronym}` }}</p>
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
