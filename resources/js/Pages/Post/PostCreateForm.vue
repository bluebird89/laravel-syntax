<template>
    <jet-form-section @submitted="storePostInformation">
        <template #title>
            发布新文章
        </template>
        <template #description>
            这里是发布新文章页面
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-6">
                <jet-label for="title" value="标题"/>
                <jet-input id="title" ref="current_title" type="text" v-model="form.title" class="mt-1 block w-full"/>
                <jet-input-error :message="form.error('title')" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-6">
                <jet-label for="author" value="作者"/>
                <jet-input id="author" type="text" v-model="form.author" class="mt-1 block w-full"/>
                <jet-input-error :message="form.error('author')" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-6">
                <jet-label for="body" value="内容"/>
                <textarea rows="5" id="body" v-model="form.body" class="form-input rounded-md shadow-sm mt-1 block w-full">{{
                        form.body
                    }}</textarea>
                <jet-input-error :message="form.error('body')" class="mt-2"/>
            </div>
        </template>

        <template #actions>
            <jet-button>
                立即发布
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
import JetLabel from './../../Jetstream/Label'
import JetButton from './../../Jetstream/Button'
import JetInput from './../../Jetstream/Input'
import JetInputError from './../../Jetstream/InputError'
import JetFormSection from './../../Jetstream/FormSection'

export default {
    components: {
        JetLabel,
        JetButton,
        JetInput,
        JetInputError,
        JetFormSection
    },

    data() {
        return {
            form: this.$inertia.form({
                title: '',
                author: '',
                body: '',
            }, {
                bag: 'storePostInformation',
            })
        }
    },
    methods: {
        storePostInformation() {
            this.form.post('/post', {
                preserveScroll: true
            }).then(() => {
                this.$refs.current_title.focus()
            });
        }
    }
}
</script>
