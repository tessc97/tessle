<template>
  <div id="app">
    <Tessle/>
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
}
</style>
