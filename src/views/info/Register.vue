<template>
    <van-cell-group>
        <van-field v-model="form.username"
                   label="用户名"
                   placeholder="请输入用户名"
                   class="username"
                   clearable>
        </van-field>
        <van-field
                v-model="form.password"
                type="password"
                label="密码"
                placeholder="请输入密码"
                class="username"
                clearable>
        </van-field>
        <van-field
                v-model="form.tel"
                type="text"
                label="手机号"
                placeholder="请输入手机号">
        </van-field>
<!--        <slot>-->
<!--            <van-radio-group slot="van-radio-group" v-model="radio" label="性别">-->
<!--                <van-radio name="1">单选框 1</van-radio>-->
<!--                <van-radio name="2">单选框 2</van-radio>-->
<!--            </van-radio-group>-->
<!--        </slot>-->

        <van-field class="button">
            <van-button slot="button" size="small" type="danger" @click="handlerRegister">注册</van-button>
            >
        </van-field>
    </van-cell-group>
</template>

<script>
    import {SUCCESS} from "../../config/base";
    import {register} from "../../api/users";
    import Vue from 'vue';
    import Toast from "vant";
    Vue.use(Toast);

    export default {
        name: "Login",
        data() {
            return {
                form: {
                    username: '',
                    password: '',
                    tel: ''
                },
                // radio: '1'
            }
        },
        methods: {
            handlerRegister() {
                //保存到数据库
                register('/api/users', this.form).then(res => {
                    if(res.code==SUCCESS){
                        Toast(res.msg);
                    }
                    // this.$router.push({path: '/'});
                });
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