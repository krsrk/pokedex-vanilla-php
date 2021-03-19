import Vue from "vue"

import store from "./store/store"

import TheNav from "./components/TheNav"
import TheSearchBox from "./components/TheSearchBox"
import TheListData from "./components/TheListData"
import TheFooter from "./components/TheFooter"

new Vue({
    el: "#app",
    delimiters: ['${', '}'],
    components: {
        'the-nav': TheNav,
        'the-search-box': TheSearchBox,
        'the-list-data': TheListData,
        'the-footer': TheFooter,
    },
    created() {
        this.$store.dispatch('getData')
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
})
