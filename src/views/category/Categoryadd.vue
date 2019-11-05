<template>
    <div>
        <el-form :model="form" ref="form" :rules="rules">
            <el-form-item label="姓名" prop="names">
                <el-input v-model="form.names" clearable prefix-icon="el-icon-user"></el-input>
            </el-form-item>
            <el-form-item label="密码" prop="password">
                <el-input v-model="form.password" clearable prefix-icon="el-icon-lock"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button @click="submitForm">提交</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
    export default {
        name: "Manageradd",
        data: function () {
            return {
                form: {
                    id: '',
                    names: '',
                    password: ''
                },
                rules: {
                   names: [
                        {required: true, message: '请输入用户名', trigger: 'blur'},
                        {min: 2, max: 10, message: '长度在 2到 10 个字符', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: '请输入密码', trigger: 'blur'}
                    ]
                }
            }
        },
        methods: {
            submitForm(){
                this.$refs.form.validate((valid)=>{
                    // console.log(this.$refs.form);
                    if(valid){
                        this.form.id=Date.now();   //时间戳动态生成id
                        // let qs=this.form;
                        //将表单中的数据存到本地
                        localStorage.fs=JSON.stringify(this.form);
                    }
                })
            }
        }
    }
</script>

<style scoped>
    .el-form {
        width: 100px;
    }
    .el-form-item{
        width:200px;
    }
</style>