<template>

    <div class="content">
        <modal-save  type="create"  v-if="modal('create')"  ></modal-save>
        <modal-save  type="edit"  v-if="modal('edit')"  ></modal-save>
        <modal-delete  type="delete-one" v-if="modal('delete')"   ></modal-delete>
        <modal-delete  type="delete-many" v-if="modal('delete_many')"   ></modal-delete>
        <modal-view v-if="modal('view')" ></modal-view>

        <!-- columns -->
        <div class="columns">
            <h1 class="main-title">{{ pageInfo.TITLE_NAME_PLURAL }}</h1>
            <div class="column">
                <ul class="nav-btn-actions-top">
                    <li><one-search namefilter="title"
                                    :initialvalue="filters.title"
                                    @loadfilters="loadFilters"
                                    v-if="componentIsLoaded" ></one-search></li>
                    <li v-if="selectedItems.length"><a  @click.prevent="openModel('delete_many')" class="btn btn-light"  ><font-awesome-icon icon="trash-alt"/> Deletar</a></li>
                  <li v-if="hasFilterSelected"><a  @click.prevent="clearFilters()" class="btn btn-light"  ><font-awesome-icon icon="ban"/> Remover Filtros</a></li>
                  <li><a @click.prevent="openModel('create')"  class="btn btn-light"   ><font-awesome-icon icon="plus"/> Adicionar</a></li>
                </ul>
            </div>
        </div>
        <!-- end columns -->

        <!-- main-content -->
        <div class="columns" id="main-content" >
            <!-- column -->
            <div class="column">

                <!-- card -->
                <div class="card">
                    <!-- card-header -->
                    <div class="card-header">
                        <p>{{ paginationTotal }} Registros Encontrados</p>
                    </div>
                    <!-- end card-header -->

                    <!-- card-body -->
                    <div class="card-body" >

                        <table class="table">
                            <thead>
                            <th>
                                <one-check  v-model="selectAll" :value="selectAll"  namelist="select-all"  ></one-check>
                            </th>
                            <th>
                                Informações
                            </th>
                            <th class="col_action">
                                Ação
                            </th>
                            </thead>

                            <tbody>

                            <post-tag-display v-for="( posttag , index )  in displayItems"
                                               :index="displayItems.indexOf(posttag)"
                                               :list="posttag"
                                               :key="index" ></post-tag-display>

                            </tbody>
                        </table>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->

                <!-- PAGINATION -->
                <pagination :title="pageInfo.TITLE_NAME_PLURAL + ' Encontradas'"
                            :titleplural="pageInfo.TITLE_NAME + ' Encontrada'"
                            :paginationdata="paginationData"
                            @changepage="changePage" ></pagination>
            </div>
            <!-- end column -->

        </div>
        <!-- end columns -->

    </div>
    <!-- end content-->
</template>

<script>
import { mapGetters, mapMutations } from 'vuex'

// COMPONENTS
import Pagination from 'src/components/Pagination'
import OneSearch from 'src/components/OneSearch'

import ModalSave from './inc/ModalSave'
import ModalDelete from './inc/ModalDelete'
import ModalView from './inc/ModalView'
import PostTagDisplay from './inc/PostTagDisplay'
import OneCheck from 'src/components/OneCheck'

