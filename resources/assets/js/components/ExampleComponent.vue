<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>

                <el-button @click="visible = true">Button</el-button>
                <el-dialog :visible.sync="visible" title="Hello world">
                    <p>Try Element</p>
                </el-dialog>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return { visible: false }
        }
    }
</script>
