<template>
    <div id="classic">
        <Game v-if="loaded" :word="word" :wordList="wordList" @reset="reset()" @win="winGame" />
        <Scores ref="scoreboard" />
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "ClassicMode",
    data: () => ({
        loaded: false,
        wordList: [],
        word: ""
    }),
    components: {
        Game: () => import('../Game.vue'),
        Scores: () => import('../Scores.vue')
    },
    methods: {
        reset: function() {
            let word = this.wordList[Math.floor(Math.random()*this.wordList.length)]
            this.word = word
        },
        winGame: function({guesses, word}) {
            this.$refs.scoreboard.addScore(guesses, word)
        }
    },
    mounted() {
        axios.get('https://tessle.tessmakes.at/api/allwords').then(({data}) => {
            this.wordList = data.map(word => word.toUpperCase())
            this.loaded = true
        })
    }
}
</script>

<style>

</style>
