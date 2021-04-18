<template>
    <div class="columns is-centered">
        <div class="column is-two-thirds">
            <div class="card is-bordered">
                <div class="media has-background-black">
                    <div class="media-left p-2">
                        <img v-if="title.poster" :src="'../storage/images/posters/' + title.poster" width="182"
                             height="268"
                             alt="poster do filme">
                        <img v-else :src="'../storage/images/posters/faker-poster.png'" width="182" height="268"
                             alt="poster do filme">
                    </div>
                    <div class="media-content">
                        <h2 class="title is-3 has-text-white pt-5">{{ title.title }}</h2>
                        <p>
                            <span class="tag is-light">Ano: {{ title.year }}</span>
                            <span class="tag is-light">Duração: {{ title.time | strTime }}</span>
                        </p>
                        <p class="mt-3">
                            <span class="tag is-info">
                                <span class="mr-2">IMDB rating: {{ title.imdb_rating }}</span>
                            </span>
                            <span class="tag is-info">
                                <span class="mr-2">Editor rating:</span>
                                <i v-for="i in title.our_rating" class="fas fa-star has-text-orange"></i>
                                <i v-for="i in (5-title.our_rating)" class="far fa-star"></i>
                            </span>
                        </p>
                        <p class="mt-3">
                            <span v-if="title.category_3" class="tag is-light">Categorias: {{ title.category_1 }},
                                    {{ title.category_2 }}, {{ title.category_3 }}</span>
                            <span v-else-if="title.category_2" class="tag is-light">Categorias: {{ title.category_1 }},
                                    {{ title.category_2 }}</span>
                            <span v-else class="tag is-light">Categorias: {{ title.category_1 }}</span>
                        </p>
                    </div>
                    <div class="media-right">
                        <div class="column">
                            <b-tooltip label="Retornar">
                                <b-button type="is-dark" @click="viewTable"><i class="fas fa-undo-alt"></i></b-button>
                            </b-tooltip>
                        </div>
                    </div>
                </div>
                <div class="card-content mb-6 py-0">
                    <div class="mt-5 p-3 this-bordered">
                        <h5 class="title is-6 mb-2 pb-0">Resumo:</h5>
                        <p>{{ title.summary }}</p>
                    </div>
                    <div v-if="title.our_comment" class="mt-5 p-3 this-bordered">
                        <h5 class="title is-6 mb-2 pb-0">Comentário do Editor:</h5>
                        <p>{{ title.our_comment }}</p>
                    </div>
                    <div class="mt-5">
                        <b-collapse :open="false" aria-id="contentActors">
                            <template #trigger>
                                <button class="button bg-purple has-text-white is-rounded mb-0">
                                    <span>Ator/Personagem</span>
                                </button>
                            </template>
                            <div class="notification mt-0 pt-0">
                                <table v-if="cast.length > 0" class="table is-fullwidth mt-5 mb-0">
                                    <tbody>
                                    <tr v-for="ac in cast">
                                        <td class="pl-5">{{ ac.actor }}</td>
                                        <td>{{ ac.character }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </b-collapse>
                    </div>
                    <div class="mt-5">
                        <b-collapse :open="false" aria-id="contentActors">
                            <template #trigger>
                                <button class="button bg-purple has-text-white is-rounded mb-0">
                                    <span v-if="title.is_movie" class="producer">Diretor(es)</span>
                                    <span v-else class="producer">Criador(es)</span>
                                </button>
                            </template>
                            <div class="notification mt-0 pt-0">
                                <table v-if="producers.length > 0" class="table is-fullwidth mt-5">
                                    <tbody>
                                    <tr v-for="producer in producers">
                                        <td class="pl-5">{{ producer.name }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </b-collapse>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// TODO Melhorar o retorno para volte na mesma página
export default {
    name: "TitleShow",
    props: {
        title: Object,
        table: Number
    },
    data() {
        return {
            actorClose: true,
            cast: [],
            cast_total: 0,
            producers: [],
            prod_total: 0,
        }
    },
    computed: {
        //
    },
    methods: {
        viewTable() {
            this.$emit('viewTable')
        }
    },
    beforeMount: function () {
        axios.get(`/api/cast/title/${this.title.id}`).then(response => {
            console.log('CAST', response.data)
            this.cast = response.data
            this.cast_total = this.cast.length
        }).catch(errors => console.log(errors))
        axios.get(`/api/producer/title/${this.title.id}`).then(response => {
            console.log('PRODUCER', response.data)
            this.producers = response.data
            this.prod_total = this.producers.length
        }).catch(errors => console.log(errors))
    }
}
</script>

<style scoped>
.tag, table {
    font-size: 1rem;
}

.this-bordered {
    border: 2px solid #8E24AA;
    border-radius: 15px;
}

.bg-purple {
    background-color: #8E24AA;
}
</style>
