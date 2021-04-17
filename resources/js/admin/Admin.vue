<template>
    <div class="container is-full-fullhd mt-5">
        <div class="columns is-centered is-multiline">
            <div class="column is-5 pb-0">
                <h1 class="title is-3">{{ header }} {{ subheader }}</h1>
            </div>
            <div class="column is-3 pb-0">
                <div class="field is-horizontal">
                    <div class="field-body">
                        <label for="per_page" class="label mr-2 mt-2">Títulos por página</label>
                        <div class="select">
                            <select id="per_page" v-model="selected" @change="newPP">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-4 has-text-right pb-0">
                <button class="button is-link ml-6" @click="newMovie">Novo Filme</button>
                <button class="button is-info ml-3" @click="newSeries">Nova Série</button>
            </div>
        </div>
        <div class="column is-12">
            <titles-table :table="table"></titles-table>
        </div>
    </div>
</template>

<script>
import AdminTitlesTable from "./components/AdminTitlesTable";
export default {
    name: "TitlesAdmin",
    components: {
        'titles-table': AdminTitlesTable,
    },
    props: {
        table: Number,
    },
    data() {
        return {
            pages: null,
            is_table: true,
            title: null,
            selected: null,
        }
    },
    computed: {
        header() {
            return this.$store.getters.getHeader
        },
        subheader() {
            return this.$store.getters.getSubHeader
        },
        channel() {
            return this.$store.getters.getChannel
        },
        pp() {
            return this.$store.getters.getPp
        }
    },
    methods: {
        showPage(event) {
            //
        },
        newPP() {
            this.$store.commit('SET_PP', this.selected)
        },
        newMovie() {
            this.$router.push({name: 'store-movies'})
        },
        newSeries() {
            this.$router.push({name: 'store-series'})
        },
        startTitles() {
            axios.get(`/api/title/titles-page/${this.channel}/1/${this.pp}/${this.table}`).then(response => {
                this.$store.commit('SET_TITLES', response.data)
            })
        },
    },
    beforeMount() {
        this.selected = this.pp
        this.startTitles()
    },
    updated() {
        //
    },
    created() {
        axios.get('/api/media').then(response => {
            this.$store.commit('SET_MEDIA', response.data)
        }).catch(error => console.error(error))
        axios.get('/api/category').then(response => {
            this.$store.commit('SET_CATEGORIES', response.data)
        }).catch(error => console.error(error))
    }
}
</script>

<style scoped>
select, option {
    font-size: 0.9rem;
}
</style>
