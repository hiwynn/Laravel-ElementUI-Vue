<template>
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
                width="180">
        </el-table-column>
        <el-table-column
                prop="phone_number"
                label="号码">
        </el-table-column>
    </el-table>
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
        props: ['phone'],
        mounted() {
            console.log(this.phone);
        }
    }
</script>
