<template>
  <v-app>
    <div>
        <v-toolbar>
        <v-toolbar-title>筋トレ</v-toolbar-title>

        <v-spacer></v-spacer>

        <template>
            <v-btn icon>
                <v-icon>mdi-export-variant</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon>mdi-delete-circle</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon>mdi-plus-circle</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon>mdi-twitter</v-icon>
            </v-btn>
             <v-btn icon>
                <v-icon>mdi-login</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon>mdi-logout</v-icon>
            </v-btn>
        </template>
        </v-toolbar>
    </div>
    <v-footer>
        <v-spacer></v-spacer>
        Design by hoge.
    </v-footer>
  </v-app>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
