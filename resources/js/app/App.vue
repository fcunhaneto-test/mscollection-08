<template>
    <div class="container is-full-fullhd mt-5">
        <div v-if="is_table" class="columns is-centered is-multiline">
            <div class="column is-6 pb-0">
                <h1 class="title is-3">{{ header }} {{ subheader }}</h1>
            </div>
            <div class="column is-6 pb-0">
                <div class="field is-horizontal">
                    <div class="field-body">
                        <label for="per_page" class="label mr-2 mt-2">Títulos por página</label>
                        <div class="select" >
                            <select id="per_page" v-model="selected" @change="newPp">
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
            <div class="column is-12">
                <titles-paginate :table="table"></titles-paginate>
                <titles-table :table="table" @showTitle="showPage($event)"></titles-table>
            </div>
        </div>
        <title-show v-if="!is_table" :title="title" :table="table" @viewTable="is_table = !is_table"></title-show>
    </div>
</template>

<script>
import TitlesTable from "./components/TitlesTable";
import TitlesPaginate from "./components/TitlesPaginate";
import TitleShow from "./components/TitleShow";
export default {
    name: "Titles",
    components: {
        TitlesTable,
        TitlesPaginate,
        TitleShow
    },
    props: {
        table: Number,
    },
    data() {
        return {
            selected: null,
            is_table: true,
        }
    },
    computed: {
        header() { return this.$store.getters.getHeader },
        subheader() { return this.$store.getters.getSubHeader },
        channel() { return this.$store.getters.getChannel },
        pp() { return this.$store.getters.getPp }
    },
    methods: {
        showPage(event) {
            this.is_table = false
            this.title = event
        },
        newPp() {
            this.$store.commit('SET_PP', this.selected)
            this.startTitles()
        },
        startTitles() {
            axios.get(`/api/title/titles-start/${this.channel}/${this.pp}/${this.table}`).then(response => {
                console.log("DATA", response.data)
                this.$store.commit('SET_PAGES', response.data[0])
                this.$store.commit('SET_TITLES', response.data[1])
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
}
</script>

<style scoped>
select, option {
    font-size: 0.9rem;
}
</style>
