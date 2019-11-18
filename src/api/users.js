import instance from "./http";
//register---注册
function register(url,data) {
    return instance.post(url,data)
}
//login---登录
function login(url,data) {
    return instance.post(url,data);
}
//info---个人信息
function getinfo(url){
    return instance.get(url);
}
//edit

export {register,login,getinfo}
