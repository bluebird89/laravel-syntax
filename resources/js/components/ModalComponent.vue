<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <slot name="header"></slot>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li v-for="language in languages" v-bind:key="language.id">
                            <slot v-bind:language="language">{{ language.name }}</slot>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ModalComponent',
    data() {
        return {
            languages: []
        }
    },
    mounted() {
        axios.get('/api/languages').then(response => this.languages = response.data)
    }
}
</script>

<style scoped>
ul li {
    text-align: left;
}
</style>
