<template>
    <!--    个人中心-->
    <div class="box">
        <!-- 头部开始 -->
        <div class="personal-top">
            <div class="top-box">
                <div class="touxiang">
                    <img src="../content/images/person-头像.jpg" alt="">
                </div>
                <div class="top-wenzi">
                    <span class="wenzi">www.jsdaima.com</span>
                </div>
            </div>
        </div>
        <!-- 头部结束 -->
        <!-- 代付款 -->
        <div class="person">
            <a href="indent.html?id=1" class="fukuan">
                <div class="one">
                    <i class="iconfont icon-daifukuan"></i>
                </div>
                <div class="daifukuan">待付款</div>
            </a>
            <a href="indent.html?id=2" class="fukuan">
                <div class="one">
                    <i class="iconfont icon-daifahuo"></i>
                </div>
                <div class="daifukuan">待发货</div>
            </a>
            <a href="indent.html?id=3" class="fukuan">
                <div class="one">
                    <i class="iconfont icon-daishouhuo"></i>
                </div>
                <div class="daifukuan">待收货</div>
            </a>
            <a href="indent.html?id=4" class="fukuan">
                <div class="one">
                    <i class="iconfont icon-daipingjia"></i>
                </div>
                <div class="daifukuan">待评价</div>
            </a>
            <a href="indent.html?id=0" class="fukuan">
                <div class="one">
                    <i class="iconfont icon-quanbudingdan"></i>
                </div>
                <div class="daifukuan">全部订单</div>
            </a>

        </div>
        <!-- 付款 -->
        <!-- 功能 -->
        <a href="coupons.html" class="youhuiquan">
            <div class="icon">
                <i class="iconfont icon-youhuiquan"></i>
            </div>
            <div class="wenzi">我的优惠券</div>
        </a>
        <a href="address.html" class="youhuiquan">
            <div class="icon">
                <i class="iconfont icon-dizhi"></i>
            </div>
            <div class="wenzi">收获地址</div>
        </a>
        <a href="customer.html" class="youhuiquan">
            <div class="icon">
                <i class="iconfont icon-shouhoufuwu"></i>
            </div>
            <div class="wenzi">售后服务</div>
        </a>
        <!-- 功能 -->
        <!-- 退出登录 -->
        <router-link :to="{name:'login'}">
            <div class="tuichudenglu">退出登录</div>
        </router-link>
        <!--底部-->
        <apple-footer :as="4"></apple-footer>
    </div>
</template>

<script>
    import {SUCCESS, FAIL} from "../../config/base";
    import {getinfo} from "../../api/users";
    import {Toast} from "vant";
    import AppleFooter from "../../components/apple-footer/Apple-footer";

    export default {
        name: "self",
        components:{
            AppleFooter
        },
        info: null,
        methods: {
            //获取个人信息
            setInfo() {
                getinfo('/api/users/31').then(res => {
                    if (res.data.code == SUCCESS) {
                        this.info=res.data.data;
                        Toast(res.data.msg);
                    }
                    else if (res.data.code==FAIL) {
                        Toast(res.data.msg);
                    }
                })
            }
        },
        beforeMount() {
          this.setInfo();
        }
    }
</script>

<style scoped>
    .box {
        width: 100%;
        height: 13.34rem;
        background-color: rgb(236, 236, 235);
    }

    .personal-top {
        width: 100%;
        height: 2.6rem;
        background-color: aquamarine;
        background-image: url(../content/images/person-banner.jpg);
        background-size: cover;
    }

    .top-box {
        position: absolute;
        top: 0;
        left: 0;
        width: 94%;
        height: 2.6rem;
        padding: 0 3%;

    }

    .touxiang {
        width: 1.4rem;
        height: 1.4rem;
        border-radius: 50%;
        float: left;
        border: 1px solid #D7D1D1;
        margin-top: 0.6rem;
        overflow: hidden;
    }

    .touxiang img {
        width: 100%;
        height: 100%;
    }

    .top-wenzi {
        width: 5.44rem;
        height: 0.2rem;
        /* background-color: aquamarine; */
        margin-top: 1.2rem;
        margin-left: 1.6rem;
    }

    .wenzi {
        width: 75%;
        float: left;
        height: 0.5rem;
        line-height: 0.5rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #fff;
        font-size: 0.32rem;

    }

    .person {
        width: 100%;
        height: 0.92rem;
        padding: 0.3rem 0;
        margin: 0.1rem 0;
        background-color: white;
        display: flex;
        justify-content: space-between;
    }

    .fukuan {
        width: 1.5rem;
        height: 0.92rem;
        float: left;
    }

    .one {
        width: 0.46rem;
        height: 0.46rem;
        margin: 0 auto;
    }

    .one i {
        font-size: 0.5rem;
        color: rgb(12, 12, 12);
        text-align: center;
    }

    .daifukuan {
        width: 100%;
        height: 0.38rem;
        margin: auto;
        margin-top: 0.03rem;
        font-size: 0.28rem;
        text-align: center;
    }

    .youhuiquan {
        width: 94%;
        height: 0.9rem;
        padding: 0 3%;
        float: left;
        margin-bottom: 0.02rem;
        background-color: white;
    }

    .icon i {
        font-size: 0.4rem;
        color: black;
        float: left;
        margin-top: 0.22rem;
        margin-right: 0.2rem;
    }

    .wenzi {

        font-size: 0.3rem;
        color: #797778;
        margin-top: 0.28rem;

    }

    .tuichudenglu {
        width: 6.7rem;
        height: 0.8rem;
        float: left;
        background-color: white;
        margin-top: 0.2rem;
        margin-left: 0.35rem;
        margin-right: 0.02rem;
        border: 1px solid #E6E6E6;
        border-radius: 0.1rem;
        text-align: center;
        line-height: 0.8rem;
    }
</style>