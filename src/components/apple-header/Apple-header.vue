<template>
    <div class="main">
        <link rel="stylesheet" href="http://at.alicdn.com/t/font_1396400_pipc8gjmfjl.css">
        <!-- 头部开始 -->
        <div class="index-top">
            <div class="index-top-left">
                <i class="iconfont icon-dingwei"></i>
                <span>地址</span>
            </div>
            <div class="index-top-middle">
                <span>北京石景山</span>
                <i class="iconfont icon-shangjiantou1"></i>
            </div>
            <div class="index-top-left">
                <a href="./search.html" class="search">
                    <i class="iconfont icon-iconfontsousuo1"></i>
                    <span>搜索</span>
                </a>
            </div>
        </div>
        <div class="index-top-blank"></div>
        <!-- 头部结束-->
    </div>
</template>

<script>

    export default {
        name: "Apple-header"
    }
</script>

<style scoped>
    .main {
        width: 100%;
        height: 100%;
    }
    /* 头部开始 */

    .index-top-blank {
        height: 1.3rem;
    }

    .main .index-top {
        position: fixed;
        z-index: 2;
        padding: 0.24rem 0;
        width: 100%;
        height: 1.3rem;
        background-color: #fff;
        border-bottom: 0.02rem solid #f1f1f1;
        box-sizing: border-box;
        display: flex;
        justify-content: space-between;
    }

    .main .index-top .index-top-left {
        width: 17%;
        text-align: center;
    }

    .index-top-left .iconfont {
        display: block;
        margin: 0 auto;
        width: 0.4rem;
        height: 0.4rem;
    }

    .index-top-left span {
        font-size: 0.24rem;
        color: #A8A3A7;
    }

    .main .index-top .index-top-middle {
        width: 66%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .index-top-midddle span {
        font-size: 0.32rem;
    }

    .index-top-middle .iconfont {
        display: block;
        margin-left: 0.1rem;
        width: 0.24rem;
        color: rgba(0, 0, 0, 0.5);
    }
</style>