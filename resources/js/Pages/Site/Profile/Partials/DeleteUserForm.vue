<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section class="tw-space-y-6">
        <header>
            <h2 class="tw-text-lg tw-font-medium tw-text-gray-900">
                Deletar conta
            </h2>

            <p class="tw-mt-1 tw-text-sm tw-text-gray-600">
                Uma vez que sua conta for excluída, todos os seus recursos e dados serão permanentemente apagados. Antes de excluir sua conta, faça o download de qualquer dado ou informação que deseja manter.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Deletar conta</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="tw-p-6">
                <h2
                    class="tw-text-lg tw-font-medium tw-text-gray-900"
                >
                    Tem certeza de que deseja excluir sua conta?
                </h2>

                <p class="tw-mt-1 tw-text-sm tw-text-gray-600">
                    Uma vez que sua conta for excluída, todos os seus recursos e dados serão permanentemente apagados. Por favor, insira sua senha para confirmar que deseja excluir sua conta de forma permanente.
                </p>

                <div class="tw-mt-6">
                    <InputLabel
                        for="password"
                        value="Senha"
                        class="tw-sr-only"
                    />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="tw-mt-1 tw-block tw-w-3/4"
                        placeholder="Senha"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="tw-mt-2" />
                </div>

                <div class="tw-mt-6 tw-flex tw-justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancelar
                    </SecondaryButton>

                    <DangerButton
                        class="tw-ms-3"
                        :class="{ 'tw-opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Deletar Conta
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
