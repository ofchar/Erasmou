import axios from 'axios';
import Swal from 'sweetalert2';

export default class apiWrapper {
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
            console.log(error);
            if (error.response) {
                if (error.response.status == 401) {
                    localStorage.removeItem('user');
                    localStorage.removeItem('role');

                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'You need to be logged in to do this!',
                    }).then((result) => {
                        window.location.replace('/login');
                    });

                    return;
                }

                if (error.response.status == 403) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You do not have permissions to do this!',
                    }).then((result) => {
                        //
                    });

                    return Promise.reject();
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
        return this.instance.put('/webapi/' + model + '/' + uuid, data, {})
    }

    create(model, data) {
        return this.instance.post('/webapi/' + model, data, {})
    }

    delete(model, uuid) {
        return this.instance.delete('/webapi/' + model + '/' + uuid, {})
    }


    get(route, params) {
        return this.instance.get(route, {
            params: params
        });
    }

    post (route, data) {
        return this.instance.post(route, data);
    }

    put (route, data) {
        return this.instance.put(route, data);
    }
}