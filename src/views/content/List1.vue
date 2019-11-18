<template>
    <div>
        <link rel="stylesheet" href=" http://at.alicdn.com/t/font_1396400_pipc8gjmfjl.css">
        <!--            <van-loading type="spinner" color="#1989fa"/>-->
        <!-- 顶部标题栏开始 -->
        <div class="special-title">
            <router-link :to="{name:'index'}">
                <i class="iconfont icon-zuoyoujiantou"></i>
            </router-link>
            <span> {{cateGoods.cname}}</span>
        </div>
        <div class="box"></div>
        <!-- 顶部标题栏结束 -->
        <!--下拉刷新-->
        <van-pull-refresh v-model="isLoading" @refresh="onRefresh" pulling-text="释放刷新">
            <!-- 鲜锋水果铺部分开始 -->
            <div class="special-shop">
                <div class="shop-img">
                    <img src="./images/discounts-img1.jpg">
                </div>
                <!-- 鲜锋水果铺部分列表内容开始 -->

                <div class="discount-list" v-for="goods in good" :key="goods.gid">
                    <a class="list-img">
                        <router-link :to="{name:'detail',query:{id:goods.gid}}">
                            <div>
                                <img :src="imgHost+goods.gthumb" :alt="goods.gname" :title="goods.gname">
                            </div>
                        </router-link>
                    </a>
                    <div class="list-text">
                        <router-link :to="{name:'detail',query:{id:goods.gid}}">
                        <span class="list-title">{{goods.gname}}{{goods.norms}}</span>
                        </router-link>
                        <span class="list-price">￥{{goods.gsale}}<span
                                style=" margin-left: 0.1rem;font-size: 0.28rem;color: #8d8d8d;text-decoration: line-through;">原价{{goods.gmprice}}</span></span>
                        <a href="message2.html">
                            <button class="button">立即购买</button>
                        </a>
                    </div>
                </div>
                <!-- 鲜锋水果铺部分列表内容结束 -->
            </div>
        </van-pull-refresh>
    </div>

</template>

<script>
    import {IMGHOSTNAME, HOSTNAME, SUCCESS, FAIL} from "../../config/base";
    import axios from "axios";

    export default {
        name: "List",
        data() {
            return {
                cateGoods: [],
                good: [],
                imgHost: IMGHOSTNAME,
                id: 0,
                loading: false,   //是否处于加载状态
                // finished: false,  //是否已加载完所有数据
                isLoading: false, //是否处于下拉刷新状态
                //    分页
                current: 0,
                limit:2,
                //总页数
                total: 0

            }
        },
        methods: {
            onRefresh() {       //下拉刷新
                setTimeout(() => {
                    this.getGoods();
                    this.$toast('刷新成功');
                    //表示加载完成
                    this.isLoading = false;
                }, 500);
            },
            getCateGoods() {
                axios.get(HOSTNAME + '/api/list1/' + this.id)
                    .then(res => {
                        let datas = res.data;
                        if (datas.code == SUCCESS) {
                            this.cateGoods = datas.data;
                        } else if (datas.code == FAIL) {
                            this.$message.error('服务器异常');
                        }
                    })
            },
            getGoods() {
                // 每下拉一次页数加1，增加新数据. 默认显示第一页，所以将current默认值设为0
                this.current++;
                // 每次发请求之前比较当前页与总页数的关系，大于表示没新数据
                if (this.current > 1 && this.current > this.total) {
                    this.isLoading = false;
                    return;
                }
                axios.get(HOSTNAME + '/api/goodscate', {
                    //参数
                    params: {
                        //传过去当前分类
                        cid:this.id,
                        page: this.current,
                        limit: this.limit
                    }
                }).then(res => {
                    let datas = res.data;
                    if (datas.code == SUCCESS) {
                        //后台返回总的数量和数据
                        let {total, data} = datas;
                        //手动计算总页数
                       // 第一次total为0，
                       !this.total && (this.total= Math.ceil(total / this.limit));
                        this.good.unshift(...data);
                    } else {
                        this.$message.error(datas.msg);
                    }
                })
            }
        },
        beforeMount() {
            //拿到当前分类的id
            this.id = this.$route.query.cid;
            this.getCateGoods();
            this.getGoods();
        }
    }
</script>

<style scoped>
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

    .box {
        width: 100%;
        height: 0.88rem;
    }

    /* 顶部标题栏结束 */

    /* 鲜锋水果铺列表内容开始 */

    .discount-list {
        width: 94%;
        margin: 0.2rem 3% 0 3%;
        height: 2.8rem;
        border: 0.02rem solid #dedede;
    }

    .list-img {
        width: 2.8rem;
        height: 2.8rem;
        text-align: center;
        float: left;
    }

    .list-img img {
        width: 2rem;
        margin-top: 0.4rem;
    }

    .list-text {
        /* float: right; */
        height: 2.2rem;
        margin-top: 0.3rem;
    }

    .list-title {
        width: 95%;
        height: 0.8rem;
        line-height: 0.4rem;
        font-size: 0.28rem;
    }

    .list-price {
        display: block;
        width: 95%;
        margin-top: 0.5rem;
        font-size: 0.32rem;
        color: #EF7D00;
    }

    .list-text .button {
        padding: 0 0.3rem;
        box-sizing: border-box;
        height: 0.56rem;
        line-height: 0.56rem;
        background: #F47C02;
        color: #fff;
        border-radius: 0.3rem;
        font-size: 0.28rem;
        margin-top: 0.16rem;
        margin-left: 0.2rem;
        outline: none;
        border: none;
    }


    /* 鲜锋水果铺列表内容结束 */

</style>