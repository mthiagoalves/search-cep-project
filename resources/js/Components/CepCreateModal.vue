    <template>
        <div class="modal fade" tabindex="-1" role="dialog" id="createCepModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adicionar Novo CEP</h5>
                        <button type="button" class="close" aria-label="Fechar" @click.prevent="hideModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="createCep">
                            <div class="form-group">
                                <label for="newCep">CEP</label>
                                <input type="text" class="form-control" id="newCep" required v-model="newCep.cep">
                            </div>
                            <div class="form-group">
                                <label for="newPublicPlace">Logradouro</label>
                                <input type="text" class="form-control" id="newPublicPlace" required
                                    v-model="newCep.public_place">
                            </div>
                            <div class="form-group">
                                <label for="newComplement">Complemento</label>
                                <input type="text" class="form-control" id="newComplement" v-model="newCep.complement">
                            </div>
                            <div class="form-group">
                                <label for="newBurgh">Bairro</label>
                                <input type="text" class="form-control" id="newBurgh" required v-model="newCep.burgh">
                            </div>
                            <div class="form-group">
                                <label for="newLocality">Localidade</label>
                                <input type="text" class="form-control" id="newLocality" required v-model="newCep.locality">
                            </div>
                            <div class="form-group">
                                <label for="newStateAcronym">UF</label>
                                <input type="text" class="form-control" id="newStateAcronym" required
                                    v-model="newCep.state_acronym">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click.prevent="hideModal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" @click.prevent="createCep">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <script>
    export default {
        data() {
            return {
                newCep: {
                    cep: "",
                    public_place: "",
                    complement: "",
                    burgh: "",
                    locality: "",
                    state_acronym: ""
                }
            };
        },
        methods: {
            hideModal() {
                $("#createCepModal").modal("hide");
            },
            async createCep() {
                this.hideModal();
                try {
                    const response = await fetch('/newAddress', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.newCep)
                    });

                    const data = await response.json();

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
