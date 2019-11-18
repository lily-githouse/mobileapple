<template>
    <div class="near-box">
        <link rel="stylesheet" href="http://at.alicdn.com/t/font_1396400_pipc8gjmfjl.css">
        <!--订单头部-->
        <div class="yx-index-top">
            <router-link :to="{name:'index'}" class="yx-index-top-box1">
                <i class="iconfont icon-zuoyoujiantou"></i>
            </router-link>
            <div class="yx-index-top-box2">
                订单详情
            </div>
            <div class="yx-index-top-box3" style="visibility: hidden;">
                编辑
            </div>
        </div>
        <div class="bank"></div>
        <!-- 订单头部结束 -->
        <!-- 发货信息开始 -->
        <div id="container">
            <div id="wrapper">
                <!-- 信息栏开始 -->
                <div class="text">
                    <div class="text-top">
                        <div class="nam">董辉</div>
                        <div class="tel">185****5453</div>
                        <div class="def">默认</div>
                    </div>
                    <div class="text-bottom">
                        北京市 海淀区 四环到五环之间 四季青杏石口路5号益园文化创业基地c3区4层
                    </div>
                </div>
                <!-- 信息栏结束 -->
                <!-- customer开始 -->
                <div v-if="orders">
                    <div class="connect" v-for=" item in orders.goods" :key="item.gid">
                        <div class="connect-top">
                            <div class="connect-topleft">
                                保洁官方旗舰店
                            </div>
                            <div class="connect-topright">
                                联系客服
                            </div>
                        </div>
                        <div class="connect-thing">
                            <div class="connect-pic">
                                <img :src="imgHost+item.gthumb" :alt="item.gname">
                            </div>
                            <div class="connect-brief">
                                {{item.gname}}{{item.norms}}
                            </div>
                            <div class="connect-price">
                                <div class="con-price">
                                    ￥{{item.gsale}}
                                </div>
                                <div class="con-count">
                                    x{{item.num}}
                                </div>
                            </div>
                        </div>
                        <div class="connect-btn" @click="goPay">
                            去支付
                        </div>

                    </div>

                    <!-- customer结束 -->
                    <!-- price条开始 -->
                    <div class="price-item">
                        <div class="price-left">
                            应付总额
                        </div>
                        <div class="price-right">
                            ￥{{orders.price}}
                        </div>
                    </div>
                    <div class="price-item">
                        <div class="price-lefta">
                            商品总价
                        </div>
                        <div class="price-righta">
                            ￥{{orders.price}}
                        </div>
                    </div>
                    <div class="price-item">
                        <div class="price-lefta">
                            运费
                        </div>
                        <div class="price-righta">
                            ￥0.00
                        </div>
                    </div>
                    <div class="price-item">
                        <div class="price-lefta">
                            税费
                        </div>
                        <div class="price-righta">
                            ￥0.00
                        </div>
                    </div>
                    <div class="price-item">
                        <div class="price-lefta">
                            发票信息
                        </div>
                        <div class="price-righta">
                            不需要发票
                        </div>
                    </div>

                    <!-- price条结束 -->
                    <!-- 底部开始 -->
                    <div class="bot-box">
                        <div class="bot-text"> 订单编号:{{orders.ordernum}}</div>
                        <div class="bot-text"> 支付方式:支付宝</div>
                        <div class="bot-text"> 支付交易单号:201711024866544846144</div>
                        <div class="bot-text"> 下单时间:{{orders.ctime}}</div>
                    </div>
                </div>
                <!-- 底部结束 -->
            </div>
        </div>
    </div>
</template>

<script>
    import {queryAddress, queryOrders, payOrders} from "../../api/orders";
    import {SUCCESS, IMGHOSTNAME} from "../../config/base";
    import {Toast} from "vant";

    export default {
        name: "Orders",
        data: function () {
            return {
                imgHost: IMGHOSTNAME,
                message: '',
                address: null,
                orders: null,
                ordernum: 0
            }
        },
        methods: {
            setAddress() {
                queryAddress('/api/address/123').then(res => {
                    if (res.data.code == SUCCESS && res.data.data) {
                        this.address = res.data.data;
                    } else {
                        Toast(res.data.msg);
                    }
                })
            },
            setOrders() {
                queryOrders('/api/orders/'+this.ordernum).then(res => {
                    if (res.data.code == SUCCESS && res.data.data) {
                        this.orders = res.data.data;
                        console.log(res.data);
                    } else {
                        Toast(res.data.msg);
                    }
                })
            },
            //去支付
            goPay() {
                //put 更新订单
                payOrders('/api/orders/' + this.ordernum, {aid: this.address.aid, remarks: this.orders.remarks})
                    .then(res => {
                        let {ordernum, price} = this.orders;
                        this.$router.push({name: 'pay', query: {ordernum, price}})
                        if (res.data.code == SUCCESS) {
                            console.log(res);
                        }
                    })
            },



        },
        beforeMount() {
            this.ordernum = this.$route.query.ordernum;
            //发请求
            this.setOrders();
            this.setAddress();
        }
    }


</script>

<style scoped>

    @import "../../style/Orders.css";
</style>