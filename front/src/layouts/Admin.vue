<template>
    <div id="app">
        <!-- IMAGE MODAL --->
        <modal-image  v-if="modal('image')" @close="closeModal('image')" :imageselected="selectedImage"   ></modal-image>

        <!-- @loading page --->
        <div class="loading_bg" v-if="loadingPage == true"><div class="text-center"><div class="mloading-bar">Carregando ...</div></div></div>
        <div class="sidebar"  >
            <div class="sidebar-wrapper">
                <div class="row image-profile-area">
                    <figure class="image  is-64x64">
                        <img class="is-rounded"  :src="imgProfile"  >
                    </figure>
                    <div class="description">
                        <h4> {{ userInfoDesc }} </h4>
                    </div>
                </div>

                <div class="row">
                    <ul class="nav" >
                        <li class="cat_list " >
                            <router-link  :to="{ name: 'AdminHome'}" class="top" >
                                <font-awesome-icon icon="home"  />
                                <p>Home</p>
                            </router-link>
                        </li>

                        <li class="cat_list "   >
                            <a href="#" @click.prevent="change_sb_menu_status($event)" class="top" >
                                <font-awesome-icon icon="newspaper"  />
                                <p>Notícia</p>
                            </a>

                            <ul class="sub_menu " >
                                <li>
                                    <router-link  :to="{ name: 'PostDisplay'}"  >
                                        <p>Notícias</p>
                                    </router-link>
                                </li>

                                <li>
                                    <router-link  :to="{ name: 'PostCategoryDisplay'}"  >
                                        <p>Categoria de Notícias</p>
                                    </router-link>
                                </li>

                                <li>
                                    <router-link  :to="{ name: 'PostUserDisplay'}"  >
                                        <p>Usuário de Notícias</p>
                                    </router-link>
                                </li>

                                <li>
                                    <router-link  :to="{ name: 'PostTagDisplay'}"  >
                                        <p>Arquivo de Notícias</p>
                                    </router-link>
                                </li>

                            </ul>
                        </li>

                        <li class="cat_list "   >
                            <a href="#" @click.prevent="change_sb_menu_status($event)" class="top" >
                                <font-awesome-icon icon="newspaper"  />
                                <p>Produtos</p>
                            </a>

                            <ul class="sub_menu " >
                                <li>
                                    <router-link  :to="{ name: 'ProductDisplay'}"  >
                                        <p>Produtos</p>
                                    </router-link>
                                </li>

                                <li>
                                    <router-link  :to="{ name: 'ProductCategoryDisplay'}"  >
                                        <p>Categoria de Produtos</p>
                                    </router-link>
                                </li>

                                <li>
                                    <router-link  :to="{ name: 'ProductSubCategoryDisplay'}"  >
                                        <p>Sub Categoria de Produtos</p>
                                    </router-link>
                                </li>

                                <li>
                                    <router-link  :to="{ name: 'ProductTagDisplay'}"  >
                                        <p>Arquivos de Produtos</p>
                                    </router-link>
                                </li>

                                <li>
                                    <router-link  :to="{ name: 'ProductDiscountDisplay'}"  >
                                        <p>Descontos de Produtos</p>
                                    </router-link>
                                </li>

                                <li>
                                    <router-link  :to="{ name: 'ProductManufactureDisplay'}"  >
                                        <p>Fabricantes</p>
                                    </router-link>
                                </li>

                                <li>
                                    <router-link  :to="{ name: 'ProductSearchKeyDisplay'}"  >
                                        <p>Buscas</p>
                                    </router-link>
                                </li>

                            </ul>
                        </li>

                        <li class="cat_list"   >
                            <a href="#" @click.prevent="change_sb_menu_status($event)"  class="top">
                                <font-awesome-icon icon="images"  />
                                <p>Galerias</p>
                            </a>

                            <ul class="sub_menu" >

                                <li>
                                    <router-link  :to="{ name: 'GalleryImageDisplay'}"  >
                                        <p>Galeria de Imagens</p>
                                    </router-link>
                                </li>

                                <li>
                                    <router-link  :to="{ name: 'GalleryFileDisplay'}"  >
                                        <p>Galeria de Arquivos</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <router-link  :to="{ name: 'UserAdminDisplay'}"  >
                                <font-awesome-icon icon="user-cog"  />
                                <p>Usuários do Sistema</p>
                            </router-link>
                        </li>

                        <li>
                            <a href="#" @click.prevent="logout()" class="top">
                                <font-awesome-icon icon="sign-out-alt"  />
                                <p>Logout</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <!-- main-panel -->
        <div class="main-panel">
            <router-view></router-view>
        </div>
        <!-- end main-panel -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="credits ml-auto">
                                  <span class="copyright">
                                    ©2020 Admin
                                  </span>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'
import ModalImage from 'src/components/ModalImage'

export default {
  name: 'AdminApp',
  components: {
    ModalImage
  },
  methods: {
    change_sb_menu_status (event) {
      const eventlist = event.target
      eventlist.parentElement.parentElement.lastChild.classList.toggle('open')
    },
    logout () {
      this.$store.commit('adminLogin/LOG_OUT')
      window.location.href = '/acesso-admin'
    },
    ...mapMutations('main', {
      closeModal: 'CLOSE_MODAL',
      openModal: 'OPEM_MODAL'
    })
  },
  computed: {
    imgProfile () {
      return process.env.API_URL + this.currentUser.image_profile
    },
    userInfoDesc () {
      return this.capitalizeFirstLetter(this.currentUser.name) + ' ' + this.capitalizeFirstLetter(this.currentUser.last_name)
    },

    ...mapGetters('adminMain', {
      loadingPage: 'loadingPage'
    }),

    ...mapGetters('main', {
      modal: 'modal',
      selectedImage: 'selectedImage'
    }),

    ...mapGetters('adminMain', {
      currentUser: 'currentUser'
    }),

    ...mapGetters('helpers', {
      capitalizeFirstLetter: 'capitalizeFirstLetter'
    })

  }

}
</script>

<style scoped>

div.image-profile-area {
    padding-top:30px;
    padding-bottom:20px;
    padding-left:20px;
}

div.image-profile-area figure{
    float:left;
}

div.image-profile-area div.description{
    float:left;
    width:100px;
    padding-left:20px;
}
div.image-profile-area div.description h4{
    color:#b9bdc6;
    font-size:19px;
}

</style>
