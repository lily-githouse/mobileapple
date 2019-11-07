<template>
    <div>
        <!-- 顶部标题栏开始 -->
        <div class="special-title">
            <router-link :to="{name:'index'}">
                <i class="iconfont icon-zuoyoujiantou"></i>
            </router-link>
            <span>{{cate.cname}}</span>
        </div>
        <div class="box"></div>
    </div>
    <!-- 顶部标题栏结束 -->
</template>

<script>
    export default {
        name: "Apple-header-list",
        props:{
            isShow:{
                type:Boolean,
                default:false
            }
        }
    }
</script>

<style scoped>

</style>