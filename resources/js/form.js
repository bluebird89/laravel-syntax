class Form {
    constructor(data) {
        this.originData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
        this.success = false;
    }

    /**
     * 返回表单数据
     *
     * @returns {{}}
     */
    data() {
        let data = {};

        for (let field in this.originData) {
            data[field] = this[field];
        }

        return data;
    }

    /**
     * 清空表单数据
     */
    reset() {
        for (let field in this.originData) {
            delete this[field];
        }

        this.errors.clear();
    }

    /**
     * 发送 POST 请求
     *
     * @param url
     * @returns {Promise<unknown>}
     */
    post(url) {
        return this.submit(url, 'post');
    }

    /**
     * 发送 PUT 请求
     *
     * @param url
     * @returns {Promise<unknown>}
     */
    put(url) {
        return this.submit(url, 'put');
    }

    /**
     * 表单提交处理
     *
     * @param {string} url
     * @param {string} method
     */
    submit(url, method) {
        return new Promise((resolve, reject) => {
            axios[method](url, this.data())
                .then(response => {
                    this.onSuccess(response.data);
                    this.success = true;
                    resolve(response.data);
                })
                .catch(error => {
                    this.onFail(error.response.data.errors);
                    reject(error.response.data);
                });
        });
    }


    /**
     * 处理表单提交成功
     *
     * @param {object} data
     */
    onSuccess(data) {
        console.log(data);
        this.reset();
    }


    /**
     * 处理表单提交失败
     *
     * @param {object} errors
     */
    onFail(errors) {
        this.errors.set(errors);
    }

}

class Errors {
    constructor() {
        this.errors = {};
    }

    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }

    clear(field) {
        if (field) {
            delete this.errors[field];
            return;
        }
        this.errors = {};
    }

    set(errors) {
        this.errors = errors;
    }
}

export default Form;
