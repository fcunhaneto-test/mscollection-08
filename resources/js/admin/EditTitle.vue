<template>
    <div class="container is-max-widescreen mt-5">
        <div class="columns is-centered">

            <div class="column is-full-widescreen">
                <h1 class="title is-3">Editar {{ title.title }}</h1>
                <hr>
                <div v-if="!titleSaved" class="columns is-multiline">
                    <div class="column is-6">
                        <div class="field">
                            <label for="title" class="label">Título</label>
                            <input id="title" name="title" v-model="title.title" class="input" type="text">
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="field">
                            <label for="original_title" class="label">Título Original</label>
                            <input id="original_title" name="original_title" v-model="title.original_title"
                                   class="input" type="text">
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label for="year" class="label">Ano</label>
                            <input id="year" name="title" v-model="title.year" class="input" type="text">
                        </div>
                    </div>
                    <div class="column is-2">
                        <div v-if="table" class="field">
                            <label for="time" class="label">Tempo</label>
                            <input id="time" name="time" v-model="title.time" class="input" type="time">
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">Rating</label>
                            <a v-for="ys in yellow" :key="'yellow_' + ys" @click="delStar(ys)">
                                <span class="icon has-text-orange"><i class="fas fa-star"></i></span>
                            </a>
                            <a v-for="ws in white" :key="'white_'+ ws" @click="addStar(ws)">
                                <span class="icon has-text-orange"><i class="far fa-star"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="column is-2">
                        <div class="field">
                            <label class="label">IMDB Rating</label>
                            <input type="text" class="input" v-model="title.imdb_rating"></input>
                        </div>
                    </div>
                    <div class="column is-4">
                        <b-field label="País" class="form-edit">
                            <b-input list="country" name="country" v-model="title.country" style="width: 100%;"/>
                            <datalist id="country">
                                <option v-for="country in countries" :value="country.name"/>
                            </datalist>
                        </b-field>
                    </div>
                    <div class="column is-4">
                        <b-field label="Categoria 1" class="form-edit">
                            <b-input list="categories_1" name="category" v-model="title.category_1"
                                     style="width: 100%;"/>
                            <datalist id="categories_1">
                                <option v-for="category in categories" :value="category.name"/>
                            </datalist>
                        </b-field>
                    </div>
                    <div class="column is-4">
                        <b-field label="Categoria 2" class="form-edit">
                            <b-input list="categories_2" name="category" v-model="title.category_2"
                                     style="width: 100%;"/>
                            <datalist id="categories_2">
                                <option v-for="category in categories" :value="category.name"/>
                            </datalist>
                        </b-field>
                    </div>
                    <div class="column is-4">
                        <b-field label="Categoria 3" class="form-edit">
                            <b-input list="categories_3" name="category" v-model="title.category_3"
                                     style="width: 100%;"/>
                            <datalist id="categories_3">
                                <option v-for="category in categories" :value="category.name"/>
                            </datalist>
                        </b-field>
                    </div>
                    <div class="column is-12 mb-0 pb-0">
                        <label class="label">Mídia</label>
                        <div class="columns is-multiline">
                            <div v-for="(_, i) in media" class="column is-2">
                                <input :id="media[i].slug" type="checkbox" :value="media[i].id"
                                       v-model="media_id">
                                <label :for="media[i].slug">{{ media[i].name }}</label>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="column is-12">
                        <div class="field">
                            <label for="summary" class="label">Resumo</label>
                            <div class="control">
                                <textarea id="summary" class="textarea" v-model="title.summary"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="column is-12">
                        <div class="field">
                            <label for="comment" class="label">Nosso Comentário</label>
                            <div class="control">
                                <textarea id="comment" class="textarea" v-model="title.our_comment"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="column is-4 mt-3"></div>
                    <div class="column is-4 mt-3">
                        <button class="button is-primary is-fullwidth" @click="saveTitle">SALVAR</button>
                    </div>
                    <div class="column is-4 mt-3"></div>
                    <div class="column is-3 mt-3 mb-6 pb-6"></div>
                    <div class="column is-3 mt-3 mb-6 pb-6">
                        <button class="button is-warning is-fullwidth" @click="">EDITAR ELENCO</button>
                    </div>
                    <div class="column is-3 mt-3 mb-6 pb-6">
                        <button class="button is-warning is-fullwidth" @click="">EDITAR PRODUTORES</button>
                    </div>
                    <div class="column is-3 mt-3 mb-6 pb-6"></div>
                </div>
            </div>
        </div>
        <b-modal v-model="saved" :width="400" :height="400">
            <div class="card">
                <div class="card-content">
                    <div class="content has-text-centered">
                        <p>Filme salvo com sucesso</p>
                        <button class="button is-primary" autofocus @click="saved = false">FECHAR</button>
                    </div>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>

