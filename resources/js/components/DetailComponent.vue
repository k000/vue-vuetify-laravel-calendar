<template>

    <v-row justify="center">

        <div class="form-modal">
            <form-component ref="form"></form-component>
        </div>

        <v-dialog v-model="dialog" persistent max-width="600px">
        <v-card>
            <v-card-title>
            
            <span class="headline">{{this.bui}}</span>
            
            <v-spacer></v-spacer>

            <v-btn class="mx-2" fab dark small color="blue-grey" @click="dialog = false">
                <v-icon dark>mdi-close</v-icon>
            </v-btn>

            </v-card-title>

            <v-card-text>
            <v-container>
                <v-row>

                    <v-col cols="12" sm="6" md="6">
                        <p>{{this.place}}</p>
                    </v-col>

                    <v-col cols="12" sm="6" md="6">
                        <p>{{this.day}}</p>
                    </v-col>

                    <!-- 追加したデータはここで表示する -->
                    <v-data-table
                        :headers="headers"
                        :items="tabledatas"
                        no-data-text="トレーニング種目はありません。"
                    >
                    </v-data-table>

                    <v-col cols="12">
                        <p>{{this.memo}}</p>
                    </v-col>
                    

                    <v-col cols="12" sm="12" md="12" :class="`d-flex justify-space-around mb-6`">
  
                        <v-btn class="mx-2" fab dark color="cyan" @click="editData">
                            <v-icon dark>mdi-pencil</v-icon>
                        </v-btn>


                        
                        <v-btn class="mx-2" fab dark color="pink" @click="deleteData">
                            <v-icon red>mdi-delete-forever</v-icon>
                        </v-btn>

                    </v-col>

                </v-row>
            </v-container>
            </v-card-text>
        </v-card>

        </v-dialog>
  </v-row>
            
  
</template>

<script>
    export default {

        data(){
            return {
                bui:"",
                day:"",
                place:"",
                memo:"",
                dialog: false,
                datas:[],
                tabledatas:[],
                headers:[
                    {
                        text:'種目名',
                        sortable:false,
                        value:'shumoku'
                    },
                    {
                        text:'重量',
                        sortable:false,
                        value:'weight'  
                    },
                    {
                        text:'レップ数',
                        sortable:false,
                        value:'rep'
                    },
                    {
                        text:'セット数',
                        sortable:false,
                        value:'set'
                    },
                ],
            }
        },

        mounted() {
            
        },

        methods:{
            open(){
                this.datas.length = 0
                this.tabledatas.length = 0
                this.dialog = true
            },

            setData(obj){
                this.datas = obj
                this.correctData(this.datas)
            },

            correctData(obj){
                obj.datas.forEach((v) => {
                    this.tabledatas.push(v)
                })
                this.bui = obj.bui
                this.day = obj.day
                this.place = obj.place
                this.memo = obj.memo
            },

            async deleteData(){

                if(!confirm('データを削除しますか？'))
                    return

                this.$store.commit('startLoading')

                const param = {id:this.datas.id}

                await axios.delete('/delete',{data:param})
                .then( res => {
                    
                })
                .catch( e => {
                    console.log(e)
                })
                .finally(()=>{
                    this.$store.commit('endLoading')
                    this.dialog = false
                })


            },


            editData(){
                this.$refs.form.openInEditMode(this.datas)
            },

            onActive(){
               
            },
            getState(){
                
            },
           
        }

    }
</script>
