//订单模块
import instance from "./http";

//read
function queryOrders(url) {
    return instance.get(url);
}

function queryAddress(url) {
    return instance.get(url);
}
//去支付
function payOrders(url,data) {
    return instance.put(url,data);
}
//付钱  --put
// function payMoney() {
//     return instance
//
// }
export {queryOrders,queryAddress,payOrders};