<template>
    <div
        v-if="visible"
        :class="['alert', `alert-${type}`, 'alert-dismissible', 'fade', 'show', 'position-fixed', 'top-0', 'start-50', 'translate-middle-x', 'mt-3', 'w-auto', 'shadow']"
        style="z-index: 9999;"
        role="alert"
    >
        {{ message }}
        <button type="button" class="btn-close" @click="visible = false" aria-label="Fechar"></button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            visible: false,
            message: '',
            type: 'success'
        };
    },
    created() {
        this.$root.$on('alert:show', this.showAlert);
    },
    beforeUnmount() {
        this.$root.$off('alert:show', this.showAlert);
    },
    methods: {
        showAlert({ message, type = 'success', duration = 3000 }) {
            this.message = message;
            this.type = type;
            this.visible = true;

            setTimeout(() => {
                this.visible = false;
            }, duration);
        }
    }
};
</script>
