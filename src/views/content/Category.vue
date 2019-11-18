<template>

    <div class="near-box">
        <!--分类头部-->
        <div class="yx-index-top">
            <!--            <router-link :to="{name:'index'}">-->
            <i class="iconfont icon-zuoyoujiantou" @click="back"></i>
            <!--            </router-link>-->
            <div class="index-top-box2">
                <span class="fresh-toptext1">派送至：北京石景山</span>
                <span class="fresh-topimg1">
                    <i class=" iconfont icon-shangjiantou1"></i>
                </span>
            </div>
            <div class="index-top-box1">
                <span class="index-top-img1">
                    <i class="iconfont icon-iconfontsousuo1"></i>
                </span>
            </div>
        </div>
        <div class="bank"></div>
        <!-- 分类头部结束 -->
        <!--中间内容开始-->
        <div class="classify-bigbox">
            <!--左侧分类导航开始-->
            <div class="classify-left">
                <van-pull-refresh v-model="isLoadingleft" @refresh="onRefreshleft">
                    <span class="classify-text1" v-for="cate in cates"
                          :key="cate.id" :class="{active:cate.id==currentCate}" @click="changeCate(cate.id)">{{cate.cname}}</span>
                </van-pull-refresh>
            </div>
            <!--右侧商品列表开始-->
            <div class="classify-right">
                <!--粘性布局-->
                <van-sticky :offset-top="50">
                    <div class="classify-right-title">
                        <span class="classifyrt-text1">综合排序</span>
                        <span class="classifyrt-text1 price">按价格
                            <i class="sort-img" @click="sort"></i>
                            <i class="sort-img2 img3" style="display: none;"></i>
                        </span>
                        <span class="classifyrt-text1 list-show">分类</span>
                    </div>
                </van-sticky>
                <van-pull-refresh v-model="isLoading" @refresh="onRefresh">
                    <van-list
                            v-model="loading"
                            :finished="finished"
                            finished-text="没有更多了"
                            @load="onLoad"
                            :immediate-check="false"
                            :offset="400">
                        <div class="classify-right-bottom">
                            <!--商品列表循环-->
                            <div class="classify-box1" v-for="good in goods" :key="good.gid">
                            <span class="classify-box1-img1">
                                <img v-lazy="imgHost+good.gthumb" :alt="good.gname">
                            </span>
                                <div class="classify-box2">
                                    <span class="classify-box2-text1">{{good.gname}}{{good.norms}}</span>
                                    <span class="classify-box2-text2">￥{{good.gsale}}</span>
                                    <div class="shop-cart-box3">
                                        <span class="shop-cart-subtract" @click="delGoods(good.gid)"></span>
                                        <span id="tb_count" class="shop-cart-numer">{{$store.getters.goodsNumber(good.gid)}}</span>
                                        <span class="shop-cart-add" @click="addGoods(good)"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </van-list>
                </van-pull-refresh>
            </div>
        </div>
        <!--中间内容结束-->
        <!--底部开始-->
        <apple-footer :as="2"></apple-footer>
    </div>
</template>

