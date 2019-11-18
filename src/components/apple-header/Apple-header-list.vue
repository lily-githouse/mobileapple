<template>

    <div class="yx-index-top">
        <div class="index-top-box3">
            <a href="javascript:history.back();">
                <i class="iconfont icon-zuoyoujiantou"></i>
            </a>
        </div>
        <div class="index-top-box2">
            <span class="fresh-toptext1"><slot>派送至：北京石景山</slot></span>
            <span class="fresh-topimg1"> <i class=" iconfont icon-shangjiantou1"></i> </span>
        </div>
        <div class="index-top-box1">
            <span class="index-top-img1"> <i class="iconfont icon-iconfontsousuo1"></i> </span>
        </div>
    </div>
    <!-- 顶部标题栏结束 -->
</template>

<script>
    export default {
        name: "Apple-header-list",
        props: {
            isShow: {
                type: Boolean,
                default: false
            }
        }
    }
</script>

<style scoped>

</style>