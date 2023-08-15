<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="deleteCepModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Exclusão</h5>
                    <button type="button" class="close" aria-label="Fechar" @click="hideModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir o CEP: {{ cep.cep }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="hideModal">Cancelar</button>
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
        deleteCep() {
            this.onDelete(this.cep);
            $("#deleteCepModal").modal("hide");
        },
        hideModal() {
            $("#deleteCepModal").modal("hide");
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
}</style>
