<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head} from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
<!--    <div class="tw-py-12">-->
        <div class="tw-mx-auto tw-space-y-6 mb-4">
            <div
                class="tw-bg-white tw-p-4 tw-shadow sm:tw-rounded-lg sm:tw-p-8"
            >
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="tw-max-w-xl"
                />
            </div>

            <div
                class="tw-bg-white tw-p-4 tw-shadow sm:tw-rounded-lg sm:tw-p-8"
            >
                <UpdatePasswordForm class="tw-max-w-xl"/>
            </div>

            <div
                class="tw-bg-white tw-p-4 tw-shadow sm:tw-rounded-lg sm:tw-p-8"
            >
                <DeleteUserForm class="tw-max-w-xl"/>
            </div>
        </div>
<!--    </div>-->
</template>
