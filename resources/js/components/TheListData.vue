<template>
    <div class="grid grid-cols-3 gap-4">
        <template v-for="item in dataList">
            <div class="max-w-xs rounded overflow-hidden shadow-lg my-5">
                <img class="w-full" :src="item.image" :alt="item.name">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ item.code }} - {{ item.name }}</div>
                    <p class="text-grey-darker text-base">
                        <b>Height: </b> {{ item.height }} <br>
                        <b>Weight: </b> {{ item.weight }} <br>
                        <b>Ability: </b> {{ item.ability }}
                    </p>
                </div>
                <div class="px-6 py-4">
                    <a :href="moreInfoUrl(item)" target="_blank"
                       class="tracking-wider text-white bg-red-500 px-4 py-1 text-sm rounded leading-loose mx-2 font-semibold"
                       :title="item.name">
                        <i class="fas fa-info-circle" aria-hidden="true"></i> More Info
                    </a>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
export default {
    name: "TheListData",
    props: {
        dataList: {
            type: null,
        }
    },
    methods: {
        moreInfoUrl(item) {
            return "https://www.pokemon.com/el/pokedex/" + item.name.toLowerCase()
        }
    }
}
</script>
