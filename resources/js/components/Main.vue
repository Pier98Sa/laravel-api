<template>
  <div>
    <h1 class="text-uppercase text-center mt-3">Elenco dei post</h1>
    <div class="container">
        <div class="row">
            <!--Stampo in delle card tutti i post con un ciclo V-for-->
            <div class="col-4 py-2" v-for="post in posts" :key="post.id">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase">{{post.title}}</h5>
                        <p class="card-text">{{post.content}}</p>
                        <p> <strong>Autore: </strong>{{post.author}}</p>
                        <a href="#" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div> 
            
        </div>
        <div class="row justify-content-center">
            <!--Creo i tasti per cambiare pagina-->
            <nav>
                <ul class="pagination ">
                    <li class="page-item" :class="(currentPage == 1)? 'disabled':''"><span class="page-link" @click="getPosts(currentPage - 1)">Previous</span></li>
                    <li class="page-item" :class="(currentPage == lastPage)? 'disabled':''"><span class="page-link" @click="getPosts(currentPage + 1)">Next</span></li>
                </ul>
            </nav>
        </div>
        
    </div>
  </div>
</template>

<script>
export default {
    name: 'Main',

    data() {
        return{
            posts: [],
            currentPage : 1,
            lastPage : null
        }
    },
    methods : {
        //aggiungo come params, page così da passare la pagina richiesta
        getPosts(apiPage){
            axios.get('api/posts', {
                'params' : {
                    'page' : apiPage
                }
            }) .then((response) =>{
                this.posts = response.data.result.data; //aggiungo i post all'interno dell'array vuoto
                this.currentPage = response.data.result.current_page; //prendo il valore della pagina corrente
                this.lastPage = response.data.result.last_page; //prendo il valore dell'ultima
            });
        }
    },
    created() {
        this.getPosts();  //alla creazione della pagina richiamo la funzione che effettua la chiamata Axios
    }
}
</script>

<style>

</style>