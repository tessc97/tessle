<template>
    <div id="scores">
        <h3>Scoreboard</h3>
        <small v-if="scores.length === 0">No scores found</small>
        <p v-for="score in scores" :key="score._id">
            <small>{{ score.date }}</small> {{ score.word }} in {{ score.guesses }} guesses.
        </p>
    </div>
</template>

<script>
export default {
    name: "Scores",
    data: () => {
        return {
            scores: []
        }
    },
    methods: {
        getScores: function() {
            if (localStorage.scores) {
                this.scores = JSON.parse(localStorage.scores)
            }
        },
        addScore: function(guesses, word) {
            this.scores.push({guesses: guesses, word: word, date: (new Date()).toISOString().split('T')[0]})
            this.scores = this.scores.sort((a, b) => a.guesses - b.guesses)
            localStorage.scores = JSON.stringify(this.scores.slice(0, 10))
        }
    },
    mounted() {
        this.getScores()
    }
}
</script>

<style>

</style>
