<template>
    <div class="near-box">

        <!--购物车头部-->
        <div class="yx-index-top">
            <router-link :to="{name:'index'}">
                <i class="iconfont icon-zuoyoujiantou"></i>
            </router-link>
            <div class="index-top-box2">
                <span class="fresh-toptext1">购物车</span>
            </div>
            <div class="index-top-box1">
                <span class="index-top-img1">编辑
                    <i class="iconfont icon-iconfontsousuo1"></i>
                </span>
            </div>
        </div>
        <div class="bank"></div>
        <!-- 购物车头部结束 -->
        <!-- 精确坐标开始 -->
        <div class="location">
            <div class="loc-word">先锋侠需要您的精确坐标</div>
            <i></i>
        </div>
        <!-- 精确坐标结束 -->
        <!-- 收货事件开始 -->
        <div class="shopcheck">
            <div class="check-word">
                收货时间
            </div>
            <div class="arrive-time">
                今天三十分钟可到达(可预订) <i class="iconfont icon-you"></i>
            </div>
        </div>
        <!-- 收货时间结束 -->
        <!-- 商品列表开始 -->
        <div v-if="cart" class="goodlist">
            <div class="goods" v-for="good in cart.goods" :key="good.gid">
                <div class="btn-goods">
                    <div class="cir-select-a">
                        <div class="cir-item-a" @click="toggleGoodsStatus(good)">
                            <img src="../content/images/check4.png" :class="{actives:!good.status}">
                        </div>
                    </div>
                </div>
                <div class="goods-pic">
                    <img :src="imgHost+good.gthumb" :alt="good.gname" :title="good.gname">
                </div>
                <div class="message-box">
            <router-link class="text-one" :to="{name:'detail'}">
                {{good.gname}}
            </router-link>
                    <div class="fuhao-box">
                        <div class="fuhao">￥</div>
                        <div class="price">{{good.gsale}}</div>
                    </div>
                    <div class="select">
                        <div class="plus" @click="addGoods(good)">+</div>
                        <span class="sel-num">{{good.num}}</span>
                        <div class="minus" @click="delGoods(good)">-</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 商品列表结束 -->
        <!-- 全选开始 -->
        <div class="select-all">
            <div class="sel-box">
                <div class="cir-select">
                    <div class="cir-item" >
                        <img src="../content/images/check4.png" :class="{active:!isFullSelected}">
                    </div>
                </div>
                <span class="all">
                全选
            </span>
            </div>
            <div class="btn-bottom" v-if="cart">
                <div class="gray-box">
                    合计: ￥
                </div>
                <div class="zero">
                    {{cart.price}}
                </div>
                <div class="gray-box">
                    总数：
                </div>
                <div class="zero">
                    {{cart.total}}
                </div>
                <div class="pay" :class="{active:existSelectedGoods}" @click="settlement">
                    去结算
                </div>
            </div>
            <div class="rub">
                <i class="iconfont icon-lajit"></i>
            </div>
        </div>
        <div v-if="!cart">
            购物车空空如也
        </div>
        <!--底部-->
        <apple-footer :as="3"></apple-footer>

    </div>
</template>

<script>
    import AppleFooter from "../../components/apple-footer/Apple-footer";
    import {getCart, addCart, delCart, toggleGoodsStatus, insertOrders} from "../../api/cart";
    import {IMGHOSTNAME} from "../../config/base";
    import {mapState} from "vuex";
    import {mapGetters} from "vuex";
    import {SUCCESS} from "../../config/base";
    import {Toast} from "vant";

    export default {
        name: "Cart",
        components: {
            AppleFooter
        },
        data() {
            return {
                imgHost: IMGHOSTNAME,
            }
        },
        computed: {
            ...mapState({
                cart: 'cart'
            }),
            ...mapGetters(['isFullSelected', 'existSelectedGoods'])
        },
        methods: {
            //read方法 读取到对应用户的购物车
            getUCart() {
                getCart('/api/cart/1', this.cart);
            },
            //save方法添加到某一个用户的购物车
            addGoods(good) {
                let {uid, cid, gid, gname, gsale, gthumb} = good;
                addCart('/api/cart', {gid, gsale}).then(res => {
                    if (res.data.code == SUCCESS) {
                        //修改vuex  cart
                        this.$store.commit('IncGoods', {uid, cid, gid, gname, gsale, gthumb});
                        this.$store.commit('calcTotal');
                        this.$store.commit('calcPrice');
                    }
                });
            },
            delGoods(good) {
                let {gid, gsale} = good;
                delCart('/api/cartupdate').then(res => {
                    console.log(res);
                });
                this.$store.commit('DecGoods', {gid, gsale});
            },
            //点击按钮状态切换---update
            toggleGoodsStatus(good) {
                let {gid, gsale} = good;
                toggleGoodsStatus('/api/cart/3', {gid, gsale}).then(res => {
                    if (res.data.code == SUCCESS) {
                        this.$store.commit('toggleGoodsStatus', {gid});
                        this.$store.commit('calcTotal');
                        this.$store.commit('calcPrice');
                    }
                })
            },
            settlement() {
                if (!this.existSelectedGoods) {
                    Toast('请至少选择一件商品');
                    return;
                }
                //下单
                insertOrders('/api/orders').then(res => {
                    if (res.data.code == SUCCESS) {
                        this.$store.commit('ordersFinish');
                        //下单成功，跳到订单页面
                        this.$router.push({name: 'orders', query: {ordernum: res.data.ordernum}});
                    } else {
                        Toast(res.data.msg);
                    }
                });
            },
        },
        beforeMount() {
            this.getUCart();
        }
    }
</script>

