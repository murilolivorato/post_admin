<template>
    <modal  @close="closeDeleteModal()"  >
        <template slot="header" ><h4>Deletar {{ pageInfo.TITLE_NAME }}</h4></template>
        <template slot="body" >
            <form method="POST" action="" @submit.prevent="storeForm()">
                <div class="modal-body">
                    <p v-if="selectionList.length">Tem Certeza que deseja deletar  este {{ pageInfo.TITLE_NAME }} ?</p>
                    <p v-if="! selectionList.length">Selecione uma {{ pageInfo.TITLE_NAME }} para deletar</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="lightOne"  @click="closeDeleteModal()" >Fechar</button>
                    <submit-btn :processloading="processingForm" :textbutton="'Deletar'"   stylebutton="btn_cl_left is-link"  ></submit-btn>
                </div>
            </form>
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
      componentIsLoaded: false,
      processingForm: false
    }
  },

  computed: {
    ...mapGetters('adminPost', {
      modal: 'modal',
      selectedItems: 'selectedItems',
      pageInfo: 'pageInfo',
      displayItems: 'displayItems',
      selectedIndex: 'selectedIndex'
    })
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
    storeForm () {
      this.processingForm = true

      this.$store.dispatch('adminPost/destroy', { delete: this.selectionList }).then((res) => {
        this.processingForm = false

        // CLOSE DELETE MODAL
        this.closeDeleteModal()

        // SWEET ALERT
        this.$swal({
          icon: 'success',
          title: 'Notícia Deletada',
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
      this.$store.dispatch('adminPost/load_pages')
    },
    ...mapMutations('adminPost', {
      closeModel: 'CLOSE_MODAL'
    }),
    ...mapMutations('adminMain', {
      setLoadingPage: 'SET_LOADING_PAGE'
    })
  },
  created () {
    // SET SELECTION
    this.setSelection()

    this.componentIsLoaded = true
  }
}
</script>

<style scoped>

</style>
