<template>
    <el-dialog
            class="add-phone-dialog"
            title="添加"
            :visible.sync="showAddDialog"
            width="400px"
            :before-close="handleClose">
        <el-alert
                v-if="repeatNumber"
                title="该号码已存在"
                type="error">
        </el-alert>
        <el-alert
                v-if="repeatTitle"
                title="该名称已存在"
                type="error">
        </el-alert>
        <el-form :model="addForm">
            <el-form-item label="名称">
                <el-input v-model="addForm.title" placeholder="名称"></el-input>
            </el-form-item>
            <el-form-item label="号码">
                <el-input v-model="addForm.number" placeholder="号码"></el-input>
            </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="cancelAdd">取 消</el-button>
            <el-button type="primary" @click="confirmAdd"
                       v-bind:disabled="addForm.title === '' || addForm.number === ''">确 定</el-button>
        </span>
    </el-dialog>
</template>

<style>
    .add-phone-dialog .el-dialog__body {
        padding: 30px 60px;
    }

    .add-phone-dialog .el-dialog__body .el-alert {
        margin-bottom: 20px;
    }

    .add-phone-dialog .el-input {
        width: 220px;
    }

</style>

<script>
    export default {
        props  : ['showAddDialog', 'tableData', 'currentPhone'],
        data() {
            return {
                addForm     : {
                    title : '',
                    number: ''
                },
                repeatNumber: false,
                repeatTitle : false
            }
        },
        watch  : {
            currentPhone: function (val, oldVal) {
                this.addForm.title = this.currentPhone.title;
                this.addForm.number = this.currentPhone.phone_number
            }
        },
        methods: {
            handleClose(done) {
                this.$confirm('确认关闭？')
                    .then(_ => {
                        this.hideAddDialog();
                    })
                    .catch(_ => {
                    });
            },
            hideAddDialog(data) {
                if (!this.currentPhone) {
                    this.addForm.title = '';
                    this.addForm.number = '';
                } else {
                    this.addForm.title = this.currentPhone.title;
                    this.addForm.number = this.currentPhone.phone_number;
                }
                this.repeatNumber = false;
                this.repeatTitle = false;
                this.$emit('hideAddDialog', data)
            },
            cancelAdd() {
                this.hideAddDialog();
            },
            confirmAdd() {
                let _this = this;
                if (this.currentPhone) {
                    for (var i = 0; i < this.tableData.length; i++) {
                        if (this.tableData[i].phone_number == this.addForm.number && this.tableData[i].id != this.currentPhone.id) {
                            this.repeatNumber = true;
                            return;
                        } else {
                            this.repeatNumber = false;
                        }
                        if (this.tableData[i].title == this.addForm.title && this.tableData[i].id != this.currentPhone.id) {
                            this.repeatTitle = true;
                            return;
                        } else {
                            this.repeatTitle = false;
                        }
                    }
                    axios.post('/api/phone/update/' + this.currentPhone.id, {
                        title : this.addForm.title,
                        number: this.addForm.number
                    }).then(function (res) {
                        _this.hideAddDialog(res.data);
                        _this.$message({
                            type   : 'success',
                            message: '修改成功!'
                        });
                    })
                } else {
                    for (var i = 0; i < this.tableData.length; i++) {
                        if (this.tableData[i].phone_number == this.addForm.number) {
                            this.repeatNumber = true;
                            return;
                        } else {
                            this.repeatNumber = false;
                        }
                        if (this.tableData[i].title == this.addForm.title) {
                            this.repeatTitle = true;
                            return;
                        } else {
                            this.repeatTitle = false;
                        }
                    }
                    axios.post('/api/phone/add', {
                        title : this.addForm.title,
                        number: this.addForm.number
                    }).then(function (res) {
                        _this.hideAddDialog(res.data);
                        _this.$message({
                            type   : 'success',
                            message: '添加成功!'
                        });
                    });
                }
            }
        }
    }
</script>
