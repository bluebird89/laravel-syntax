<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Hello Component</div>

                    <div class="card-body">
                        I'm an example component.
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'HelloComponent',
    mounted() {
        console.log('Component mounted.')
    }
}
</script>

<style scoped>
.container {
    margin: 10px;
}
</style>
