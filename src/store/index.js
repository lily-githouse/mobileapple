import Vue from 'vue'
import Vuex from 'vuex';
import VuexPersistence from 'vuex-persist';
import {getCart} from "../api/cart";
import {SUCCESS} from "../config/base";

Vue.use(Vuex);

//state 数据唯一来源
//mutations 状态修改的唯一方法
export default new Vuex.Store({
    state: {
        // name: 'zhangsan',
        // sex: 'nan',
        // skill: ['html', 'js', 'vue'],
        token: '',
        isShow: false,
        cart: null
    },
    getters: {
        // reverseNames(state) {
        //     return state.name.split('').reverse().join('');
        // },
        // filterSkill(state) {
        //     return state.skill.filter(ele => ele.includes('s'));
        // },
        //页面商品数字累加
        goodsNumber: function (state) {
            return function (id) {
                let num = 0;
                if (!state.cart) {
                    return num;
                }
                let goods = state.cart.goods.filter(ele => id == ele.gid)[0];   //对象
                if (goods) {
                    num = goods.num
                }
                return num;
            }
        },

        //分类页面商品数字减减，依赖数据库的商品数目
        goodsNum: function (state) {
            //不用判断购物车和商品是否存在
            return function (id) {
                let goods = state.cart.goods.filter(ele => id == ele.gid)[0];
                goods.num--;
            }
        },

        //前台商品的全选依赖数据库中商品的状态   every方法
        isFullSelected(state) {
            let flag = false;
            if (state.cart) {
                flag = state.cart.goods.every(ele => ele.status);
            }
            return flag;
        },

        //是否存在选中商品--去结算
        existSelectedGoods(state) {
            let flag = false;
            if (state.cart) {
                flag = state.cart.goods.some(ele => ele.status);
            }
            return flag;
        }

    },
    //处理同步操作
    mutations: {
        changeToken(state, token) {
            state.token = token;
        },
        toggle(state, bool) {
            state.isShow = bool;
        },
        //登录成功之后设置购物车
        setCart(state, cart) {
            state.cart = cart;
        },
        /**  payload
         *uid,cid
         * gid,gsale,gname,gthumb
         *
         */
        //累加商品  商品添加到购物车
        IncGoods(state, payload) {
            let {uid, cid, gid, gname, gsale, gthumb} = payload;
            //判断是否存在购物车
            if (!state.cart) {
                //初始化
                state.cart = {
                    cid,
                    total: 1,
                    price: gsale,
                    uid,
                    goods: []
                }
            }
            //判断是否存在该商品
            let goods = state.cart.goods.filter(ele => gid == ele.gid)[0];
            if (goods) {
                //累加
                goods.num++;
            } else {
                //添加push
                state.cart.goods.push({gid, num: 1, status: 1, gname, gsale, gthumb});
            }
        },
        //计算总数，不需要传参
        calcTotal(state) {
            let total = 0;
            //选中的商品num求和
            let goods = state.cart.goods.filter(ele => ele.status);
            if (goods.length) {
                //数组的reduce方法，将每个元素执行回调函数，最终结果汇总，然后返回
                total = goods.reduce(function (prev, current) {
                    return prev + current.num;
                }, 0);
            }
            state.cart.total = total;
        },
        //计算总价
        calcPrice(state) {
            let total = 0;
            //选中的商品计算总价
            let goods = state.cart.goods.filter(ele => ele.status);
            if (goods.length) {
                //数组的reduce方法，将每个元素执行回调函数，最终结果汇总，然后返回
                total = goods.reduce(function (prev, current) {
                    return prev + current.num * current.gsale;
                }, 0);
            }
            state.cart.price = total;
        },

        //商品数量减减
        DecGoods(state, gid) {
            // let {uid, cid, gid, gname, gsale, gthumb} = payload;
            let goods = state.cart.goods.filter(ele => gid == ele.gid)[0];
            let number = goods.num--;
            state.cart.goods.num = number;
        },

        //点击按钮切换商品状态
        toggleGoodsStatus(state, payload) {
            let gid = payload.gid;
            // let gsale=payload.gsale;
            let goods = state.cart.goods.filter(ele => ele.gid == gid)[0];
            goods.status = (!goods.status) * 1;  //0->布尔值
        },

        //下单结束
        ordersFinish(state) {
            //选中的商品过滤掉
            state.cart.goods = state.cart.goods.filter(ele => !ele.status);
            //存在商品--商品数组长度,更新主表
            if (state.cart.goods.length) {
                state.cart.price = 0;
                state.cart.total = 0;
            }
            //不存在商品，删除主表数据
            state.cart = null;
        },
        //商品减少之后计算总数
        delTotal(state) {
            let total = state.cart.goods.reduce(function (prev, current) {
                return prev - current.num;
            });
            state.cart.total = total;
        },

        //商品减少之后计算总价
        delPrice(state) {
            let price = state.cart.goods.reduce(function (prev, current) {
                return prev - current.num * current.gsale;
            }, state.cart.price);
            state.cart.price = price;
        }

    },
    plugins: [new VuexPersistence().plugin],
    //处理异步操作
    actions: {
        setCart(context) {
            //发异步请求  read方法
            getCart('/api/cart/1').then(res => {
                if (res.data.code == SUCCESS) {
                    let data = res.data.data ? res.data.data : null;
                    //提交mutations
                    context.commit('setCart', data);
                }
            })
        }
    },
    modules: {}
})
