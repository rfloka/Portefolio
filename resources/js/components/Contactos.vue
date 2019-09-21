<template>
  <div class="container-fluid" style="margin-top:2%;">
    <div class="row justify-content-center">
      <h1>Contacte-me</h1>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div v-if="sent" class="alert alert-success" role="alert">
          <i class="fas fa-paper-plane"></i> Mensagem Enviada — Entrarei em contacto consigo dentro de 3 dias
        </div>
        <div v-if="erro" class="alert alert-danger" role="alert">
          <i class="fas fa-bomb"></i> Algo aconteceu 
        </div>
        <form @submit.prevent="enviarMensagem">
          <div class="form-group">
            <label>Nome</label>
            <input
              v-model="contact.nome"
              type="text"
              name="nome"
              class="form-control"
              :class="{'is-invalid':error['nome']}"
            />
            <small v-if="error['nome']" class="form-text">Insira um nome válido</small>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input
              v-model="contact.email"
              type="text"
              name="email"
              class="form-control"
              :class="{'is-invalid':error['email']}"
            />
            <small v-if="error['email']" class="form-text">Insira um email válido</small>
          </div>
          <div class="form-group">
            <label>Telefone</label>
            <input
              v-model="contact.telefone"
              type="number"
              name="telefone"
              class="form-control"
              :class="{'is-invalid':error['telefone']}"
            />
            <small v-if="error['telefone']" class="form-text">Insira um número de telefone válido</small>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Mensagem</label>
            <textarea
              :class="{'is-invalid':error['mensagem']}"
              name="mensagem"
              class="form-control"
              rows="5"
              v-model="contact.mensagem"
            ></textarea>
            <small
              v-if="error['mensagem']"
              class="form-text"
            >Insira uma mensagem válida com pelo menos 30 caracteres</small>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-default butao btn-block">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      sent: false,
      erro: false,
      contact: {
        nome: "",
        email: "",
        telefone: "",
        mensagem: ""
      },
      error: {
        email: false,
        nome: false,
        telefone: false,
        mensagem: false
      }
    };
  },
  methods: {
    enviarMensagem: function() {
      this.error = {
        email: false,
        nome: false,
        telefone: false,
        mensagem: false
      };
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if (
        this.contact.email == "" ||
        !re.test(String(this.contact.email).toLowerCase())
      ) {
        this.error["email"] = true;
      }
      if (this.contact.nome.length < 3) {
        this.error["nome"] = true;
      }
      if (this.contact.telefone.length != 9) {
        this.error["telefone"] = true;
      }
      if (this.contact.mensagem.length < 30) {
        this.error["mensagem"] = true;
      }
      if (
        !this.error["mensagem"] &&
        !this.error["telefone"] &&
        !this.error["nome"] &&
        !this.error["email"]
      ) {
        fetch("contacto/enviar", {
          method: "post",
          headers: {
            "content-type": "application/json",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
          },
          body: JSON.stringify(this.contact)
        })
          .then(res => {
            if (res.status != 200) {
              this.erro = true;
            }else{
              this.sent = true;
            }
          })
          .catch(err => console.log(err));
      }
    }
  }
};
</script>
<style scoped>
small {
  color: red;
}
p {
  font-size: 25px;
  color: #2b2f30;
}

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
