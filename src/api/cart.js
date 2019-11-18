import instance from "./http";

//添加(初始化)购物车
function addCart(url, data) {
    return instance.post(url, data)
}

//读取对应用户的购物车
function getCart(url) {
    return instance.get(url);
}

//用户购物车中的商品减少---/api/cartupdate   save方法
function delCart(url,obj) {
    return instance.post(url,obj);
}

//切换商品状态
function toggleGoodsStatus(url,obj) {
    return instance.put(url,obj);
}

//下单
function insertOrders(url) {
    return instance.post(url);
}
export {addCart,getCart,delCart,toggleGoodsStatus,insertOrders};