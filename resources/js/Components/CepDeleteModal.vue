<template>
    <div class="modal fade" tabindex="-1" role="dialog" :id="'deleteCepModal-' + cep.id">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Exclusão</h5>
                    <button type="button" class="close" aria-label="Fechar" @click="hideDeleteModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir o CEP: {{ cep.cep }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="hideDeleteModal">Cancelar</button>
                    <button type="button" class="btn btn-danger" @click="deleteCep">Excluir</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        cep: Object,
        onDelete: Function
    },
    methods: {
        hideDeleteModal() {
            $(`#deleteCepModal-${this.cep.id}`).modal("hide");
        },
        async deleteCep() {
            this.hideDeleteModal();
            try {
                const response = await fetch(`/deleteAddress/${this.cep.cep}`, {
                    method: 'DELETE'
                });

                const data = await response.json();

                if (response.ok) {
                    Swal.fire(
                        'Sucesso!',
                        'Endereço excluído com sucesso.',
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
                    text: 'Não conseguimos excluir o endereço: ' + error,
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
.btn-danger {
    background-color: #dc3545;
}

.btn-danger:hover {
    background-color: #b02a37;
}

.btn-secondary {
    background-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #5c636a;
}
</style>
