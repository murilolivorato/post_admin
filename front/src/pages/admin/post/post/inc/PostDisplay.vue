<template>
    <tr>
        <td>
            <label class="checkbox checkbox-blue" >
                <one-check  v-model="selectedData" :namelist="'list_' + index" :value="selectedData" ></one-check>
            </label>
        </td>

        <td>
          <img :src="imgURL" class="imglist" >
        </td>

        <td>
              <ul class="list_display_area">
                <li>Status: {{ optionSelected({idSelected: list.status, options:formOptions('status')}) }}</li>
                <li>Título :{{ list.title }}</li>
                <li v-if="list.post_category">Categoria -
                      <router-link :to="{ name: 'PostCategoryDisplay',  query: { 'titulo': list.post_category.url_title }, params: { init:true }  }" >
                        {{ list.post_category.title }}
                      </router-link>
                </li>
                <li v-if="list.post_user">
                          Usuário   -
                        <router-link :to="{ name: 'PostUserDisplay',  query: { 'titulo': list.post_user.url_title }, params: { init:true }  }" >
                          {{ list.post_user.title }}
                        </router-link>
                </li>
                <li v-if="list.post_tags">
                        Arquivo   -
                      <router-link :to="{ name: 'PostTagDisplay',  query: { 'titulo': post_tag.url_title }, params: { init:true }  }"  v-for="( post_tag , index ) in list.post_tags"  :key="index" >
                         <span v-if="index === 0"> {{ post_tag.title }} </span>
                         <span v-else>, {{ post_tag.title }} </span>
                      </router-link>
                </li>
                <li v-if="list.image_gallery">Galeria de Imagem   - {{ list.image_gallery.title }}</li>
                <li v-if="list.file_gallery">Galeria de Arquivo   - {{ list.file_gallery.title }}</li>
                <li v-if="list.videos">Vídeos   - {{ list.videos.length }}</li>
             </ul>
        </td>

        <td class="col_action" >
            <ul class="actions-table-list">

                <li>
                    <router-link  class="link view_btn hint--top"  aria-label="Visualizar" target="_blank"  :to="{ name: 'NewsDestail', params: { url_title: list.url_title  } }"  >
                        <font-awesome-icon icon="external-link-alt"/>
                    </router-link>
                </li>

                <li>
                    <router-link :to="{ name: 'EditPost', params: { id: list.id  } }" class="link edit_btn hint--top" href="#" aria-label="Editar"  >
                        <font-awesome-icon icon="edit" />
                    </router-link>
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
import OneCheck from 'src/components/OneCheck'
import { mapGetters, mapMutations } from 'vuex'

export default {
  name: 'PostDisplay',
  props: {
    list: { type: Object },
    index: { type: Number }
  },
  components: {
    OneCheck
  },
  methods: {
    getTitleModel (item, model) {
      if (item[model]) {
        return item[model].title
      }
    },
    getTitleModelList (item, model) {
      if (!item[model]) {
        return
      }

      let list = ''
      if (item[model].length) {
        item[model].forEach((v, i) => {
          list = i === 0 ? v.title : list + ' ,' + v.title
        })
      }

      return list
    },
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
    ...mapMutations('adminPost', {
      openModel: 'OPEM_MODAL',
      setSelectedIndex: 'SET_SELECTED_INDEX',
      setSelectedItems: 'SET_SELECTED_ITEMS'
    })
  },
  computed: {
    imgURL () {
      if (!this.list.image) {
        return
      }
      return this.pageInfo.URL_PATH + '/' + this.list.folder + '/' + this.list.image.image
    },
    selectedData: {
      get () {
        return !!this.selectedItems.includes(this.index)
      },
      set () {
        this.setSelectedItems(this.index)
      }
    },
    ...mapGetters('helpers', {
      optionSelected: 'optionSelected'
    }),
    ...mapGetters('adminPost', {
      selectedItems: 'selectedItems',
      formOptions: 'formOptions',
      pageInfo: 'pageInfo'
    })

  }
}
</script>

<style scoped>

</style>
