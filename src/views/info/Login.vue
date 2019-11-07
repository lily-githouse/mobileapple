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
                error-message="密码错误"
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
    import Toast from "vant";
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
                    if(res.code==SUCCESS){
                        Toast(res.msg);
                    }
                })
                // this.$router.push({path:'/'});
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
        background-color: red;
    }

    .button {
        display: flex;
        justify-content: space-between;
    }
</style>