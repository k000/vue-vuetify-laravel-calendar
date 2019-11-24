<template>
    <v-card>
      <v-card-title>STEP:0 フォーム</v-card-title>
      <v-card-text>
        <v-text-field
            v-model="text1"
            label="種目名"
            :rules="[required]"
            counter="10"
        >
        </v-text-field>
        <v-text-field
          label="入力必須のみあるテキストフィールド"
        >
        </v-text-field>
        <v-text-field
          v-model="text3"
          label="なんの制約もないテキストフィールド"
        >
        </v-text-field>
      </v-card-text>

      <v-divider></v-divider>

      <v-card-actions>
        <v-btn text v-on:click="submit">送信する</v-btn>
      </v-card-actions>

    </v-card>
</template>

<script>
    export default {
        data(){
            return {
                text1:"",
                text2:"",
                text3:"",
                required: v => !!v || "必須",
                limit_length: v => v.length <= 10 || "10文字以内で入力してください",
            }
        },
        methods:{
            submit(){
                console.log("fire")
            }
        },
    }
</script>
