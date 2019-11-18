<template>
    <div>
        <h3>这是demo1</h3>
        {{$store.state.name}}
        {{this.names}}
        <van-button type="primary"></van-button>
    </div>
</template>

<script>
    export default {
        name: "demo1",
        data() {
            return {
                names: this.$store.state.name,
            }
        },
        methods:{
            // fn(){
            //     return this.$store.commit('toggle');
            // }
        }
    }
</script>

<style scoped>
    button {
        width: 100%;
        height: 0.8rem;
        font-size: 0.8rem;
    }
</style>