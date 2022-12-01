import axios from 'axios';

export default class api {
    instance

    constructor(url) {
        this.instance = axios.create({
            baseURL: url
        });

        this.instance.defaults.headers.get['Accept'] = 'application/json';
        this.instance.defaults.headers.post['Accept'] = 'application/json';
        this.instance.defaults.withCredentials = true;

        this.instance.interceptors.response.use(function (response) {
            return response;
        }, function (error) {
            if (error.response) {
                if (error.response.status == 401) {
                    localStorage.removeItem('user');

                    window.location.replace('/login');
                }
            }

            return Promise.reject(error);
        });
    }

    index(model, params) {
        return this.instance.get('/webapi/' + model, {
            params: params
        })
    }

    show(model, uuid, params = null) {
        return this.instance.get('/webapi/' + model + '/' + uuid, {
            params: params
        })
    }

    update(model, uuid, data) {
        return axios.put('/webapi/' + model + '/' + uuid, data, {})
    }

    create(model, data) {
        return axios.post('/webapi/' + model, data, {})
    }

    delete(model, uuid) {
        return axios.delete('/webapi/' + model + '/' + uuid, {})
    }

    get(route, params) {
        return this.instance.get(route, {
            params: params
        });
    }

    post (route, data) {
        return this.instance.post(route, data);
    }
}