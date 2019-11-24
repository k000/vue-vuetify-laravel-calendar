<template>
    <div id="load-content" v-if="this.$store.state.isLoading">
        <v-progress-circular
        indeterminate
        color="green"
        class="content"
        ></v-progress-circular>
    </div>
</template>


<style>

    #load-content{
        width:100%;
        height:100vh;
        position: fixed;
        top:0;
        left:0;
        background:rgba(0,0,0,.7);
        z-index:9999;
        display: flex;
    }

    #load-content .content{
        margin:auto auto;
    }

</style>

<script>
    export default {

        data(){
            return {
                loading:false
            }
        },

        methods:{

            getLoadingState(){
                return this.loading
            },
            startLoading(){
                this.loading = true
            },
            endLoading(){
                this.loading = false
            }
        },

    }
</script>
