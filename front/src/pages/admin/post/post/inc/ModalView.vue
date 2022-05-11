<template>
    <modal  @close="closeModel('view')"  >
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
  created () {
    // SET ALL INPUT
    this.form.setFillItem(this.formList.data())
  },
  data () {
    return {
      form: new FormDisplay({ id: '', index: '', title: '' })
    }
  },
  computed: {
    ...mapGetters('adminPost', {
      formList: 'formList',
      pageInfo: 'pageInfo'
    })
  },

  methods: {
    ...mapMutations('adminPost', {
      closeModel: 'CLOSE_MODAL'
    })
  }
}
</script>

<style scoped>

</style>
