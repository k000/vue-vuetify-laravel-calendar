<template>
    <div id="alert-component" transition="slide-x-transition">
        <v-alert
        dismissible
        type="error"
        v-model="isActive"
        
        >
        <v-row align="center">
            <v-col class="grow">
                <slot name="text">既に登録データがあるため、新規登録ができません</slot>
            </v-col>
        </v-row>
        </v-alert>
    </div>
  
</template>

<script>
    export default {

        data(){
            return {
                /**
                 * アラートを出したいときにtureにする
                 */
                isActive:false
            }
        },

        mounted() {
            
        },

        methods:{
            onActive(){
                this.isActive = true
                setTimeout( () => {
                    this.isActive = false
                },4000)
            },
            getState(){
                return this.isActive
            },
           
        }

    }
</script>
