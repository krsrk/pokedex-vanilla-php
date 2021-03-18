import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex)

import TheNav from "./components/TheNav"
import TheSearchBox from "./components/TheSearchBox"
import TheListData from "./components/TheListData"
import TheFooter from "./components/TheFooter"

const store = new Vuex.Store({
    state: {
        pokemonList: [],
        pokemonFilterList: []
    },
    getters: {
        POKEMON_LIST: state => {
            return state.pokemonList
        },
        POKEMON_FILTER_LIST: state => {
            return state.pokemonFilterList
        },
    },
    mutations: {
        SET_POKEMON_LIST(state, data) {
            state.pokemonList = data
        },
        SET_POKEMON_FILTER_LIST(state, data) {
            state.pokemonFilterList = data
        },
    }
})

new Vue({
    el: "#app",
    delimiters: ['${', '}'],
    components: {
        'the-nav': TheNav,
        'the-search-box': TheSearchBox,
        'the-list-data': TheListData,
        'the-footer': TheFooter,
    },
    mounted() {
        this.getData()
    },
    store,
    computed: {
        dataList: {
            get () {
                return this.$store.getters.POKEMON_LIST
            },
            set (value) {
                this.$store.commit('SET_POKEMON_LIST', value)
            }
        },
        filterDataList: {
            get () {
                return this.$store.getters.POKEMON_FILTER_LIST
            },
            set (value) {
                this.$store.commit('SET_POKEMON_FILTER_LIST', value)
            }
        },
    },
    data () {
        return {
            message: "Hello Pokedex!!!"
        }
    },
    methods: {
        async getData() {
            let dataResponse = await fetch('/show')
            this.dataList = await dataResponse.json()
            this.filterDataList = this.dataList
        },
    }
})
