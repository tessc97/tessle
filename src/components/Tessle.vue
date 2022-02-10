<template>
    <div id="tessle">
        <h1>Tessle</h1>
        <Game />
    </div>
</template>

<script>
export default {
    name: 'Tessle',
    components: {
      Game: () => import("./Game.vue")
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
