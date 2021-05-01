<style scoped>
.post-form {
    margin: 50px auto;
    padding: 30px;
}

.alert {
    margin-top: 10px;
}
</style>

<template>
    <div class="card col-8 post-form">
        <h3 class="text-center">发布新文章</h3>
        <hr>
        <form @submit.prevent="store" @keyup="form.errors.clear($event.target.name)">
            <div class="form-group">
                <label for="title">标题</label>
                <input type="text" ref="title" class="form-control" id="title" name="title" v-model="form.title">
                <div class="alert alert-danger" role="alert" v-show="form.errors.get('title')">
                    {{ form.errors.get('title') }}
                </div>
            </div>
            <div class="form-group">
                <label for="author">作者</label>
                <input type="text" ref="author" class="form-control" id="author" name="author" v-model="form.author">
                <div class="alert alert-danger" role="alert" v-show="form.errors.get('author')">
                    {{ form.errors.get('author') }}
                </div>
            </div>
            <div class="form-group">
                <label for="content">内容</label>
                <textarea class="form-control" ref="body" id="body" name="body" rows="5"
                          v-model="form.body"></textarea>
                <div class="alert alert-danger" role="alert" v-show="form.errors.get('body')">
                    {{ form.errors.get('body') }}
                </div>
            </div>
            <button type="submit" class="btn btn-primary">立即发布</button>
            <div class="alert alert-success" role="alert" v-show="form.success">
                文章发布成功。
            </div>
        </form>
    </div>
</template>

<script>

export default {
    name: "FormComponent.vue",
    data() {
        return {
            form: new Form({
                title: '',
                author: '',
                body: ''
            })
        }
    },
    methods: {
        store() {
            this.form.post('/post')
                .then(data => console.log(data))   // 自定义表单提交成功处理逻辑
                .catch(data => console.log(data)); // 自定义表单提交失败处理逻辑
        }
    }
}
</script>
