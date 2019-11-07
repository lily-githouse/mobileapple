<template>
    <!--首页-->
    <div class="main">
        <!--头部-->
        <apple-header></apple-header>
        <!--        <van-loading type="spinner" color="#1989fa"/>-->
        <!--轮播图开始-->
        <van-swipe :autoplay="3000" indicator-color="#FF9201" class="van-swipe">
            <van-swipe-item>
                <a href="">
                    <img src="./images/banner-img1.jpg">
                </a>
            </van-swipe-item>
            <van-swipe-item>
                <a href="">
                    <img src="./images/banner-img3.jpg">
                </a>
            </van-swipe-item>
            <van-swipe-item>
                <a href="">
                    <img src="./images/banner-img1.jpg">
                </a>
            </van-swipe-item>
            <van-swipe-item>
                <a href="">
                    <img src="./images/banner-img3.jpg">
                </a>
            </van-swipe-item>
        </van-swipe>
        <!--金刚区开始-->
        <!-- 分类导航开始 -->
        <div class="classify-menu">
            <a href="fruitSpecial.html" style="cursor:pointer">
                <div class=" img-1 ">
                    <img src="./images/category1.png" alt="图片加载失败 ">
                </div>
                <span>水果特惠</span>
            </a>
            <a href="daily.html ">
                <div class="img-1 img-color2 ">
                    <img src="./images/category2.png" alt="图片加载失败 ">
                </div>
                <span>每日必抢</span>

            </a>
            <a href="benifit.html ">
                <div class="img-1 img-color3 ">
                    <img src="./images/category3.png" alt="图片加载失败 ">
                </div>
                <span>嗨吃福利</span>

            </a>
            <a href="recommed.html ">
                <div class="img-1 img-color4 ">
                    <img src="./images/category4.png" alt="图片加载失败 ">
                </div>
                <span>鲜蜂力荐</span>
            </a>
            <div style="clear:both; "></div>
        </div>
        <!-- 分类导航结束 -->

        <!-- 优选水果开始 -->
        <div v-if="cateGoods.length">
            <div class="specialBox" v-for="cate in cateGoods" :key="cate.id">
                <div class="brand-1 ">
                    <span class="brand-text-1">{{cate.cname}}</span>
                    <div class="brand-img-1 ">
                        <router-link :to="{name:'list1',query:{cid:cate.id}}">
                            <img src="./images/right-arrow.png" class="tu">
                        </router-link>
                    </div>
                </div>
                <div class="special-banner">
                    <img :src="imgHost+cate.cthumb" :alt="cate.cname" class="banner1 ">
                </div>
                <div class="special-box3">
                    <div class="special-box3l" v-for="goods in cate.goods" :key="goods.gid">
                        <div class="special-img1">
                            <router-link :to="{name:'detail',query:{id:goods.gid}}">
                                <img :src="imgHost+goods.gthumb" :alt="goods.gname">
                            </router-link>
                        </div>
                        <span>{{goods.gname}}{{goods.norms}}</span>
                        <div class="special-text1 ">
                            <span>买一赠一</span>
                        </div>
                        <div class="special-text2">
                            ￥{{goods.gsale}}
                            <del>￥{{goods.gmprice}}</del>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 优选水果结束-->
        <!--底部开始-->
        <apple-footer></apple-footer>
    </div>
</template>

<script>
    import AppleHeader from "../../components/apple-header/Apple-header";
    import AppleFooter from "../../components/apple-footer/Apple-footer";
    import axios from "axios";
    import {HOSTNAME, SUCCESS, FAIL, IMGHOSTNAME} from "../../config/base";

    export default {
        name: "Index",
        components: {AppleHeader, AppleFooter},
        data() {
            return {
                cateGoods: [],
                imgHost: IMGHOSTNAME
            }
        },
        methods: {
            getCateGoods() {
                axios.get(HOSTNAME + "/api/index", {
                    // headers: {}
                }).then(res => {
                    let datas = res.data;
                    if (datas.code == SUCCESS && datas.data) {
                        this.cateGoods = datas.data;
                    } else if (datas.code == FAIL) {
                        this.$message.error(datas.msg);
                    }
                })
            }
        },
        beforeMount() {
            this.getCateGoods();
        }
    }
