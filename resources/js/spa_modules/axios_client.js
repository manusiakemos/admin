import store from "./store";
import router from "./router";
import axios from "axios";
require(".././bootstrap");
let axiosInstance = axios.create();
axiosInstance.interceptors.request.use(function (config) {
    // NProgress.start();
    if(store.state.auth){
        if (store.state.auth.status && store.state.auth.data) {
            let token = store.state.auth.token;
            if (token) {
                // config.headers['Authorization'] = `Bearer ${token}`
            }
        }
    }
    return config;
}, function (error) {
    // NProgress.done(true);
    // Do something with request error
    // console.log(error);
    return Promise.reject(error);
});

axiosInstance.interceptors.response.use(function (response) {
    // NProgress.done(true);
    // console.log(response);
    return response;
}, function (error) {
    // console.error(error);
    // console.log(error.response.data.message);
    if (error.response.status == 401 || error.response.status == 419) {
        var data = {
            "status": false,
            "token": "",
            "data": {
                "id": "",
                "name": "",
                "username": "",
                "password": "",
                "password_confirmation": "",
                "avatar": "",
                "role": "",
                "links": {
                    "update": "",
                    "edit": "",
                    "avatar": ""
                }
            }
        };
        store.commit("setAuth", data);
        router.push("/pages/login");
    }
    return Promise.reject(error);
});

export default axiosInstance;
