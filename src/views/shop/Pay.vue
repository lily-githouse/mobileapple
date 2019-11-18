<template>
    <!--    头部-->
    <div class="box">
        <!-- 密码输入框 -->
        <van-password-input
                :value="value"
                info="密码为 6 位数字"
                :focused="showKeyboard"
                @focus="showKeyboard = true"
        />

        <!-- 数字键盘 -->
        <van-number-keyboard
                :show="showKeyboard"
                @input="onInput"
                @delete="onDelete"
                @blur="showKeyboard = false"
        />
    </div>
</template>

<script>
    import {payOrders} from "../../api/orders";

    export default {
        name: "Pay",
        data() {
            return {
                value: '123',
                showKeyboard: true
            }
        },
        methods: {
            onInput(key) {
                this.value = (this.value + key).slice(0, 6);
            },
            onDelete() {
                this.value = this.value.slice(0, this.value.length - 1);
            },
            //付款
            payOrder() {
                //支付成功订单状态改为1
                let {ordernum} = this.$route.query;
                payOrders('/api/orders/' + ordernum, {'status': 1})

            }
        },
        watch: {
            value() {
                if (this.value == '123456') {
                    this.payOrder();
                }
            }
        }
    }
</script>

<style scoped>
    .box {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        background-color: #dfdfdf;
    }
</style>