</script>

<style scoped>
    /*轮播图开始*/
    .van-swipe {
        width: 100%;
        height: 3.2rem;
    }

    .van-swipe-item > a {
        width: 100%;
        height: 100%;
    }

    .van-swipe-item > a > img {
        width: 100%;
        height: 100%;
    }

    /* 分类导航开始 */

    .main .classify-menu {
        width: 100%;
        padding-bottom: 0.3rem;
        background-color: #fff;
    }

    .main .classify-menu a {
        width: 25%;
        height: 100%;
        float: left;
        margin-top: 0.3rem;
    }

    .main .classify-menu a .img-1 {
        margin: 0 auto;
        width: 1rem;
        height: 1rem;
        background-color: #9BCBB5;
        border-radius: 50%;
        text-align: center;
    }

    .main .classify-menu a .img-1 img {
        margin-top: 0.24rem;
        width: 0.52rem;
        height: 0.52rem;
    }

    .main .classify-menu a span {
        margin-top: 0.2rem;
        width: 100%;
        font-size: 0.28rem;
        display: inline-block;
        text-align: center;
        color: #232326;
    }

    /* 调整分类区各个背景颜色 */

    .main .classify-menu .img-1.img-color2 {
        background-color: #E6C3BD;
    }

    .main .classify-menu .img-1.img-color3 {
        background-color: #EED0B8;
    }

    .main .classify-menu .img-1.img-color4 {
        background-color: #8CB2C5;
    }

    /* 分类导航结束 */
    /*品牌特卖开始*/
    .brand-1 {
        height: 0.9rem;
        text-align: center;
        line-height: 0.9rem;
    }

    .brand-1 .brand-text-1 {
        font-size: 0.32rem;
        vertical-align: middle;
    }

    .brand-1 .brand-img-1 {
        margin-left: 0.1rem;
        width: 0.36rem;
        height: 0.36rem;
        display: inline-block;
        vertical-align: middle;
    }

    .brand-1 .brand-img-1 img {
        /* 图片脱离盒子 */
        width: 100%;
        display: block;
    }

    /* 品牌特卖结束*/
    /* 优选水果开始 */

    .specialBox {
        margin-top: 0.1rem;
        background-color: #fff;
    }

    .special-banner {
        padding: 0 3% 0.2rem 3%;
        box-sizing: border-box;
    }

    .special-banner .banner1 {
        width: 100%;
        border-radius: 1rem;
    }

    .special-box3 {
        width: 100%;
        height: 4.44rem;
    }

    .special-box3 .special-box3l {
        width: 33.3%;
        height: 100%;
        float: left;
    }

    .special-box3l .special-img1 {
        width: 100%;
        text-align: center;
    }

    .special-box3l .special-img1 img {
        margin: 0.1rem 0;
        width: 60%;
    }

    .special-box3l span {
        padding: 0 5%;
        box-sizing: border-box;
        font-size: 0.28rem;
        display: inline-block;
        height: 0.8rem;
    }

    .special-box3l .special-text1 {
        padding: 0 5%;
        height: 0.36rem;
    }

    .special-text1 span {
        height: 0.36rem;
        font-size: 0.24rem;
        color: #fff;
        background-color: #FF8950;
        border-radius: 0.06rem;
        text-align: center;
        line-height: 0.36rem;
    }

    .special-box3l .special-text2 {
        margin-top: 0.16rem;
        padding: 0 5%;
        font-size: 0.28rem;
        color: #EA4D13;
        height: 0.8rem;
    }

    .special-text2 del {
        font-size: 0.24rem;
        color: #979797;
        margin-left: 0.04rem;
    }

    /* 优选水果,酒水饮料,休闲零食结束 */
</style>