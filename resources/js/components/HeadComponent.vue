<template>
    <div id="header-nav">
        <v-toolbar>
        <v-toolbar-title>筋トレノート</v-toolbar-title>

        <v-spacer></v-spacer>

        <template>

            <v-btn icon>
                <a href="/"><v-icon>mdi-laptop</v-icon></a>
            </v-btn>
            
            <v-btn icon>
                <a href="/top"><v-icon>mdi-home</v-icon></a>
            </v-btn>

            <v-btn icon>
                <a href="/master"><v-icon>mdi-playlist-plus</v-icon></a>
            </v-btn>

            <v-btn icon>
                <v-icon>mdi-export-variant</v-icon>
            </v-btn>

            
            <v-btn icon>
                <a href="/home"><v-icon>mdi-logout</v-icon></a>
            </v-btn>


        </template>
        </v-toolbar>
    </div>
</template>

<script>
    export default {
        mounted() {
           
        }
    }
</script>

<style>
    #header-nav a{
        text-decoration: none;
    }
    
</style>