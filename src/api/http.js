//配置关于请求的相关信息
//HOSTNAME,token,loading,响应处理
import axios from "axios";
import {HOSTNAME} from "../config/base";
import store from "../store/index";
//创建实例
let instance = axios.create({
    baseURL: HOSTNAME,
    timeout: 5000
});

// Add a request interceptor  请求拦截器
instance.interceptors.request.use(function (config) {
    // Do something before request is sent
   store.commit('toggle',true);
   if (store.state.token){
       config.headers={
           token:store.state.token,
           'content-type':'application/json'
       }
   }
    return config;
}, function (error) {
    // Do something with request error
    store.commit('toggle',false);
    return Promise.reject(error);
});

// Add a response interceptor   响应拦截器
instance.interceptors.response.use(function (response) {
    // Do something with response data
    store.commit('toggle',false);
    return response;
}, function (error) {
    // Do something with response error
    store.commit('toggle',false);
    return Promise.reject(error);
});


//暴露
export default instance;

