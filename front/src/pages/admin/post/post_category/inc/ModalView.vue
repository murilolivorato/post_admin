<template>
    <modal  @close="closeModel('view')"  :closeoutside="true" >
        <template slot="header" ><h4>{{ pageInfo.TITLE_NAME }}</h4></template>
        <template slot="body" >

                <div class="modal-body">
                    <p>
                       {{  form.title }}
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="lightOne"  @click="closeModel('view')" >Fechar</button>
                </div>

        </template>
    </modal>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import Modal from 'src/components/Modal'
import FormDisplay from 'src/core/FormDisplay'

export default {
  name: 'ModalView',
  components: {
    Modal
  },
  data () {
    return {
      form: new FormDisplay({ id: '', index: '', title: '' })
    }
  },
  computed: {
    ...mapGetters('adminPostCategory', {
      selectedIndex: 'selectedIndex',
      displayItems: 'displayItems',
      pageInfo: 'pageInfo'
    })
  },

  methods: {
    ...mapMutations('adminPostCategory', {
      closeModel: 'CLOSE_MODAL'
    })
  },
  created () {
    // SET FORM
    this.form.setFillItem(this.displayItems[this.selectedIndex], this.selectedIndex)
  }
}
</script>

<style scoped>

</style>
