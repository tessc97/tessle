<template>
    <div id="game">
        <h3 :class="{'hidden': state !== 'won'}">Congratulations, you won! :)</h3>
        
        <p v-if="winMessage !== ''" :class="{'hidden': state !== 'won'}">{{ winMessage }}</p>
        <button class="success" :class="{'hidden': state !== 'won'}" @click.prevent="shareScore">Share</button>

        <h3 :class="{'hidden': state !== 'lost'}">You lost! :(</h3>
        <p :class="{'hidden': state !== 'lost'}">The word was {{ word }}.</p>
        
        <button v-if="canRetry" :class="{'hidden': state === 'game'}" @click.prevent="setupGame">Try again!</button>

        <LetterRow v-for="guess in guesses" :key="guess._id" :letters="guess.letters" />
        <input type="text" v-model="guess" @keyup.enter="makeGuess" :disabled="state != 'game'">
        <button class="success" @click="makeGuess" :disabled="state != 'game'">Guess</button>
        <p>{{ warning }}</p>
    </div>
</template>

<script>
export default {
    name: "GameField",
    props: {
        word: {
            type: String
        },
        wordList: {
            type: Array
        },
        canRetry: {
            type: Boolean,
            default: true
        },
        winMessage: {
            type: String
        },
        includeWordSpoiler: {
            type: Boolean,
            default: true
        }
    },
    data: () => ({
        guesses: [],
        state: "game",
        guess: "",
        warning: "",
        guessNum: 0,
        maxGuesses: 6
    }),
    components: {
        LetterRow: () => import("./LetterRow.vue")
    },
    methods: {
        makeGuess: function() {
            console.log(`guess number ${this.guessNum}`)
            this.warning = ""

            let word = this.word
            let guess = this.guess.toUpperCase()
            
            if (guess.length < 5) {
                this.warning = "This word is too short"
                return
            }
            if (guess.length > 5) {
                this.warning = "This word is too long"
                return
            }
            if (!this.wordList.includes(guess)) {
                this.warning = "Word is not in word list"
                return
            }

            if (word === guess) {
                this.state = "won"
                this.$emit("win", {guesses: this.guessNum+1, word: this.word})
            }
            if (this.guessNum >= (this.maxGuesses - 1)) {
                if (this.state !== "won") {
                    this.state = "lost"
                }
            }

            let guessObj = {
                letters: Array(5)
            }

            let wordLetters = [...word].map(letter => letter.toUpperCase())
            let letters = [...guess]
            let lettersLeft = JSON.parse(JSON.stringify(wordLetters))
            for (let i in letters) {
                if (letters[i] === wordLetters[i]) {
                    guessObj.letters[i] = {
                        letter: letters[i],
                        color: "#85BB65",
                        border: "#497F29",
                        shareSymbol: "🟩"
                    }
                    lettersLeft[i] = ""
                }
            }
            for (let i in letters) {
                if (guessObj.letters[i]) {
                    continue
                }

                if (lettersLeft.includes(letters[i])) {
                    guessObj.letters[i] = {
                        letter: letters[i],
                        color: "#F6BE00",
                        border: "#D8A000",
                        shareSymbol: "🟨"
                    }
                } else {
                    guessObj.letters[i] = {
                        letter: letters[i],
                        color: "#838996",
                        border: "#333946",
                        shareSymbol: "⬛"
                    }
                }
            }
            this.$set(this.guesses, this.guessNum, guessObj)
            this.guessNum++
            this.guess = ""
        },
        setupGame: function() {
            this.$emit("reset")
            this.guesses = this.generateGrid()
            
            this.state = "game"
            this.guess = ""
            this.warning = ""
            this.guessNum = 0
        },
        generateGrid: function() {
            let grid = []
            for (var row = 0; row < this.maxGuesses; row++) {
                var letterRow = {
                    letters: []
                }
                for (var col = 0; col < 5; col++) {
                    letterRow.letters.push({
                        letter: "",
                        color: "#C9C0BB",
                        border: "#79706B",
                        shareSymbol: "⬛"
                    })
                }
                grid.push(letterRow)
            }
            return grid
        },
        shareScore: function() {
            let shareString = `Tessle ${this.$route.name}\n`
            for (let guess = 0; guess < this.guessNum; guess++) {
                for (let letter = 0; letter < 5; letter++) {
                    shareString += this.guesses[guess].letters[letter].shareSymbol
                }
                shareString += "\n"
            }
            if (this.includeWordSpoiler) {
                shareString += `The word was ||${this.word}||\n`
            }
            navigator.clipboard.writeText(`${shareString}${window.location.href}`)
        }
    },
    mounted() {
        this.setupGame()
    }
}
</script>

<style>
#game {
    display: inline-flex;
    flex-direction: column;
    gap: 1em;
    margin-top: 60px;
}
.hidden {
    display: none;
}
button {
    height: 2rem;
    line-height: 2em;
    border-radius: 10px;
    border-width: 0 4px 4px 0;
    border-style: solid;
    border-color: #79706B;
    font-weight: bold;
    color: white;
    background: #C9C0BB;
}
button.success {
    background: #85BB65;
    border-color: #497F29;
}
</style>
