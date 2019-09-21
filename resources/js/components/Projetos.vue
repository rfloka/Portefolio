<template>
  <div class="container-fluid" style="margin-top:2%;">
    <div class="row justify-content-center">
      <h1>Projetos</h1>
    </div>
    <div v-if="projetos.length > 0">
      <div class="row justify-content-center">
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li v-bind:class="[{disabled:!pagination.prev_page_url}]" class="page-item">
              <a
                @click="fetchProjetos(pagination.prev_page_url)"
                class="page-link"
                href="#"
                aria-label="Previous"
              >
                <i class="fas fa-angle-left"></i>
              </a>
            </li>
            <li class="page-item disabled">
              <a
                class="page-link text-dark"
                href="#"
              >{{pagination.current_page}} de {{pagination.last_page}}</a>
            </li>
            <li v-bind:class="[{disabled:!pagination.next_page_url}]" class="page-item">
              <a
                @click="fetchProjetos(pagination.next_page_url)"
                class="page-link"
                href="#"
                aria-label="Next"
              >
                <i class="fas fa-angle-right"></i>
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-4" v-for="projeto in projetos" v-bind:key="projeto.id">
          <div class="card">
            <div style="height:280px;">
              <img
                v-bind:src="'/storage/projetospics/' + projeto.nome"
                class="card-img-top"
                alt="..."
                style="width: 100%;height: 100%;vertical-align: middle;object-fit: cover;"
              />
            </div>
            <div class="card-body">
              <h5 class="card-title">
                <h3 align="center">{{ projeto.titulo}}</h3>
              </h5>
              <p
                style="overflow: hidden;height: 50px;"
                v-html="projeto.descricao"
                class="card-text"
              ></p>
              <div v-if="projeto.url =='none'">
                <b>URL:</b>
                <i style="color:red;"  class="fas fa-times"></i> Sem Url
              </div>
              <div v-else>
                <b>URL:</b>
                <a :href="'//'+projeto.url">{{ projeto.url}}</a>
              </div>
              <div v-if="projeto.gitrepo=='none'">
                <b>Repositório:</b>
                <i style="color:red;" class="fas fa-times"></i> Sem Repositório
              </div>
              <div v-else>
                <b>Repositório:</b>
                <a :href="projeto.gitrepo">GitRepo</a>
              </div>
              <a class="btn btn butao btn-lg btn-block" :href="'projetos/'+projeto.id" role="button">Ver mais</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <div class="row justify-content-center">
        <h2>Não existem projetos</h2>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      projetos: [],
      projeto: {
        id: "",
        titulo: "",
        gitrepo: "",
        url: "",
        descricao: ""
      },
      pagination: {}
    };
  },
  created() {
    this.fetchProjetos();
  },
  methods: {
    async fetchProjetos(page_url) {
      let vm = this;
      page_url = page_url || "/api/projetos";
      await fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.projetos = res.data;
          vm.makePagination(res);
        })
        .catch(err => console.error(err));
    },
    makePagination(res) {
      let pagination = {
        current_page: res.current_page,
        last_page: res.last_page,
        next_page_url: res.next_page_url,
        prev_page_url: res.prev_page_url
      };
      this.pagination = pagination;
    }
  }
};
</script>
<style scoped>
h1 {
  font-weight: bolder;
  color: #0f3356;
}
.butao {
  color: #fff;
  background-color: #0f3356;
}
.butao:hover {
  color: #0f3356;
  background-color: #fff;
  border: 2px solid #0f3356;
}
</style>