<template>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <slot/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    name: 'Modal',

    model: {
        prop: 'modelValue',
        event: 'update:modelValue',
    },

    props: {
        modelValue: {
            type: [Boolean, Object],
            default: false,
        },
    }
}
</script>

<style>
.cd-modal{
    position: fixed;
    z-index: 100;
}
</style>

