import axios from 'axios';

export default class api {
    instance

    constructor(url) {
        this.instance = axios.create({
            baseURL: url
        });

        this.instance.defaults.headers.post['Accept'] = 'application/json';
    }

    index(model, params) {
        return this.instance.get(model, {
            params: params
        })
    }

    show(model, id) {
        return axios.get(this.url + '/' + model + '/' + id, {})
    }

    update(model, id, data) {
        return axios.put(this.url + '/' + model + '/' + id, data, {})
    }

    create(model, data) {
        return axios.post(this.url + '/' + model, data, {})
    }

    delete(model, id) {
        return axios.delete(this.url + '/' + model + '/' + id, {})
    }
}