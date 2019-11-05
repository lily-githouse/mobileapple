<template>
    <div>
        <el-table :data="manager" ref="manager">
            <el-table-column
                    prop="id"
                    label="ID"
                    >
            </el-table-column>
            <el-table-column
                    prop="names"
                    label="姓名"
            >
            </el-table-column>
            <el-table-column
                    prop="password"
                    label="密码"
                    >
            </el-table-column>
            <el-table-column
                    label="操作"
                    >
                <!--                想在单元格内访问到表格数据，用作用域插槽-->
                <template slot-scope="scope">
                    <div>
<!--                        <el-button> <router-link :to="{name:'studentedit', params:{id:scope.row.id}}" tag="el-button">编辑</router-link></el-button>-->
                        <el-button @click="deleteManager(scope.row.id)">删除</el-button>
                    </div>
                </template>
            </el-table-column>
        </el-table>
    </div>
</template>

<script>

    export default {
        name: "Managerquery",
        data() {
            return {
                //管理员数据通过向后台发起请求获得
                manager:[],
            }
        },
        methods: {
            getManager() {          //假设给数据库发送请求，拿回数据
                //将存到本地的数据(JSon格式的字符串)拿出来
                let obj = JSON.parse(localStorage.getItem('fs'));
                this.manager.push(obj);      //本地数据推到manager
            },
            deleteManager(id){
                //删掉数组中相等的id，留下不等的，可以用filter
                this.manager=this.manager.filter(ele=>ele.id!=id);
            }
        },
        //获取最新数据
        mounted() {
            //异步更新
            // window.console.log(this);
            this.getManager();

        }

    }
</script>

<style scoped>

</style>