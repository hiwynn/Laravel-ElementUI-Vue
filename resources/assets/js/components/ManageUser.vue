<template>
    <el-table
            :data="allUsers"
            stripe
            border
            style="width: 100%">
        <el-table-column
                prop="id"
                label="ID"
                width="50">
        </el-table-column>
        <el-table-column
                prop="name"
                label="姓名"
                width="140">
        </el-table-column>
        <el-table-column
                prop="email"
                label="邮箱"
                width="240">
        </el-table-column>
        <el-table-column label="角色" width="100">
            <template slot-scope="scope">
                {{ displayRole(scope.row) }}
            </template>
        </el-table-column>
        <el-table-column
                prop="roleId"
                label="更换角色">
            <template slot-scope="scope">
                <el-button
                        size="mini"
                        type="primary"
                        v-if="scope.row.roleId == 3"
                        @click="changeToAdmin(scope.row)">切换为管理员
                </el-button>
                <el-button
                        size="mini"
                        type="success"
                        v-if="scope.row.roleId == 2"
                        @click="changeToUser(scope.row)">切换为用户
                </el-button>
            </template>
        </el-table-column>
        <el-table-column label="状态" width="80">
            <template slot-scope="scope">
                {{ displayStatus(scope.row) }}
            </template>
        </el-table-column>
        <el-table-column label="操作" width="120">
            <template slot-scope="scope">
                <el-button
                        size="mini"
                        type="warning"
                        v-if="!scope.row.is_active && scope.row.roleId > 1"
                        @click="activateUser(scope.row)">激活
                </el-button>
                <el-button
                        size="mini"
                        type="info"
                        v-if="scope.row.is_active && scope.row.roleId > 1"
                        @click="disabledUser(scope.row)">禁用
                </el-button>
            </template>
        </el-table-column>
        <el-table-column label="操作">
            <template slot-scope="scope" width="160">
                <el-button
                        size="mini"
                        @click="editUser(scope.row)">编辑
                </el-button>
                <el-button
                        size="mini"
                        type="danger"
                        @click="deleteUser(scope.row)">删除
                </el-button>
            </template>
        </el-table-column>
    </el-table>
</template>

<script>
    export default {
        name: "ManageUser",
        mounted() {
            let _this = this;
            axios.get('/api/users').then(function (res) {
                console.log(res);
                _this.allUsers = res.data;
            })
        },
        data() {
            return {
                allUsers: []
            }
        },
        methods: {
            displayStatus(row) {
                return row.is_active ? '已激活' : '未激活';
            },
            displayRole(row) {
                let roleId = row.roleId;
                let role = '';
                switch (roleId) {
                    case 1:
                        role = '超级管理员';
                        break;
                    case 2:
                        role = '管理员';
                        break;
                    case 3:
                        role = '用户';
                        break;
                }
                return role;
            },
            activateUser(row) {
                axios.post('/api/activate/' + row.id).then(function () {
                    row.is_active = 1;
                })
            },
            disabledUser(row) {
                axios.post('/api/disabled/' + row.id).then(function () {
                    row.is_active = 0;
                })
            },
            changeToAdmin(row) {
                axios.post('/api/role/admin/' + row.id).then(function () {
                    row.roleId = 2;
                })
            },
            changeToUser(row) {
                axios.post('/api/role/user/' + row.id).then(function () {
                    row.roleId = 3;
                })
            },
            editUser(row) {
                alert("to do edit " + row.name);
            },
            deleteUser(row) {
                alert("to do delete " + row.name);
            }
        }
    }
</script>

<style scoped>

</style>