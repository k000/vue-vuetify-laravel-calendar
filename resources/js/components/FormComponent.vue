<template>

    <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">

      <v-card>
        <v-card-title>
          
          <span class="headline">{{ getChoiceDay }}</span>
          
          <v-spacer></v-spacer>

            <v-btn class="mx-2" fab dark small color="blue-grey" @click="dialog = false">
                <v-icon dark>mdi-close</v-icon>
            </v-btn>

        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
            <!-- 種目イベント -->
            <v-col cols="12" sm="6" md="6">
                <v-text-field label="部位" required hint="カレンダーのタイトルになります。" v-model="bui"></v-text-field>
            </v-col>
            <!-- 場所 -->
            <v-col cols="12" sm="6" md="6">
                <v-text-field label="場所" required hint="トレーニングをした場所を記載できます。" v-model="place"></v-text-field>
            </v-col>

            <!-- 可変フォーム -->
            <v-row id="kahen-outer" ref="kahenouter">
                <v-row id="kahen-form" data-num="1">

                    <v-col cols="12" sm="12" md="12">
                        <v-autocomplete
                            :items="master"
                            label="トレーニング種目"
                            v-model="shumoku"
                            required
                        ></v-autocomplete>
                    </v-col>

                    <!-- 重量 -->
                    <v-col cols="4" sm="4" md="4">
                        <v-text-field label="重量"  type="number" name="weight[]" required v-model="weight"></v-text-field>
                    </v-col>
                    <!-- レップ数 -->
                    <v-col cols="4" sm="4" md="4">
                        <v-text-field label="レップ数" type="number" name="rep[]" required v-model="rep"></v-text-field>
                    </v-col>
                    <!-- セット数 -->
                    <v-col cols="4" sm="4" md="4">
                        <v-text-field label="セット数" type="number" name="set[]" required v-model="set"></v-text-field>
                    </v-col>

                </v-row>
            </v-row>

            <v-col cols="6" sm="6" md="6">
                <v-btn class="mx-2" small fab dark color="indigo" @click="add_data">  
                    <v-icon dark>mdi-plus</v-icon>
                </v-btn>
            </v-col>

            <!-- 追加したデータはここで表示する -->
            <v-data-table
                :headers="headers"
                :items="datas"
                no-data-text="トレーニング種目を登録してください"
            >
            <!-- slotでactionのitemに流し込む -->
            <template v-slot:item.action="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="editItem(item)"
                >
                    edit
                </v-icon>
                <v-icon
                    small
                    @click="deleteItem(item)"
                >
                    delete
                </v-icon>
                </template>
            </v-data-table>
            

            <!-- 1段 -->
            <v-col cols="12">
                <v-textarea
                name="bikou"
                filled
                label="トレーニングメモ"
                auto-grow
                v-model="memo"
                required
                ></v-textarea>
            </v-col>


            <!-- 2段 -->
            <v-col cols="8" sm="6" md="6">
                <v-btn rounded color="primary" @click="storeData">Save</v-btn>
            </v-col>

            </v-row>
          </v-container>
        </v-card-text>

      </v-card>
    </v-dialog>
  </v-row>
            
</template>



<script>

import { mapGetters } from "vuex";


export default {
 
    data: () => ({
    CreateMode:true,
      id:"",
      dialog: false,
      master:["ベンチプレス","スクワット"],
      memo:"",
      place:"",
      bui:"",
      shumoku:"",
      weight:0,
      rep:0,
      set:0,
      datas:[],//ここはaxiosでデータを取得します。
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
          { 
              text: '削除', 
              value: 'action', 
              sortable: false 
          },
      ],
    }),

   computed:{
       ...mapGetters(['getChoiceDay'])
   },

   methods:{
       open(){
           //新規モードで開いた時
           this.CreateMode=true
           this.id=""
           this.datas.length=0
           this.bui=""
           this.place=""
           this.day=""
           this.dialog = true
       },
       add_data(){
            
            //ここで空の時の操作を行う。アラートを出したい。
            if(this.shumoku==""){
                return
            }
            
           //データを全てdatasに突っ込む
            this.datas.push({
                shumoku:this.shumoku , weight:this.weight , rep:this.rep , set:this.set
            });
           //突っ込んだらデータは空にしておく
            this.shumoku = ""
            this.weight = 0
            this.rep = 0
            this.set = 0

       },
       deleteItem(item){
        const index = this.datas.indexOf(item)
        confirm('該当のレコードを削除します?') && this.datas.splice(index, 1)
       },

        async storeData(){

            // 種目に値が入ってるときはアラートを出す。
            if(this.shumoku != ""){
                if(!confirm('保存していない種目がありますが、登録しますか？'))
                    return;
            }

            //Editモードならばアップデート関数へと飛ばす
            if(!this.CreateMode){
                this.updateData()
                return;
            }

            this.$store.commit('startLoading')

            const params = {
               bui : this.bui,
               place : this.place,
               memo : this.memo,
               datas : this.datas,
               day : this.getChoiceDay,
            }

            await axios.post('/create',params)
                .then( res => {
                    console.log(res)
                })
                .catch( e => {
                    console.log(e)
                })
                .finally(()=>{
                    this.dialog = false
                    this.$store.commit('endLoading')
                })

       },
       
       openInEditMode(datas){
           /**
            * Open Eidt Mode
            */
            this.$store.dispatch("setChoiceDay",datas.day)
            this.dialog = true
            this.place = datas.place
            this.bui = datas.bui
            this.memo = datas.memo
            this.datas = datas.datas
            this.id = datas.id
            this.CreateMode=false

       },

       async updateData(){
           /**
            * axios update data
            */

            this.$store.commit('startLoading')

            const params = {
               bui : this.bui,
               place : this.place,
               memo : this.memo,
               datas : this.datas,
               day : this.getChoiceDay,
               id: this.id,
            }

            await axios.patch('/update',params)
                .then( res => {
                    console.log(res)
                })
                .catch( e => {
                    console.log(e)
                })
                .finally(()=>{
                    this.dialog = false
                    this.$store.commit('endLoading')
                })


       },

   },
   
  

}
</script>