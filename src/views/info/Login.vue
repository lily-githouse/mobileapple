<template>
    <van-cell-group>
        <van-field v-model="form.username"
                   label="用户名"
                   placeholder="请输入用户名"
                   class="username">
        </van-field>
        <van-field
                v-model="form.password"
                type="password"
                label="密码"
                placeholder="请输入密码"
                class="username">
        </van-field>
        <van-field class="button">
            <van-button slot="button" size="small" type="warning" @click="handlerLogin">登录</van-button>
            <router-link slot="button" size="small" type="danger" tag="van-button" :to="{name:'register'}">注册
            </router-link>
        </van-field>
    </van-cell-group>
</template>

<script>
    import {SUCCESS} from "../../config/base";
    import {login} from "../../api/users";
    import Vue from 'vue';
    import {Toast} from "vant";
    Vue.use(Toast);
    export default {
        name: "Login",
        data() {
            return {
                form: {
                    username: '',
                    password: ''
                }
            }
        },
        methods: {
            handlerLogin() {
                login('/api/login',this.form).then(res => {
                    if(res.data.code==SUCCESS){
                        // console.log(this); vue
                        let names=this.$route.query.redirect||'index';
                        this.$store.commit('changeToken',res.data.token);
                        //dispatch方法触发actions
                        this.$store.dispatch('setCart');
                        // this.$store.commit('calcTotal');
                        // this.$store.commit('calcPrice');
                        Toast(res.data.msg);
                        this.$router.push({name:names});
                    }
                    else{
                        Toast(res.data.msg);
                    }
                })

            }
        }
    }
</script>

<style scoped>
    .van-cell-group {
        width: 100%;
        height: 3rem;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .button {
        display: flex;
        justify-content: space-between;
    }
</style>