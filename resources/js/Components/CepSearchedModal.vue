<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="searchedCepModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalhes do CEP</h5>
                    <button type="button" class="close" aria-label="Fechar" @click="hideModal">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="hideModal">Fechar</button>
                    <button class="btn btn-primary" @click="saveToDatabase" v-if="cepDetails && cepDetails.source === 'api'">Salvar</button>
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
        hideModal() {
            this.$emit('hide-modal');
        },
        async saveToDatabase() {
            this.$emit('hide-modal');
            try {
                const cleanedCep = this.cepDetails.cep.replace('-', '');
                const data = {
                    cep: cleanedCep,
                    public_place: this.cepDetails.logradouro,
                    complement: this.cepDetails.complemento,
                    burgh: this.cepDetails.bairro,
                    locality: this.cepDetails.localidade,
                    state_acronym: this.cepDetails.uf
                };
                const response = await fetch('/newAddress', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });

                if (response.ok) {

                    Swal.fire(
                        'Sucesso!',
                        'Endereço cadastrado com sucesso.',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Não conseguimos cadastrar o endereço: ' + error,
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }
        },
    }
};
</script>

<style scoped>
.btn-primary {
    background-color: #0d6efd;
}

.btn-primary:hover {
    background-color: #0b5ed7;
}

.btn-secondary {
    background-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #5c636a;
}
</style>
