<template>
  <div id="app">
    <Tessle/>
    <div class="notes">
      <h3>Notes</h3>
      <div class="note">
        <p class="date">2022-02-05 @ 20:00</p>
        <p class="text">Added enter key handler on input field and clear input after guess.</p>
      </div>
      <div class="note">
        <p class="date">2022-02-05 @ 19:30</p>
        <p class="text">Added a share button for Discord.</p>
      </div>
      <div class="note">
        <p class="date">2022-02-05</p>
        <p class="text">Updated the graphics a bit and added a proper favicon.</p>
      </div>
      <div class="note">
        <p class="date">2022-02-04</p>
        <p class="text">
          Updated the logic that checks if a letter is misplaced to prevent it showing yellow when the correct letter has already been guessed.<br />
          Added a scoreboard that saves the scores in local storage.<br />
          I implemented a function that generates the playfield, extending the number of guesses to 6 and also added a button to reset the game.<br />
          Removed a bug where if you won on the last try it would still tell you that you lost.
        </p>
      </div>
      <div class="note">
        <p class="date">2022-02-03 @ 22:50</p>
        <p class="text">I updated the word list to only include nouns and it's 1000 words long now, it also shows you what the word would've been if you lose.</p>
      </div>
      <div class="note">
        <p class="date">2022-02-03</p>
        <p class="text">I made this clone of Wordle for a challenge by another discord user.</p>
      </div>
    </div>
  </div>
</template>

<script>
import Tessle from './components/Tessle.vue'

export default {
  name: 'App',
  components: {
    Tessle
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.notes {
  width: 60%;
  text-align: left;
  margin: auto;
}
.notes .date {
  margin-bottom: 0;
  color: grey;
  font-size: 0.8rem;
}
.notes .text {
  margin-top: 0;
}

@media only screen and (max-width: 600px) {
  .notes {
    width: 90%;
  }
}
</style>
