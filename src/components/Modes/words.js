import axios from 'axios'

export async function getWords() {
    try {
        const {data} = axios.get('https://tessle.tessmakes.at/api/allwords')
        console.log(data)
        return JSON.parse(data)
    } catch (err) {
        console.log(err)
    }
}