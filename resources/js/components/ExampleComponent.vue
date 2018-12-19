<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <h1>{{msg}}</h1>
                        <input type="text" :value="msg" @input="changeMessage">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data () {
            return {
                msg: '',
            }            
        },
        methods: {
            changeMessage(e) {
                this.msg = e.target.value;
            }
        }
    }
</script>
