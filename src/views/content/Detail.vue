<template>
    <div>
        <link rel="stylesheet" href=" http://at.alicdn.com/t/font_1396400_yhr2gadh8e.css">
        <!-- 顶部标题栏开始 -->
        <div class="special-title">
<!--            <router-link :to="{name:'list1',params:{id:goods.cid}}">-->
                <i class="iconfont icon-zuoyoujiantou" @click="back"></i>
<!--            </router-link>-->
            <span>商品详情</span>
            <div class="share">
                <i class="iconfont icon-fenxiang"></i>
            </div>
        </div>
        <!-- 顶部标题栏结束 -->
        <div class="box"></div>
        <!--轮播图开始-->
        <van-swipe :autoplay="3000" indicator-color="#FF9201" class="van-swipe">
            <van-swipe-item>
                <a href="">
                    <img src="./images/fruits-img2.png">
                </a>
            </van-swipe-item>
            <van-swipe-item>
                <a href="">
                    <img src="./images/fruits-img4.png">
                </a>
            </van-swipe-item>
            <van-swipe-item>
                <a href="">
                    <img src="./images/fruits-img7.png">
                </a>
            </van-swipe-item>
            <van-swipe-item>
                <a href="">
                    <img src="./images/fruits-img8.png">
                </a>
            </van-swipe-item>
        </van-swipe>
        <!--轮播图结束-->
        <!-- 商品价格部分开始 -->
        <div class="price">
            <div class="detail-price">
<!--                                <p>{{goods.gname}}</p>-->
                <span>￥{{goods.gsale}}</span>
                <span><del>原价￥{{goods.gmprice}}</del></span>
                <span>特价</span>
            </div>
            <div class="detail-title">
                <span>{{goods.description}}</span>
            </div>
        </div>
        <!-- 商品详情部分开始 -->
        <div class="goods-detail">
            <div class="goods-detail-title">商品详情</div>
            <div class="goods-text">
                <span style="color:#8a8d93;line-height:0.6rem;">品牌： </span><span>{{goods.brand}}</span><br>
                <span style="color:#8a8d93;line-height:0.6rem;">产品规格： </span><span>{{goods.norms}}</span>
            </div>
        </div>
        <div class="goods-detail-title" style="background:#fff">图文详情</div>
        <div class="goods-gdetail-img" v-for="img in (goods.gdetail).split(',')" :key="img.gid">
            <img :src="imgHost+img">
        </div>
        <!-- 商品详情部分结束 -->
    </div>
</template>

<script>
    import {HOSTNAME, SUCCESS, FAIL, IMGHOSTNAME} from "../../config/base";
    import axios from "axios";

    export default {
        name: "Detail",
        data() {
            return {
                goods: [],
                imgHost: IMGHOSTNAME
            }
        },
        methods: {
            back(){
              // history.back();
            },
            getGoods(id) {
                axios.get(HOSTNAME + '/api/detail/' + id).then(res => {
                    let datas = res.data;
                    if (datas.code == SUCCESS) {
                        this.goods = datas.data;
                    } else if (datas.code == FAIL) {
                        this.$message.error(datas.msg);
                    }
                })
            }
        },
        beforeMount() {
            let id = this.$route.query.id;
            this.getGoods(id);
        }
    }
</script>

<style scoped lang="scss">
    /* 顶部标题栏开始 */

    .special-title {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 0.88rem;
        line-height: 0.88rem;
        text-align: center;
        background-color: #fff;
        z-index: 999;
        border-bottom: solid 1px #F6F6F4;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .special-title a {
        width: 0.8rem;
        height: 0.88rem;
        line-height: 0.88rem;
        color: #232326;
        float: left;
        text-align: center;
    }

    .special-title i {
        font-size: 0.34rem;
        font-weight: 600;
        color: gray;
    }

    .share {
        width: 0.8rem;
        height: 100%;
    }


    /* 顶部标题栏结束 */

    .box {
        width: 100%;
        height: 0.88rem;
    }

    /*轮播图开始*/
    .van-swipe {
        width: 100%;
        height: 7.5rem;
    }

    .van-swipe-item {
        width: 100%;
        height: 100%;
    }

    .van-swipe-item > a {
        width: 100%;
        height: 100%;
    }

    .van-swipe-item > a > img {
        width: 100%;
        height: 100%;
    }

    /*轮播图结束*/

    /* 商品价格部分开始 */

    .price {
        width: 100%;
        padding: 0 3% 0.24rem;
        padding-top: 0.3rem;
        box-sizing: border-box;
        background: #fff;
        border-top: 0.02rem solid #f6f6f6;
    }

    .detail-price {
        width: 100%;
        margin-bottom: 0.24rem;
        text-align: left;
    }

    .detail-price > span:nth-child(1) {
        font-size: 0.52rem;
        color: #ffb34e;
    }

    .detail-price > span:nth-child(2) {
        font-size: 0.24rem;
        color: #747474;
        margin: 0.24rem 0.1rem 0 0.1rem;
        text-decoration: line-through;
    }

    .detail-price > span:nth-child(3) {
        display: inline-block;
        background: #ffb34e;
        height: 0.36rem;
        line-height: 0.36rem;
        padding: 0 0.16rem;
        box-sizing: border-box;
        font-size: 0.24rem;
        color: #fff;
    }

    .detail-title {
        width: 100%;
    }

    .detail-title span {
        line-height: 0.44rem;
        font-size: 0.32rem;
    }

    /* 商品价格部分结束 */

    /* 商品详情部分开始 */

    .goods-detail {
        width: 100%;
        background-color: #fff;
    }

    .goods-detail-title {
        width: 100%;
        height: 0.9rem;
        line-height: 0.9rem;
        text-align: center;
        border-bottom: 0.02rem solid #f9f9f9;
        font-size: 0.3rem;
        margin-top: 0.2rem;
    }

    .goods-text {
        width: 100%;
        padding: 0.2rem 3%;
        box-sizing: border-box;
        font-size: 0.28rem;
    }

    .goods-gdetail-img {
        width: 100%;
        height: auto;

        > img {
            width: 100%;
            height: 100%;
        }
    }

    /* 商品详情部分结束 */


</style>