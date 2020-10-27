import Vue from "vue"

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
    data () {
        return {
            message: "Hello Pokedex!!!"
        }
    },
})