export default {
    name: "EditTitle",
    props: {
        table: Number,
    },
    data() {
        return {
            titleSaved: false,
            saved: false,
            yellow: 0,
            white: 5,
            media_id: [],
            cast: [],
            producers: [],
            countries: null,
        }
    },
    computed: {
        title() {
            return this.$store.getters.getTitle
        },
        categories() {
            return this.$store.getters.getCategories
        },
        media() {
            return this.$store.getters.getMedia
        }
    },
    methods: {
        delStar(ys) {
            if (ys === 1) {
                this.yellow = 0
                this.white = 5
            } else {
                this.yellow = ys
                this.white = 5 - ys
            }
            this.title.our_rating = this.yellow
        },
        addStar(ws) {
            this.yellow += ws
            this.white = 5 - this.yellow
            this.title.our_rating = this.yellow
        },

        /**
         * Send data to store movie.
         */
        saveTitle() {
            this.title.title = this.title.title.trim()
            this.title.original_title = this.title.original_title.trim()
            this.title.media = JSON.stringify(this.media_id)
            axios.put(`/api/title/update/${this.title.id}`, this.title).then(response => {
                if (response.status === 200) {
                    this.titleSaved = true
                    this.saved = true
                }
            }).catch(error => {
                console.error(error)
            })
        },
        saveCast(c) {
            if (this.title_id) {
                axios.post('/api/cast/store', {
                    actor: c.actor.trim(),
                    character: c.character.trim(),
                    order: c.order,
                    star: c.star,
                    title_id: this.title_id
                }).then(response => {
                    if (response.status === 200) {
                        console.log('CAST', response.data)
                        c.saved = true
                    }
                }).catch(error => {
                    console.error(error)
                })
            }
        },
        saveProducer(p) {
            if (this.title_id) {
                axios.post('/api/producer/store', {
                    producer: p.producer.trim(),
                    order: p.order,
                    title_id: this.title_id
                }).then(response => {
                    if (response.status === 200) {
                        p.saved = true
                    }
                }).catch(error => {
                    console.error(error)
                })
            }
        },
        /**
         * Adicionar as tabelas novo diretor ou novo elenco em branco
         */
        addProducer() {
            this.producers.push({
                producer: '',
                order: 1,
                saved: false
            })
        },
        addCast() {
            this.cast.push({
                actor: '',
                character: '',
                order: 1,
                star: false,
                saved: false
            })
        },
        deleteCastTitle() {

        }
    },
    beforeMount() {
        this.yellow = this.title.our_rating
        this.white = 5 - this.yellow
        axios.get(`/api/title/media/${this.title.id}`).then(response => {
            for(let i=0; i<response.data.length; i++) {
                this.media_id.push(response.data[i].id)
            }
        }).catch(error => console.error(error))
        axios.get(`/api/cast/title/${this.title.id}`).then(response => {
            for(let i=0; i<response.data.length; i++) {
                this.cast.push(response.data[i])
            }
            console.log('CAST', this.cast)
        }).catch(error => console.error(error))
    },
    created() {
        axios.get('/api/country').then(response => {
            this.countries = response.data
        }).catch(error => console.error(error))
    }
}
</script>

<style scoped>
hr {
    height: 2px;
    border-width: 0;
    color: #000000;
    background-color: #000000;
}
</style>
