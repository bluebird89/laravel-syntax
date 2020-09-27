<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                发布文章
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <post-create-form/>
                <jet-section-border/>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from './../../Layouts/AppLayout'
import JetSectionBorder from './../../Jetstream/SectionBorder'
import PostCreateForm from "./PostCreateForm";

export default {
    components: {
        AppLayout,
        JetSectionBorder,
        PostCreateForm
    },
}
</script>
