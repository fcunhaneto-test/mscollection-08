<template>
    <div class="container is-full-fullhd mt-5">
        <div class="columns is-centered is-multiline">
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
                <titles-table :table="table"></titles-table>
            </div>
        </div>
    </div>
</template>

<script>
import TitlesTable from "./components/TitlesTable";
export default {
    name: "Titles",
    components: {
        TitlesTable
    },
    props: {
        table: Number,
    },
    computed: {
        header() { return this.$store.getters.getHeader },
        subheader() { return this.$store.getters.getSubHeader },
        channel() { return this.$store.getters.getChannel },
        pp() { return this.$store.getters.getPp }
    },
    methods: {
        newPp() {
            //
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
}
</script>

<style scoped>
select, option {
    font-size: 0.9rem;
}
</style>
