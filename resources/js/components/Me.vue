<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div
          class="container-fluid"
          style="margin-left:-2vh;color: #fff;background-color:#2B2F30;height:100vh"
        >
          <div class="row justify-content-center rowfoto">
            <img class="avatar" src="img/1.jpg" />
            <h1>Rafael Cruz</h1>
            <h3>Fullstack Developer</h3>
          </div>
          <div class="row">
            <ul class="list-group list-group-flush" style="width:100%;">
              <a v-on:click="component='sobre'" href="#">
                <li
                  class="list-group-item d-flex justify-content-between align-items-center"
                >Sobre mim</li>
              </a>
              <a v-on:click="component='projetos'" href="#">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Projetos
                  <span
                    class="badge badge-primary badge-pill"
                    style="background-color:#0F3356"
                  >3</span>
                </li>
              </a>
              <a href="#cv" data-toggle="collapse">
                <li class="list-group-item d-flex justify-content-between align-items-center">CV</li>
              </a>
              <div class="collapse" id="cv">
                <ul class="list-group" style="padding-left:5%;">
                  <a href="/storage/cv/CV-Ingles.pdf"><li class="list-group-item">CV-Inglês</li></a>
                  <a href="/storage/cv/CV.pdf"><li class="list-group-item">CV-Português</li></a>
                </ul>
              </div>
              <a v-on:click="component='contactos'" href="#">
                <li
                  class="list-group-item d-flex justify-content-between align-items-center"
                >Contactar</li>
              </a>
            </ul>
          </div>
          <div class="row justify-content-center socialicons">
            <a href="https://github.com/rfloka">
              <i class="fab fa-github-square space"></i>
            </a>
            <a href="https://www.linkedin.com/in/rafael-v-cruz/">
              <i class="fab fa-linkedin space"></i>
            </a>
            <a href="https://www.facebook.com/rafael.dinis.7">
              <i class="fab fa-facebook-square space"></i>
            </a>
            <a href="https://twitter.com/VCruz241">
              <i class="fab fa-twitter-square"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-9" style="height:100vh;overflow-y:scroll;">
        <component v-bind:is="component"></component>
      </div>
    </div>
  </div>
</template>
<script>
import Projetos from "./Projetos.vue";
import Sobre from "./Sobre.vue";
import Contactos from "./Contactos.vue";
export default {
  components: {
    projetos: Projetos,
    sobre: Sobre,
    contactos: Contactos,
  },
  data() {
    return {
      component: "projetos"
    };
  }
};
</script>
<style scoped>
li {
  background-color: #2b2f30;
}
a {
  color: #fff;
  text-decoration: none; /* no underline */
}
li:hover {
  background-color: #0f3356;
}
i:hover {
  color: rgb(37, 85, 133);
}
.rowfoto {
  background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),
    url(/img/2.jpg) center center no-repeat;
  background-size: 100% 100%;
}
.avatar {
  margin-top: 5%;
  margin-bottom: 1%;
  width: 55%;
  border-radius: 50%;
}
.social {
  margin-top: 3%;
  margin-bottom: 0%;
}
.socialicons {
  text-align: center;
  font-size: 40px;
  position: absolute;
  bottom: 0;
  left: 28%;
}
.space {
  padding-right: 10px;
}
</style>