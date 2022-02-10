<template>
    <div class="letter-row">
        <LetterBox v-for="letter in letters" :key="letter._id" :letter="letter.letter" :color="letter.color" :border="letter.border" />
    </div>
</template>

<script>
export default {
    props: {
        letters: {
            type: Array
        }
    },
    components: {
        LetterBox: () => import("./LetterBox.vue")
    }
}
</script>

<style>
.letter-row {
    display: inline-flex;
    flex-direction: row;
    gap: .5rem;
}
@media only screen and (min-width: 600px) {
    .letter-row {
        display: inline-flex;
        flex-direction: row;
        gap: 1rem;
    }
}
</style>
