import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';




Vue.use(Vuex);


export default new Vuex.Store({

    state:{
        choiceDay:"",
        list:[],
        textcontent:"",
        noteId:"",
        isLoading:false,
        master:["サンプル"]
    },

    getters:{
        
        getChoiceDay: state => state.choiceDay,

        getList:(state,getters) => () => {
            return state.list
        },
        getNoteContent: state => state.textcontent,
        getNoteId: state => state.noteId,

    },

    mutations:{

        startLoading(state){
            state.isLoading = true
        },

        endLoading(state){
            state.isLoading = false
        },

        setMaster(state,data){
            
            state.master.length = 0

            data.data.forEach(e => {
                state.master.push(e.shumoku)
            });
            
        },


        setChoiceDay(state,choiceDay){
            state.choiceDay = choiceDay
        },
        setList(state,list){
            state.list = list
        },
        setTextContent(state,data){
            state.textcontent = data.content
            state.noteId = data.id
        },
        setCreateNoteId(state,id){
            state.noteId = id
        },
        updateTextContent(state,newText){
            state.textcontent = newText
        }
        
    },

    actions:{

        startLoading(context){
            context.commit('startLoading')
        },

        endLoading(context){
            context.commit('endLoading')
        },

        setMaster(context,data){
            context.commit('setMaster',data)
        },

        setChoiceDay(context,day){
            context.commit('setChoiceDay',day)
        },

        async setList(context){
            let result = []
            await axios.get('/notes')
            .then( (res) => {
                result = res.data
            })
            .catch(function(e){
                console.log(e)
            })
            context.commit('setList',result)
        },

        async createNote(context,param){
            await axios.post('/note/create',param)
            .then((res) => {
                context.dispatch("setList")
                context.commit('setCreateNoteId',res.data)
            })
            .catch((e) =>{
                console.log(e)
            })
        },

        async deleteNote(context,param){
            await axios.delete('/note/delete',{data:param})
            .then((res) => {
                context.dispatch("setList")
                context.commit('setTextContent',{content:"",noteId:""})
            })
            .catch((e) =>{
                console.log(e)
            })
        },

        async setTextContent(context,id){
            let params = {
                id:parseInt(id)
            }
            await axios.get('/note/',{params})
            .then( (res) => {
                context.commit('setTextContent',res.data[0])
            })
            .catch( (e) => {
                console.log(e)
            })
        },

        async updateNote(context,param){

            await axios.patch('/note/update',param)
            .then((res) => {
                context.dispatch("setList")
            })
            .catch((e) =>{
                console.log(e)
            })
            
        },

        newNote(context){
            context.commit('setTextContent',{content:"",noteId:""})
        },

        async searchNote(context,searchText){

            if(searchText){
                
                let params = {
                    text:searchText
                }
                await axios.get('/note/search',{params})
                .then( (res) => {
                    context.commit('setList',res.data)
                })
                .catch( (e) => {
                    console.log(e)
                })

            }else{
                context.dispatch("setList")
            }
        },

        updateTextContent(context,newText){
            context.commit('updateTextContent',newText)
        }

    },

})
