<template>
    <modal  @close="closeDeleteModal()"  :closeoutside="true" >
        <template slot="header" ><h4>Deletar {{ titleText }}  </h4></template>
        <template slot="body" >
                 <!-- COMPONENT IS LOADED -->
                <div v-if="componentIsLoaded">
                             <!-- IS ALOUDED -->
                            <div v-if="aloud">
                                    <form method="POST" action="" @submit.prevent="storeForm()">
                                                <div class="modal-body">
                                                    <p v-if="selectionList.length">Tem Certeza que deseja deletar  ?</p>
                                                    <p v-if="! selectionList.length">Selecione uma {{ titleText }} para deletar</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="lightOne"  @click="closeDeleteModal()" >Fechar</button>
                                                    <submit-btn :processloading="processingForm"
                                                                textbutton="Deletar"
                                                                stylebutton="btn_cl_left is-link"
                                                                v-if="selectionList.length" ></submit-btn>
                                                </div>
                                            </form>
                              </div>
                             <!-- END IS ALOUDED -->

                            <!-- ELSE -->
                            <div v-else>
                                 <p v-if="selectionList.length"> Existem uma ou mais Notícias Cadastradas nestas Categorias , você precisa primeiro deletar as Notícias , para depois deletar a Categoria .   ?</p>
                                 <p v-if="! selectionList.length">Existe uma ou mais Notícias Cadastradas nesta Categoria , você precisa primeiro deletar a Notícia , para depois deletar a Categoria .</p>
                                 <div class="modal-footer">
                                     <button type="button" class="lightOne"  @click="closeDeleteModal()" >Fechar</button>
                                     <button @click.prevent="linkRelatedItemToDelete()" class="submit_1 btn_side_left" >  Deletar Notícias </button>
                                 </div>
                            </div>
                            <!-- END ELSE -->
                    </div>
                    <!-- END COMPONENT IS LOADED -->

        </template>
    </modal>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'

// COMPONENTS
import Modal from 'src/components/Modal'
import SubmitBtn from 'src/components/SubmitBtn'

export default {
  name: 'ModalDelete',
  components: {
    Modal,
    SubmitBtn
  },
  props: {
    type: { type: String }
  },
  data () {
    return {
      selectionList: [],
      aloud: true,
      linkToDeleteRelated: '',
      componentIsLoaded: false,
      processingForm: false
    }
  },
  methods: {
    closeDeleteModal () {
      if (this.type === 'delete-one') {
        this.closeModel('delete')
        return
      }
      this.closeModel('delete_many')
    },
    setSelection () {
      if (this.type === 'delete-one') {
        this.setSelectionOne()
        return
      }

      this.setSelectionMany()
    },
    setSelectionOne () {
      this.selectionList = [{ id: this.displayItems[this.selectedIndex].id, index: this.selectedIndex }]
    },
    setSelectionMany () {
      this.selectedItems.forEach((item, i) => {
        this.selectionList.push({ id: this.displayItems[item].id, index: item })
      })
    },
    verifyCanDelete () {
      this.selectionList.forEach((item, i) => {
        // HAS POST , DONT ALOUD TO DELETE
        if (this.displayItems[item.index].posts_count > 0) {
          const urltitle = this.displayItems[item.index].url_title

          // IF IS EMPTY - ADD
          this.linkToDeleteRelated = this.linkToDeleteRelated !== '' ? this.linkToDeleteRelated + '-' + urltitle : urltitle

          this.aloud = false
        }
      })
    },
    linkRelatedItemToDelete () {
      // CLOSE DELETE MODAL
      this.closeModel('delete')

      // GO LINK
      this.$router.push({ name: 'PostDisplay', query: { categoria: this.linkToDeleteRelated }, params: { init: true } })
    },
    storeForm () {
      this.processingForm = true

      this.$store.dispatch('adminPostCategory/destroy', { delete: this.selectionList }).then((res) => {
        this.processingForm = false

        // CLOSE DELETE MODAL
        this.closeDeleteModal()

        // SWEET ALERT
        this.$swal({
          icon: 'success',
          title: 'Categorias Deletadas',
          showConfirmButton: false,
          timer: 2000
        })

        this.reloadPage()
      }).catch(error => {
        console.log(error.errors)
      })
    },
    reloadPage () {
      // LOAD THE PAGE
      this.$store.dispatch('adminPostCategory/load_pages')
    },
    ...mapMutations('adminPostCategory', {
      closeModel: 'CLOSE_MODAL'
    }),
    ...mapMutations('adminMain', {
      setLoadingPage: 'SET_LOADING_PAGE'
    })
  },
  computed: {
    titleText () {
      return this.selectionList.length < 2 ? this.pageInfo.TITLE_NAME
        : this.pageInfo.TITLE_NAME_PLURAL
    },
    ...mapGetters('adminPostCategory', {
      modal: 'modal',
      pageInfo: 'pageInfo',
      displayItems: 'displayItems',
      selectedIndex: 'selectedIndex',
      selectedItems: 'selectedItems'
    })
  },
  created () {
    // SET SELECTION
    this.setSelection()

    // VERIFY CAN DELETE
    this.$nextTick(function () {
      this.verifyCanDelete()
    })

    this.componentIsLoaded = true
  }
}
</script>

<style scoped>

</style>
