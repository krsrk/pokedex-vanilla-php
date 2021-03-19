export default {
    async getData(context, value) {
        let response = await fetch('/show')
        let dataResponse = await response.json()

        context.commit('SET_POKEMON_LIST', dataResponse)
        context.commit('SET_POKEMON_FILTER_LIST', dataResponse)
    },
}
