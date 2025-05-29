<template>
    <div
        class="modal fade"
        ref="staticModal"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel" v-if="$slots.header">
                        <slot name="header" />
                    </h1>
                    <button type="button" class="btn-close" @click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <slot />
                </div>
                <div class="modal-footer" v-if="$slots.footer">
                    <slot name="footer" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {ref, watch, onMounted, computed} from 'vue'
import { Modal } from 'bootstrap'

export default {
    name: 'Modal',
    props: {
        modelValue: Boolean,
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
        const staticModal = ref(null)
        let modalInstance = null

        const openModal = () => {
            if (!modalInstance) {
                modalInstance = new Modal(staticModal.value, {
                    backdrop: true,
                    keyboard: true,
                })
                staticModal.value.addEventListener('hidden.bs.modal', () => {
                    emit('update:modelValue', false)
                })
            }
            modalInstance.show()
        }

        const closeModal = () => {
            if (modalInstance) {
                modalInstance.hide()
            }
        }

        watch(
            () => props.modelValue,
            (visible) => {
                if (visible) {
                    openModal()
                } else {
                    closeModal()
                }
            }
        )

        onMounted(() => {
            if (props.modelValue) {
                openModal()
            }
        })

        return {
            staticModal,
            openModal,
            closeModal,
        }
    },

}
</script>
