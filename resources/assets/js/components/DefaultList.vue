<template>
    <div>
        <el-table
                :data="phone"
                border
                style="width: 100%">
            <el-table-column type="expand">
                <template slot-scope="props">
                    <el-form label-position="left" inline class="demo-table-expand">
                        <el-form-item label="名称">
                            <span>{{ props.row.title }}</span>
                        </el-form-item>
                        <el-form-item label="号码">
                            <span>{{ props.row.phone_number }}</span>
                        </el-form-item>
                        <el-form-item label="创建时间">
                            <span>{{ props.row.created_at }}</span>
                        </el-form-item>
                        <el-form-item label="更新时间">
                            <span>{{ props.row.updated_at }}</span>
                        </el-form-item>
                        <el-form-item label="创建者">
                            <span>{{ props.row.added_by }}</span>
                        </el-form-item>
                        <el-form-item label="更新者">
                            <span>{{ props.row.updated_by }}</span>
                        </el-form-item>
                    </el-form>
                </template>
            </el-table-column>
            <el-table-column
                    prop="title"
                    label="名称"
                    width="230">
            </el-table-column>
            <el-table-column
                    prop="phone_number"
                    label="号码">
            </el-table-column>
            <el-table-column
                    v-if="cudPermisson"
                    label="操作"
                    width="160">
                <template slot-scope="scope">
                    <el-button
                            size="mini"
                            @click="editPhone(scope.$index, scope.row)">编辑
                    </el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="deletePhone(scope.$index, scope.row)">删除
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
        <add-dialog v-bind:showAddDialog="showAddDialog"
                    v-bind:tableData="phone"
                    v-bind:currentPhone="currentPhone"
                    @hideAddDialog="hideAddDialog"></add-dialog>
    </div>
</template>

<style>
    .demo-table-expand {
        font-size: 0;
    }

    .demo-table-expand label {
        width: 90px;
        color: #99a9bf;
    }

    .demo-table-expand .el-form-item {
        margin-right: 0;
        margin-bottom: 0;
        width: 50%;
        text-align: left;
    }
</style>

<script>
    export default {
        props  : ['phone', 'cudPermisson'],
        data() {
            return {
                showAddDialog: false,
                currentPhone : {},
                editIndex    : 0
            }
        },
        mounted() {
//            this.tableData = this.phone;
        },
        methods: {
            editPhone(index, row) {
                this.showAddDialog = true;
                this.currentPhone = row;
                this.editIndex = index;
            },
            deletePhone(index, row) {
                this.$confirm('此操作将永久删除该号码, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText : '取消',
                    type             : 'warning'
                }).then(() => {
                    let _this = this;
                    axios.post('/api/phone/delete/' + row.id).then(function () {
                        _this.phone.splice(index, 1);
                        _this.$message({
                            type   : 'success',
                            message: '删除成功!'
                        });
                    })
                }).catch(() => {
                    this.$message({
                        type   : 'info',
                        message: '已取消删除'
                    });
                });
            },
            hideAddDialog(data) {
                this.showAddDialog = false;
                if (data) {
                    console.log(data);
                    this.phone.splice(this.editIndex, 1, data);
                }
            }
        }
    }
</script>
