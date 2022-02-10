<template>
    <div class="letterbox" :style="`background:${color}; border-color:${border}`">
        {{ letter }}
    </div>
</template>

<script>
export default {
    name: "LetterBox",
    props: {
        letter: {
            type: String,
            default: ""
        },
        color: {
            type: String,
            default: "white"
        },
        border: {
            type: String,
            default: "black"
        }
    }
}
</script>

<style>
.letterbox {
    width: 3rem;
    height: 3rem;
    color: white;
    border-radius: 10px;
    border-right: 4px solid black;
    border-bottom: 4px solid black;
    /* border: 1px solid black; */
    line-height: 3rem;
    font-size: 1.5rem;
    font-weight: bold;
}
</style>
