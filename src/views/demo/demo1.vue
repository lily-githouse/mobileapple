<template>
    <div>
    <h3>这是demo1</h3>
    <van-button type="primary" @click="count++">{{count}}</van-button>
    </div>
</template>

<script>
    export default {
        name: "demo1",
        data(){
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