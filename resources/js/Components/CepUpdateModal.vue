<template>
    <div class="modal fade" tabindex="-1" role="dialog" :id="'updateCepModal-' + cep.id">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atualizar CEP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" @click="hideUpdateModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updateCep">
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" class="form-control" id="cep" v-model="updatedCep.cep">
                        </div>
                        <div class="form-group">
                            <label for="publicPlace">Logradouro</label>
                            <input type="text" class="form-control" id="publicPlace" v-model="updatedCep.public_place">
                        </div>
                        <div class="form-group">
                            <label for="complement">Complemento</label>
                            <input type="text" class="form-control" id="complement" v-model="updatedCep.complement">
                        </div>
                        <div class="form-group">
                            <label for="burgh">Bairro</label>
                            <input type="text" class="form-control" id="burgh" v-model="updatedCep.burgh">
                        </div>
                        <div class="form-group">
                            <label for="locality">Localidade</label>
                            <input type="text" class="form-control" id="locality" v-model="updatedCep.locality">
                        </div>
                        <div class="form-group">
                            <label for="stateAcronym">UF</label>
                            <input type="text" class="form-control" id="stateAcronym" v-model="updatedCep.state_acronym">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                @click="hideUpdateModal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        cep: Object,
        onUpdate: Function
    },
    data() {
        return {
            updatedCep: {
                id: this.cep.id,
                cep: this.cep.cep,
                public_place: this.cep.public_place,
                complement: this.cep.complement,
                burgh: this.cep.burgh,
                locality: this.cep.locality,
                state_acronym: this.cep.state_acronym
            }
        };
    },
    methods: {
        hideUpdateModal() {
            $(`#updateCepModal-${this.cep.id}`).modal("hide");
        },
        async updateCep() {
            this.hideUpdateModal();
            try {
                const response = await fetch(`/updateAddress/${this.cep.cep}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(this.updatedCep)
                });

                const data = await response.json();

                if (response.ok) {
                    Swal.fire(
                        'Sucesso!',
                        'Endereço atualizado com sucesso.',
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
                    text: 'Não conseguimos atualizar o endereço: ' + error,
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }
        }
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