<script>
    import {HOSTNAME, SUCCESS, IMGHOSTNAME} from "../../config/base";
    import axios from "axios";
    import AppleFooter from "../../components/apple-footer/Apple-footer";
    import {addCart,delCart} from "../../api/cart";

    export default {
        name: "Category",
        components: {
            AppleFooter
        },
        data() {
            return {
                cates: [],
                imgHost: IMGHOSTNAME,
                isLoading: false,
                isLoadingleft: false,
                loading: false,
                finished: false,
                //当前页
                current: 0,
                limit: 7,
                //当前分类
                currentCate: 0,
                goods: [],
                total: 0
            }
        },
        methods: {
            back() {
                // history.back();
            },
            //左侧分类导航刷新
            onRefreshleft() {
                setTimeout(() => {
                    this.$toast('刷新成功');
                    this.isLoadingleft = false;
                }, 500);
            },
            onRefresh() {
                setTimeout(() => {
                    this.$toast('刷新成功');
                    this.isLoading = false;
                }, 500);

            },
            sort() {
                this.onLoad();
                this.goods.sort(this.price('gsale'));
            },
            price(gsale) {
                return function (a, b) {
                    let value1 = a[gsale];
                    let value2 = b[gsale];
                    return value1 - value2;
                }
            },
            onLoad() {
                this.current++;
                //获取商品
                axios.get(HOSTNAME + '/api/goodscate', {
                    params: {
                        page: this.current,
                        limit: this.limit,
                        cid: this.currentCate,
                        gsale: this.gsale,
                    }
                }).then(res => {
                    let datas = res.data;
                    if (datas.code == SUCCESS) {
                        let {total, data} = datas;
                        !this.total && (this.total = Math.ceil(total / this.limit));
                        this.goods.push(...data);
                    }
                    //等页面DOM元素渲染完成之后执行的操作
                    this.$nextTick(() => {
                        this.isLoading = false;
                        this.loading = false;
                    })
                    if (this.current >= this.total) {
                        this.finished = true;
                    }
                })
            },
            changeCate(id) {
                this.currentCate = id;
            },
            getCate() {
                axios.get(HOSTNAME + '/api/cate')
                    .then(res => {
                        let datas = res.data;
                        if (datas.code == SUCCESS) {
                            this.cates = datas.data;
                            //默认显示第一个分类
                            this.currentCate = this.cates[0].id;
                        }
                    })
            },
            //save方法添加到某一个用户的购物车
            addGoods(good) {
                let{uid,cid,gid,gname,gsale,gthumb}=good;
                addCart('/api/cart', {gid, gsale}).then(res=>{
                    if (res.data.code==SUCCESS){
                        //uid,cid从后台返回的
                        this.$store.commit('IncGoods',{uid,cid,gid,gname,gsale,gthumb});
                    }
                });
            },
            delGoods(gid){
                delCart('/api/cartupdate').then(res=>{
                    console.log(res);
                })
                this.$store.commit('DecGoods',gid);
            }
        },
        watch: {
            currentCate() {
                this.current = 0;
                this.total = 0;
                this.goods = [];
                this.finished=false;
                this.onLoad();
            }
        },
        beforeMount() {
            this.getCate();
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
        overflow: hidden;
        margin: 0 auto;
    }

    /*分类头部开始*/
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

    .fresh-topimg1 {
        width: 0.24rem;
        height: .24rem;
        margin-left: 1rem;
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


    /*中间内容开始*/
    .classify-bigbox {
        width: 100%;
        /*减去头部和底部高度*/
        height: calc(100vh - 1.9rem);
        display: flex;
        justify-content: space-between;
    }

    /*左侧分类导航开始*/
    .classify-left {
        width: 30%;
        height: 100%;
        overflow-x: hidden;
        overflow-y: scroll;
        border-right: .02rem solid #F4F4F4;
    }

    .classify-text1 {
        width: 100%;
        float: left;
        text-align: center;
        height: .8rem;
        line-height: .8rem;
        overflow: hidden;
        font-size: .28rem;
        border-bottom: .02rem solid #EFEAEE;
    }

    .active::after {
        content: '';
        position: absolute;
        left: 0;
        /*top: 0;*/
        width: 0.02rem;
        height: 0.8rem;
        background-color: #FF9201;
        color: #FF9201;
    }

    /*左侧分类导航结束*/
    /*右侧商品列表开始*/
    .classify-right {
        width: 70%;
        height: 100%;
        overflow-y: scroll;
    }

    .classify-right-title {
        width: 100%;
        height: 0.7rem;
        /*background-color:red;*/
        line-height: 0.8rem;
        border-bottom: .02rem solid #EFEAEE;
        background-color: #fff;
    }

    .classify-right-bottom {
        width: 100%;
        height: auto;
        /*height:calc(100% - 0.8rem);*/
        /*background-color: green;*/
    }

    .classifyrt-text1 {
        width: 33.3%;
        text-align: center;
        float: left;
        font-size: .24rem;
    }

    .sort-img {
        width: .3rem;
        height: .3rem;
        display: inline-block;
        background: url(./images/sort1.png) no-repeat center center;
        background-size: 100%;
        vertical-align: middle;
        margin-top: -0.06rem;
    }

    .sort-img2 {
        width: .3rem;
        height: .3rem;
        display: inline-block;
        background: url(./images/sort2.png) no-repeat center center;
        background-size: 100%;
        vertical-align: middle;
        margin-top: -.02rem;
    }

    .img3 {
        background: url(./images/sort3.png) no-repeat center center;
        background-size: 100%;
    }

    .pitch-on-cl {
        color: #FF9201;
        border-color: #FF9201;
    }


    .classify-box1 {
        width: 100%;
        float: left;
        height: 1.6rem;
        border-bottom: .02rem solid #EFEFEF;
    }

    .classify-box1-img1 {
        width: 1.6rem;
        height: 1.6rem;
        float: left;
        text-align: center;
    }

    .classify-box1-img1 img {
        width: 1.2rem;
        height: 1.2rem;
        display: inline-block;
        margin-top: .2rem;
    }

    .classify-box2 {
        display: block;
        margin-left: 1.6rem;
        height: 1.5rem;
        margin-top: .1rem;
    }

    .classify-box2-text1 {
        width: 100%;
        float: left;
        height: .8rem;
        line-height: .4rem;
        font-size: .28rem;
        overflow: hidden;
    }

    .classify-box2-text2 {
        float: left;
        font-size: .28rem;
        color: #FF9201;
        line-height: .6rem;
        margin-top: .1rem;
    }

    .shop-cart-box3 {
        float: right;
        margin-top: .2rem;
        margin-right: .1rem;
    }

    .shop-cart-subtract {
        width: .4rem;
        height: .4rem;
        float: left;
        background: url(./images/subtract.png) no-repeat center center;
        background-size: 100%;
    }

    .shop-cart-numer {
        float: left;
        font-size: .28rem;
        line-height: .4rem;
        width: .4rem;
        border: none;
        outline: none;
        text-align: center;
    }

    .shop-cart-add {
        width: .4rem;
        height: .4rem;
        float: left;
        background: url(./images/add.png) no-repeat center center;
        background-size: 100%;
    }

    .classify-perch2 {
        width: 100%;
        height: 1rem;
        float: left;
    }

    /*    商品列表结束*/

</style>
<style>
    .van-sticky--fixed {
        left: 30%;
    }
</style>