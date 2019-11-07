import instance from "./http";
import {HOSTNAME} from "../config/base";
//register---注册
function register(url,data) {
    return instance.post(HOSTNAME+url,data)
}
//login---登录
function login(url,data) {
    return instance.post(HOSTNAME+url,data);
}
//info---个人信息
//edit
export {register,login}