<style scoped>
    body, html, .near-box {
        width: 100%;
        height: 100%
    }

    .near-box {
        max-width: 12.8rem;
        /*overflow: hidden;*/
        margin: 0 auto;
        height: auto;
    }

    /*购物车头部开始*/
    .bank {
        width: 100%;
        height: 0.9rem;

    }

    .yx-index-top {
        width: 100%;
        height: 0.9rem;
        position: fixed;
        top: 0;
        left: 0;
        background: #fff;
        z-index: 22;
        border-bottom: 0.1rem solid #f1f1f1;
        display: flex;
        justify-content: right;
    }

    .index-top-box2 {
        width: 100%;
        height: .9rem;
        text-align: center;
        line-height: .9rem;
    }

    .fresh-toptext1 {
        display: inline-block;
        font-size: .32rem;
    }

    .index-top-box1 {
        width: 17%;
        height: 100%;
        text-align: center;
    }

    .index-top-img1 {
        width: 0.4rem;
        height: 0.4rem;
        display: inline-block;
        margin-top: .08rem;
    }

    .index-top-img1 i {
        font-size: .4rem;
        line-height: .9rem;
    }

    /*头部结束*/
    a {
        list-style: none;
        color: white;
    }

    .location {
        width: 7rem;
        height: 0.8rem;
        padding: 0 0.25rem;
        margin-bottom: 0.1rem;
        font-size: 0.28rem;
        background-color: white;
        line-height: 0.8rem;
    }

    .shopcheck {
        width: 7rem;
        height: 0.8rem;
        padding: 0 0.25rem;
        margin-bottom: 0.1rem;
        font-size: 0.28rem;
        background-color: white;
        line-height: 0.8rem;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .arrive-time {
        color: lightblue;
    }

    input {
        width: 0.3rem;
        height: 0.3rem;
        border-radius: 50%;
    }

    .goodlist {
        width: 100%;
        height: 8.5rem;
        overflow: auto;
    }

    .goods {
        width: 7rem;
        height: 2.4rem;
        padding: 0.1rem 0.25rem;
        background-color: white;
        border-top: solid 1px #f6f6f6;
    }

    .btn-goods {
        width: 0.6rem;
        height: 2.4rem;
        float: left;
    }

    .goods-pic {
        float: left;
    }

    .goods-pic > img {
        width: 2rem;
        height: 2rem;
        margin-top: 0.2rem;
    }

    .message-box {
        width: 4.13rem;
        height: 2.2rem;
        margin-top: 0.2rem;
        float: left;
    }

    .price {
        margin-top: 0.1rem;
        color: orangered;
        float: left;
    }

    .select {
        /*margin-left: 0.5rem;*/
        width: 4.13rem;
        height: 0.88rem;
        margin-top: 0.1rem;
    }

    .select > button {
        border-radius: 50%;
    }

    .select-all {
        position: fixed;
        left: 0;
        bottom: 1rem;
        background-color: white;
        width: 7rem;
        height: 0.92rem;
        padding: 0 0.25rem;
        border-bottom: solid 1px #f6f6f6;
    }

    .sel-box {
        width: 1.3rem;
        height: 0.94rem;
        overflow: hidden;
        float: left;
    }

    .cir-select {
        margin-top: 0.2rem;
        width: 0.33rem;
        height: 0.33rem;
        background-color: white;
        border: solid 3px #d3d3d3;;
        border-radius: 50%;
        float: left;
    }

    .all {
        line-height: 0.94rem;
        margin-right: 0.1rem;
    }

    .gray-box {
        padding-left: 0.07rem;
        color: rgb(168, 168, 168);
        font-size: 0.28rem;
        float: left;
        line-height: 0.94rem;
    }

    .zero {
        color: orange;
        font-weight: 900;
        line-height: 0.94rem;
        margin-left: 0.07rem;
        float: left;
    }

    .pay {
        width: 1.4rem;
        height: 0.6rem;
        background-color: orange;
        border-radius: 0.3rem;
        text-align: center;
        line-height: 0.6rem;
        color: white;
        float: right;
        margin-top: 0.1rem;
    }

    .cir-item {
        width: 0.33rem;
        height: 0.33rem;
        background-color: white;
        border-radius: 50%;
    }

    .cir-item > img {
        width: 100%;
        height: 100%;
    }

    .cir-select-a {
        margin-top: 1rem;
        width: 0.33rem;
        height: 0.33rem;
        background-color: white;
        border: solid 0.04rem #d3d3d3;;
        border-radius: 50%;
        float: left;
    }


    .cir-item-a {
        width: 0.33rem;
        height: 0.33rem;
        border-radius: 50%;
    }

    .cir-item-a.active {
        background: #f44a0f;
    }

    .cir-item-a > img {
        width: 100%;
        height: 100%;
    }

    .plus {
        text-align: center;
        width: 0.44rem;
        height: 0.44rem;
        float: left;
        border-radius: 50%;
        line-height: 0.44rem;
        border: solid 2px #d3d3d3;
    }

    .minus {
        border-radius: 50%;
        text-align: center;
        margin-left: 0.2rem;
        width: 0.44rem;
        height: 0.44rem;
        float: left;
        line-height: 0.44rem;
        border: solid 2px #d3d3d3;
    }

    .sel-num {
        float: left;
    }

    .arrive-time > i {
        color: black;
    }

    .rub {
        float: right;
        line-height: 0.92rem;
        display: none;
    }

    .fuhao {
        color: #ff4500;
        width: 0.4rem;
        float: left;
        line-height: 0.55rem;
    }

    .text-one {
        -webkit-line-clamp: 2;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .actives {
        display: none;
    }
    .cir-item >.active {
        display:none;
    }
    .existSelectedGoods {
        color: #cccccc;
    }

</style>