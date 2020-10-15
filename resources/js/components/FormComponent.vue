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
        <form @submit.prevent="store">
            <div class="form-group">
                <label for="title">标题</label>
                <input type="text" ref="title" class="form-control" id="title" v-model="article.title">
                <div class="alert alert-danger" role="alert" v-show="errors.title">
                    {{ errors.title }}
                </div>
            </div>
            <div class="form-group">
                <label for="author">作者</label>
                <input type="text" ref="author" class="form-control" id="author" v-model="article.author">
                <div class="alert alert-danger" role="alert" v-show="errors.author">
                    {{ errors.author }}
                </div>
            </div>
            <div class="form-group">
                <label for="content">内容</label>
                <textarea class="form-control" ref="content" id="content" rows="5" v-model="article.content"></textarea>
                <div class="alert alert-danger" role="alert" v-show="errors.content">
                    {{ errors.content }}
                </div>
            </div>
            <button type="submit" class="btn btn-primary">立即发布</button>
            <div class="alert alert-success" role="alert" v-show="published">
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
            article: {
                title: "",
                author: "",
                content: "",
            },
            errors: {
                title: "",
                author: "",
                content: "",
            },
            published: false
        }
    },
    methods: {
        store() {
            // 先清理错误消息
            Object.entries(this.errors).forEach(error => {
                let [key, msg] = error
                this.errors[key] = "";
            });
            axios.post("/post", this.article).then(response => {
                // 请求处理成功
                this.published = true;
                console.log(response.data);
            }).catch(error => {
                // 请求验证失败
                // 获取验证错误包
                let errorBag = error.response.data;
                // 错误包中每个字段的错误信息可能有多个
                Object.entries(errorBag.errors).forEach(bag => {
                    let [field, errors] = bag;
                    if (errors.length > 0) {
                        this.errors[field] = errors.join('<br>');
                    }
                });
            });
        }
    }
}
</script>
