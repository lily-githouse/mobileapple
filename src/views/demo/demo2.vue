<template>
    <div>
    <h3>这是demo2</h3>
    <van-button type="info" @click="count++">{{count}}</van-button>
    </div>
</template>

<script>
    export default {
        name: "demo2",  data(){
            return{
                count:1
            }
        }
    }
</script>

<style scoped>
    button{
        width:100%;
        height:0.8rem;
        font-size: 0.8rem;
    }
</style>