export default {
  name: 'Display',
  components: {
    Pagination,
    ModalSave,
    ModalDelete,
    ModalView,
    OneSearch,
    PostTagDisplay,
    OneCheck
  },
  data () {
    return {
      filters: { title: '' }
    }
  },
  methods: {
    deleteManyItems () {
      this.$store.dispatch('adminPostTag/setManySelectItemByIndex', this.selectedItems)
      this.openModel('delete')
    },
    loadFilters (data) {
      // shows
      Promise.all([
        this.$store.dispatch('adminPostTag/setFilter', { value: data.value, name: data.name }),
        this.$store.dispatch('adminPostTag/load_pages')
      ]).then((res) => {
        // SE STATUS LOADING PAGE - FALSE
        this.$store.dispatch('adminPostTag/change_loading_page_status', false)
      })
    },
    clearFilters () {
      // LOADING PAGE IS FALSE
      this.setLoadingPage(true)

      // SET LOADING PAGE
      this.setComponentIsLoaded(false)
      // shows
      Promise.all([
        this.$store.dispatch('adminPostTag/reset_all_filters'),
        // LOAD THE PAGE
        this.$store.dispatch('adminPostTag/load_pages', { firstLoad: false }),
        // MAKE FANCY URL
        this.$store.dispatch('adminPostTag/makeFancyURL', false)
      ]).then((res) => {
        // LOADING PAGE IS FALSE
        this.setLoadingPage(false)

        // COMPONENT IS LOADED
        this.setComponentIsLoaded(true)
      })
    },
    loadPage () {
      // LOADING PAGE IS FALSE
      this.setLoadingPage(true)

      // SET LOADING PAGE
      this.setComponentIsLoaded(false)

      // shows
      Promise.all([
        // CLEAR FILTERS
        this.$store.dispatch('adminPostTag/clear_all_filters'),
        // CHENGE PAGE ONE
        this.$store.dispatch('adminPostTag/setFirstPaginationPagination')

      ]).then((res) => {
        // shows
        Promise.all([

          // SET FILTERS
          this.$store.dispatch('adminPostTag/set_filters'),

          // LOAD THE PAGE
          this.$store.dispatch('adminPostTag/load_pages')

        ]).then((res) => {
          // SET LOADING PAGE
          this.setComponentIsLoaded(true)

          // loading page is false
          this.setLoadingPage(false)
        })
      })
    },

    changePage (page) {
      // LOADING PAGE IS FALSE
      this.setLoadingPage(true)

      // SET LOADING PAGE
      this.setComponentIsLoaded(false)

      // shows
      Promise.all([
        // SET FILTERS
        this.$store.dispatch('adminPostTag/changePagePagination', page),
        // LOAD THE PAGE
        this.$store.dispatch('adminPostTag/load_pages', { firstLoad: false }),
        // MAKE FANCY URL
        this.$store.dispatch('adminPostTag/makeFancyURL', false)

      ]).then((res) => {
        // SE STATUS LOADING PAGE - FALSE
        this.$store.dispatch('adminPostTag/change_loading_page_status', false)

        // LOADING PAGE IS FALSE
        this.setLoadingPage(false)

        // COMPONENT IS LOADED
        this.setComponentIsLoaded(true)
      })
    },

    ...mapMutations('adminPostTag', {
      openModel: 'OPEM_MODAL',
      setForm: 'SET_FORM',
      resetSearch: 'RESET_SEARCH',
      setComponentIsLoaded: 'SET_COMPONENT_IS_LOADED',
      setSelectedIndex: 'SET_SELECTED_INDEX',
      setSelectionManySelection: 'SET_MANY_SELECTION',
      toogleAllSelections: 'TOOGLE_ALL_SELECTIONS'
    }),
    ...mapMutations('adminMain', {
      setLoadingPage: 'SET_LOADING_PAGE'
    })

  },
  watch: {
    /*  paginationTotal: function (val) {
                  this.changePage(this.paginationData.current_page);
              } , */

  },
  computed: {
    ...mapGetters('adminPostTag', {
      pageInfo: 'pageInfo',
      pageLoading: 'pageLoading',
      pagination: 'pagination',
      displayItems: 'displayItems',
      paginationData: 'paginationData',
      paginationTotal: 'paginationTotal',
      filter: 'filter',
      modal: 'modal',
      selectedItems: 'selectedItems',
      componentIsLoaded: 'componentIsLoaded',
      hasFilterSelected: 'hasFilterSelected'
    }),
    selectAll: {
      get () {
        return this.selectedItems.length === this.displayItems.length
      },
      set (value) {
        this.toogleAllSelections(value)
      }
    },

    filterTitle: {
      get () {
        return this.filter('title')
      },
      set (value) {
        return this.$store.dispatch('adminPostTag/setFilter', { value: value, name: 'title' })
      }
    }

  },
  mounted: function () {
    // reset search
    this.resetSearch()

    // IF IS THE FIRST LOAD SET THE PAGE = 1
    if (this.$route.params.init) {
      this.$store.dispatch('adminPostTag/changePagePagination', 1)
    }

    // load PAGE
    this.loadPage()
  }
}
</script>

<style scoped>
</style>
