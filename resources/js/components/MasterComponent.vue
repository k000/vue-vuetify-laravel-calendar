<template>
    <div>
        <v-container fluid>
            <v-row align="center" justify="center">
                <v-col cols="10">
                    <template>
                        <div>
                            <h1>筋トレ種目の登録</h1>
                            <p>
                                ここで登録してある種目が筋トレ記録できる種目になります。<br />
                                登録フォーム下に使用可能な筋トレ種目の一覧が表示されています。
                            </p>
                        </div>
                    </template>
                </v-col>
                <v-col cols="10">
                        <v-text-field label="種目名" required hint="筋トレ種目名を入力してください" v-model="master"></v-text-field>
                        <v-btn block color="primary" @click="addMaster">Block Button</v-btn>
                </v-col>

                <v-col cols="11">
                    <v-card>

                        <v-card-title>
                            <v-text-field
                                v-model="search"
                                append-icon="search"
                                label="Search"
                                single-line
                                hide-details
                            ></v-text-field>
                        </v-card-title>

                        <v-data-table
                            :headers="headers"
                            :items="datas"
                            :search="search"
                            no-data-text="種目がありません"
                        >
                        <template v-slot:item.action="{ item }">
                            <v-icon
                                color="red"
                                @click="deleteItem(item)"
                            >
                                delete
                            </v-icon>
                        </template>
                        </v-data-table>

                    </v-card>
                </v-col>

            </v-row>
        </v-container>
    </div>

</template>


<script>

export default {
    data: () => ({
        master:"",
        search: '',
        datas:[
            {
                shumoku:"ベンチプレス"
            }
        ],
        headers:[
            {
                text:"種目名",
                sortable:false,
                value:"shumoku"
            },
            {
                text:"削除",
                sortable:false,
                value:"action"
            }
        ],

    }),

   computed:{
       
   },

   mounted(){

        this.$store.commit('startLoading')

        axios.get('/masters')
        .then( res => {
            this.datas = res.data  
        })
        .catch( e => {
            console.log(e)
        })
        .finally(()=>{
            this.$store.commit('endLoading')
        })
       

   },

   methods:{

       async addMaster(){

            if( this.master == "" )
                return

            this.$store.commit('startLoading')

            const params = {
               event : this.master,
            }


            await axios.post('/master/create',params)
                .then( res => {
                    
                })
                .catch( e => {
                    console.log(e)
                })
                .finally(()=>{
                    this.$store.commit('endLoading')
                })
            
       },

       async deleteItem(item){

           const index = this.datas.indexOf(item)
           if(confirm('該当のレコードを削除します?')){ // && this.datas.splice(index, 1)

            this.$store.commit('startLoading')



            const param = {id:item.id}

                await axios.delete('/master',{data:param})
                .then( res => {
                    
                })
                .catch( e => {
                    console.log(e)
                })
                .finally(()=>{
                    this.$store.commit('endLoading')
                    this.datas.splice(index, 1)
                })

            }

       },


       async getMasterDate(){

            this.$store.commit('startLoading')

            axios.get('/notes')
                .then( res => {
                this.datas = res.data  
            })
                .catch( e => {
                console.log(e)
            })
                .finally(()=>{
                this.$store.commit('endLoading')
            })

       },

   },
   
}
</script>