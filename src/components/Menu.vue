<template>
    <div id="menu">
        <div id="popup" v-if="active" @click.self="active = !active">
            <div id="popup-menu">
                <div id="popup-nav">
                    <h3>Modes</h3>
                    <a href="javascript:;" class="menu-link" @click="active = !active"><i class="ri-close-line"></i></a>
                </div>
                <router-link to="/" exact class="item" @click.native="active = !active">Classic</router-link>
                <router-link to="/daily" exact class="item" @click.native="active = !active">Daily</router-link>
            </div>
        </div>
        <div id="nav">
            <a href="javascript:;" class="menu-link" @click.prevent="active = !active"><i class="ri-menu-line"></i></a>
            <h1>Tessle<small> {{$route.name}}</small></h1>
            <router-link to="/notes" class="menu-link"><i class="ri-booklet-line"></i></router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "Menu",
    data: () => ({
        active: false,
    })
}
</script>

<style>
#menu {
    text-align: left;
}
#menu a {
    text-decoration: none;
    color: inherit;
    font-size: 2em;
}

#nav {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}
a.menu-link {
    text-align: center;
    height: 4rem;
    width: 4rem;
    line-height: 4rem;
}

#popup {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}
#popup #popup-nav {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
#popup #popup-nav h3 {
    margin: 0 1rem 0 1rem;
    line-height: 4rem;
}
#popup #popup-menu {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 80%;
    height: 100%;
    margin: 0px;
    padding: 0px;
    background-color: white;
}
@media only screen and (min-width: 1000px) {
  #popup #popup-menu {
    width: 20%;
  }
}
.item {
    display: block;
    padding: 1rem;
}
.item.router-link-active {
    background: lightgrey;
}
</style>
