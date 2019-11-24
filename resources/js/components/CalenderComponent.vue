<template>

  <v-sheet height="500">

    <v-content>
        <v-container>
            <v-layout wrap>
                <v-flex md4 @click="prev"><v-btn><v-icon>mdi-skip-previous</v-icon></v-btn></v-flex>
                <v-flex md4>{{this.focus}}</v-flex>
                <v-flex md4 @click="next"><v-btn> <v-icon>mdi-skip-next</v-icon></v-btn></v-flex>
            </v-layout>
        </v-container>
    </v-content>
  
  <div class="form-modal">
    <form-component ref="form"></form-component>
  </div>

  <div class="detail-modal">
    <detail-component ref="detail"></detail-component>
  </div>


  <div id="alert-modal">
    <alert-component ref="alert">
      <p slot="text">{{this.alertText}}</p>
    </alert-component>
  </div>

    <v-calendar
        ref="calendar"
        locale="ja-jp"
        :type="type"
        :now="today"
        v-model="focus"
        :events="datas"
        :day-format="timestamp => new Date(timestamp.date).getDate()"
        :month-format="timestamp => (new Date(timestamp.date).getMonth() + 1) + ' /'"
        @click:date="clickdate"
        @click:event="showEvent"
        @change="updateRange"
    ></v-calendar>
  </v-sheet>
  
</template>



<script>


  export default {
    data: () => ({
    alertText:"既にデータが登録されているため登録できません。",
    today: `${new Date().getFullYear()}-${new Date().getMonth() + 1}-01`,
    focus: `${new Date().getFullYear()}-${new Date().getMonth() + 1}-01`,
    start: null,
    end: null,
    type:'month',
    datas:[],
      events: [
        {
          name: '背中のトレーニング',
          start: '2019-11-16',
          end: '2019-11-16',
        },
        {
          name: 'Meeting',
          start: '2019-01-07',
        },
        {
          name: '30th Birthday',
          start: '2019-01-03',
        },
        {
          name: 'New Year',
          start: '2019-01-01',
        },
        {
          name: 'Conference',
          start: '2019-01-21',
        },
        {
          name: 'Hackathon',
          start: '2019-01-30',
          end: '2019-02-01',
        },
      ],
    }),
    computed:{
   
    },
    mounted () {

      this.$store.commit('startLoading')

      let params = {
        month : this.focus
      }

      axios.get('/notes',{params})
        .then( res => {
          this.datas = res.data
        })
        .catch( e => {
          console.log(e)
        })
        .finally(()=>{
          this.$store.commit('endLoading')
        })

        this.$refs.calendar.checkChange()

    },
    methods:{
        showEvent ({event}) {
          //カレンダーに表示されたnameをクリックした時の処理
          /**
           * ここで詳細を表示するモーダルを表示
           */

          this.$refs.detail.open()
          this.$refs.detail.setData({
            id:event.id,
            day:event.start,
            bui:event.name,
            place:event.place,
            memo:event.memo,
            datas:event.datas,
          })

        },

        clickdate(e){
            //これは日付の丸ボタンをクリックした時の処理
            //すでに登録すみのデータがあった場合は処理を禁止
            let hasAlredyValue = false
            this.datas.forEach( obj => {
              if(obj.start == e.date){
                  this.alertText="既にデータが登録してあります。データを削除するか更新してください。"
                  this.$refs.alert.onActive()
                  hasAlredyValue = true
                }
              })

            if(!hasAlredyValue){
              this.$store.dispatch("setChoiceDay",e.date)
              this.$refs.form.open()
            }

        },

        setToday () {
          this.focus = this.today
        },
        next(){
            this.$refs.calendar.next()
        },
        prev(){
            this.$refs.calendar.prev()
        },

        updateRange ({ start, end }) {
          this.start = start
          this.end = end

          this.$store.commit('startLoading')

          let params = {
            month : start.date
          }

          axios.get('/notes',{params})
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
    }
  }
</script>


<style>
#alert-modal{
  z-index:99;
  position: fixed;
  top:50px;
  left:50px;
}
</style>