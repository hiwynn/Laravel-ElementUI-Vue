<template>
    <div>
        <el-form :inline="true" :model="formInline" class="demo-form-inline">
            <el-form-item label="名称">
                <el-input v-model="formInline.title" clearable placeholder="名称"></el-input>
            </el-form-item>
            <el-form-item label="号码">
                <el-input v-model="formInline.number" clearable placeholder="号码"></el-input>
            </el-form-item>
            <el-form-item v-if="cudPermisson">
                <el-button type="success" @click="addPhone">添加</el-button>
                <a href="/excel/export" class="el-button el-button--info">导出</a>
                <el-button type="info" @click="importPhone">导入</el-button>
                <import-dialog v-bind:showImportDialog="showImportDialog"
                               @hideImportDialog="hideImportDialog"></import-dialog>
            </el-form-item>
        </el-form>
        <add-dialog v-bind:showAddDialog="showAddDialog" v-bind:tableData="tableData"
                    @hideAddDialog="hideAddDialog"></add-dialog>
        <default-list v-if="hasResult || !init"
                      v-bind:cudPermisson="cudPermisson"
                      v-bind:phone="filterResult.slice((currentPage-1)*pageSize,currentPage*pageSize)"></default-list>
        <div style="text-align: center; margin-top: 20px;">
            <el-pagination
                    layout="prev, pager, next"
                    :total="amount"
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page="currentPage"
                    :page-sizes="[10, 20, 30, 40]"
                    :page-size="pageSize">
            </el-pagination>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['phone'],
        mounted() {
            let _this = this;
            axios.get('/api/user').then(function (res) {
                _this.currentUser = res.data;
                if (_this.currentUser.roleId == 3) {
                    _this.cudPermisson = false;
                }
            })
        },
        data() {
            return {
                formInline: {
                    title: '',
                    number: ''
                },
                hasResult: false,
                init: false,
                tableData: JSON.parse(this.phone),
                filterResult: JSON.parse(this.phone),
                amount: JSON.parse(this.phone).length,
                currentPage: 1,
                pageSize: 10,
                showAddDialog: false,
                showImportDialog: false,
                currentUser: {},
                cudPermisson: true
            }
        },
        watch: {
            formInline: {
                handler: function (newVal) {
                    this.currentPage = 1;
                    this.filterResult = this.tableData.filter(function (item) {
                        if (newVal.title == "") {
                            if (newVal.number == "") {
                                return true;
                            }
                            if (item.phone_number.indexOf(newVal.number) > -1) {
                                return true;
                            }
                        }
                        if (newVal.number == "") {
                            if (newVal.title == "") {
                                return true;
                            }
                            if (item.title.indexOf(newVal.title) > -1) {
                                return true;
                            }
                        }
                    });
                    this.amount = this.filterResult.length;
                },
                deep: true
            }
        },
        methods: {
            addPhone() {
                this.showAddDialog = true;
            },
            hideAddDialog(data) {
                if (data) {
                    this.tableData.push(data);
                }
                this.showAddDialog = false;
            },
            hideImportDialog() {
                this.showImportDialog = false;
            },
            handleSizeChange(size) {
                console.log(size);
            },
            handleCurrentChange(page) {
                this.currentPage = page;
            },
            importPhone() {
                this.showImportDialog = true;
            }
        }
    }
</script>