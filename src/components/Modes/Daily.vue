<template>
    <div id="daily">
        <Game ref="game" v-if="loaded" :word="word" :wordList="wordList" :canRetry="timeLeft <= 0" :winMessage="`New word in ${countdown}`" :includeWordSpoiler="false" @reset="getWord" />
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "DailyMode",
    data: () => ({
        loaded: false,
        wordList: [],
        word: "",
        timeEnds: 0,
        timeLeft: 0
    }),
    computed: {
        countdown: function() {
            let date = new Date(null)
            date.setSeconds(this.timeLeft)
            return date.toISOString().substr(11, 8)
        }
    },
    components: {
        Game: () => import('../Game.vue')
    },
    methods: {
        getWord: function() {
            axios.get('https://tessle.tessmakes.at/api/allwords').then(({data}) => {
                this.wordList = data.map(word => word.toUpperCase())
                axios.get('https://tessle.tessmakes.at/api/wotd').then(({data: {word, timeLeft}}) => {
                    this.word = word.toUpperCase()
                    this.timeEnds = new Date(timeLeft)
                    this.loaded = true

                    setInterval(() => {
                        this.timeLeft = Math.max(Math.floor((this.timeEnds.getTime() - (new Date()).getTime()) / 1000), 0)
                    })
                })
            })
        }
    },
    mounted() {
        this.getWord()
    }
}
</script>

<style>

</style>
