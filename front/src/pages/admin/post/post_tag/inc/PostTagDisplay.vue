<template>
    <tr>
        <td>
            <label class="checkbox checkbox-blue" >
                <one-check  v-model="selectedData" :namelist="'list_' + index" :value="selectedData" ></one-check>
            </label>
        </td>

        <td>
          <ul class="list_display_area">
            <li>Título: {{ list.title }}</li>
            <li>Notícias Cadastradas:
              <span v-if="! list.posts_count" class="resultdisplaynumber" >0</span>
              <router-link :to="{ name: 'PostDisplay',  query: { arquivo: list.url_title }, params: { init:true }  }" v-else  >
                <span class="resultdisplaynumber">{{ list.posts_count }}</span>
              </router-link>
            </li>
          </ul>
        </td>

        <td class="col_action" >
            <ul class="actions-table-list">
                <li>
                    <a   class="link edit_btn hint--top" href="#" aria-label="Editar" @click.prevent="editItem()" >
                        <font-awesome-icon icon="edit" />
                    </a>
                </li>

                <li>
                    <a   class="link delete_btn hint--top" href="#" aria-label="Deletar" @click.prevent="deleteItem()" >
                        <font-awesome-icon icon="trash-alt"/>
                    </a>
                </li>

            </ul>
        </td>
    </tr>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'
import OneCheck from 'src/components/OneCheck'

export default {
  name: 'PostTagDisplay',
  props: {
    list: { type: Object },
    index: { type: Number }
  },
  components: {
    OneCheck
  },
  methods: {
    viewItem () {
      this.setSelectedIndex(this.index)
      this.openModel('view')
    },
    editItem () {
      this.setSelectedIndex(this.index)
      this.openModel('edit')
    },
    deleteItem () {
      this.setSelectedIndex(this.index)
      this.openModel('delete')
    },

    ...mapMutations('adminPostTag', {
      openModel: 'OPEM_MODAL',
      setSelectedIndex: 'SET_SELECTED_INDEX',
      setSelectedItems: 'SET_SELECTED_ITEMS'
    })
  },
  computed: {
    selectedData: {
      get () {
        return !!this.selectedItems.includes(this.index)
      },
      set () {
        this.setSelectedItems(this.index)
      }
    },

    ...mapGetters('adminPostTag', {
      selectedItems: 'selectedItems'
    })

  }
}
</script>

<style scoped>

</style>
