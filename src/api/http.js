//配置关于请求的相关信息
//HOSTNAME,token,loading,响应处理
import axios from "axios";
import {HOSTNAME} from "../config/base";
//创建实例
let instance = axios.create({
    baseURL: HOSTNAME,
    timeout: 5000
});
//暴露
export default instance;

