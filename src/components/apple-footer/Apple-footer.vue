<template>
    <!--底部-->
    <div class="kaola-bottom">
        <a href="index.html" class="kaola-bottom-box1">
            <span class="kaola-bottom-img1 as">  <i class="iconfont icon-shouye" style="font-weight: bolder"></i> </span>
            <span class="kaola-bottom-text1 as" :class="{ 'as':this.active==1}">首页</span>
        </a>
        <a  class="kaola-bottom-box1">
           <router-link to="/category">
            <span class="kaola-bottom-img1">  <i class="iconfont icon-iconfontsousuo1" ></i> </span>
            <span class="kaola-bottom-text1" :class="{ 'as':this.active==2}">分类</span>
           </router-link>
        </a>
        <a href="shop.html" class="kaola-bottom-box1">
            <span class="kaola-bottom-img1">  <i class="iconfont icon-gouwuche" style="font-weight: bolder"></i> </span>
            <span class="kaola-bottom-text1 " :class="{ 'as':this.active==3}">购物车</span>
        </a>
        <a href="personal.html" class="kaola-bottom-box1">
            <span class="kaola-bottom-img1">  <i class="iconfont icon-yonghu" style="font-weight: 200"></i> </span>
            <span class="kaola-bottom-text1" :class="{ 'as':this.active==4}">我的</span>
        </a>


    </div>
</template>

<script>
    export default {
        name: "Apple-footer",
        props:{
            active:{
                type:Number,
                default:1
            }
        }
    }
</script>

<style scoped>
    /* 底部 */

    .kaola-bottom {
        width: 100%;
        position: fixed;
        bottom: 0;
        left: 0;
        z-index: 99;
        height: 1rem;
        background: #FFF;
        border-top: .02rem solid #DCDCDC;
    }

    .kaola-bottom-box1 {
        width: 25%;
        height: 50px;
        float: left;
        text-align: center;
    }

    .kaola-bottom-img1 {
        width: .42rem;
        height: .42rem;
        display: inline-block;
        margin-top: .1rem;
    }

    .kaola-bottom-img1 i {
        font-size: .42rem;
        display: block;
        float: left;
    }

    .kaola-bottom-text1 {
        width: 100%;
        float: left;
        font-size: .26rem;
        color: black;
    }

    .text2 {
        color: #FF9201;
    }

    .as {
        color: #FF9201;
    }
</style>