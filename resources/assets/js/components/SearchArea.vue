<template>
    <div>
        <el-form :inline="true" :model="formInline" class="demo-form-inline">
            <el-form-item label="名称">
                <el-input v-model="formInline.title" placeholder="名称"></el-input>
            </el-form-item>
            <el-form-item label="号码">
                <el-input v-model="formInline.number" placeholder="号码"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">查询</el-button>
            </el-form-item>
        </el-form>
        <h4 v-if="hasResult && init">搜索结果：</h4>
        <default-list v-if="hasResult || !init" v-bind:phone="tableData"></default-list>
        <div v-if="!hasResult && init">
            暂无查询结果
        </div>
    </div>
</template>
<script>
    export default {
        props  : ['phone'],
        data() {
            return {
                formInline  : {
                    user  : '',
                    number: ''
                },
                searchResult: [],
                hasResult   : false,
                init        : false,
                tableData   : JSON.parse(this.phone)
            }
        },
        methods: {
            onSubmit() {
                let _this = this;
                _this.init = true;
                axios.post('/api/phone/search', {
                    title : this.formInline.title,
                    number: this.formInline.number
                }).then(function (res) {
                    _this.tableData = res.data;
                    _this.hasResult = _this.tableData.length;
                })
            }
        }
    }
</script>