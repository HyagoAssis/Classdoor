<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import SiteLayout from "@/Layouts/SiteLayout.vue";
</script>

<template>
    <SiteLayout>
        <div class="tw-flex tw-flex-col sm:tw-justify-center tw-items-center tw-pt-6 sm:tw-pt-0">
            <div
                class="tw-w-full sm:tw-max-w-md tw-mt-6 tw-px-6 tw-py-4 tw-bg-white tw-shadow-md tw-overflow-hidden sm:tw-rounded-lg"
            >
                <slot />
            </div>
        </div>
    </SiteLayout>

</template>
