<template>
    <el-dialog
            class="import-phone-dialog"
            title="导入"
            :visible.sync="showImportDialog"
            width="400px"
            :before-close="handleClose">
        <form id="import-phone" action="/excel/import" method='post' enctype="multipart/form-data">
            <input id="file" type="file" class="el-button el-button--info" name="file"/>
            <input v-model="csrfToken" name="_token" type="hidden">
            <a href="/excel/export/template" class="el-button el-button--default">下载导入模板</a>
            <span slot="footer" class="dialog-footer">
                <el-button @click="cancelImport">取 消</el-button>
                <el-button type="primary" @click="confirmAdd">确 定</el-button>
            </span>
        </form>
    </el-dialog>
</template>

<style>
    .import-phone-dialog #file {
        margin-bottom: 40px;
    }

    .import-phone-dialog .el-dialog__body {
        padding-bottom: 20px;
    }

    .import-phone-dialog span.dialog-footer {
        display: block;
        text-align: right;
    }
</style>

<script>
    export default {
        props  : ['showImportDialog'],
        data() {
            return {
                csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods: {
            hideImportDialog(data) {
                this.$emit('hideImportDialog', data)
            },
            handleClose() {
                this.hideImportDialog();
            },
            downloadTemplate() {

            },
            cancelImport() {
                this.hideImportDialog();
            },
            confirmAdd() {
                $('#import-phone').submit();
                this.hideImportDialog();
            }
        }
    }
</script>
