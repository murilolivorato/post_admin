<template>

    <div class="content">
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

                        <li  v-if="selectedItems.length" ><a class="btn btn-light"  @click="openModel('delete_many')"  ><font-awesome-icon icon="trash-alt"/>  Deletar</a></li>
                        <li v-if="hasFilterSelected"><a  @click.prevent="clearFilters()" class="btn btn-light"  ><font-awesome-icon icon="ban"/> Remover Filtros</a></li>
                        <li><router-link class="btn btn-light" :to="{ name: 'CreatePost' }"><font-awesome-icon icon="plus"/> Criar</router-link></li>
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
                                                        Imagem
                                                    </th>

                                                    <th>
                                                        Informações
                                                    </th>

                                                    <th class="col_action">
                                                        Ação
                                                    </th>

                                                    </thead>

                                                    <tbody>

                                                    <post-display v-for="( post , index ) in displayItems"
                                                                  :index="displayItems.indexOf(post)"
                                                                  :list="post"
                                                                  :key="index" ></post-display>

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

import ModalDelete from './inc/ModalDelete'
import ModalView from './inc/ModalView'
import PostDisplay from './inc/PostDisplay'
import OneCheck from 'src/components/OneCheck'

export default {
  name: 'Display',
  components: {
    Pagination,
    ModalDelete,
    ModalView,
    OneSearch,
    PostDisplay,
    OneCheck
  },
  data () {
    return {
      filters: { title: '' }

    }
  },
  methods: {
    loadFilters (data) {
      // shows
      Promise.all([
        this.$store.dispatch('adminPost/setFilter', { value: data.value, name: data.name }),
        this.$store.dispatch('adminPost/load_pages')
      ]).then((res) => {
        // SE STATUS LOADING PAGE - FALSE
        this.$store.dispatch('adminPost/change_loading_page_status', false)
      })
    },
    clearFilters () {
      // LOADING PAGE IS FALSE
      this.setLoadingPage(true)

      // SET LOADING PAGE
      this.setComponentIsLoaded(false)
      // shows
      Promise.all([
        this.$store.dispatch('adminPost/reset_all_filters'),
        // LOAD THE PAGE
        this.$store.dispatch('adminPost/load_pages', { firstLoad: false }),
        // MAKE FANCY URL
        this.$store.dispatch('adminPost/makeFancyURL', false)
      ]).then((res) => {
        // LOADING PAGE IS FALSE
        this.setLoadingPage(false)

        // COMPONENT IS LOADED
        this.setComponentIsLoaded(true)
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
        this.$store.dispatch('adminPost/changePagePagination', page),
        // LOAD THE PAGE
        this.$store.dispatch('adminPost/load_pages', { firstLoad: false }),
        // MAKE FANCY URL
        this.$store.dispatch('adminPost/makeFancyURL', false)

      ]).then((res) => {
        // SE STATUS LOADING PAGE - FALSE
        this.$store.dispatch('adminPost/change_loading_page_status', false)

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
        // CLEAR FILTER
        this.$store.dispatch('adminPost/clear_all_filters'),
        // SET PAGINATION
        this.$store.dispatch('adminPost/setFirstPaginationPagination'),

        // load form options
        this.$store.dispatch('adminPost/load_form_options')

      ]).then((res) => {
        // shows
        Promise.all([

          // SET FILTERS
          this.$store.dispatch('adminPost/set_filters'),

          // LOAD THE PAGE
          this.$store.dispatch('adminPost/load_pages')

        ]).then((res) => {
          // SET LOADING PAGE
          this.setComponentIsLoaded(true)

          // loading page is false
          this.setLoadingPage(false)
        })
      })
    },
    ...mapMutations('adminPost', {
      openModel: 'OPEM_MODAL',
      setForm: 'SET_FORM',
      resetSearch: 'RESET_SEARCH',
      setComponentIsLoaded: 'SET_COMPONENT_IS_LOADED',
      toogleAllSelections: 'TOOGLE_ALL_SELECTIONS'
    }),
    ...mapMutations('adminMain', {
      setLoadingPage: 'SET_LOADING_PAGE'
    })

  },
  watch: {
    paginationTotal: function (val) {
      this.changePage(this.paginationData.current_page)
    }
  },
  computed: {
    selectAll: {
      get () {
        return !!(this.selectedItems.length === this.displayItems.length && this.selectedItems.length !== 0)
      },
      set (value) {
        this.toogleAllSelections(value)
      }
    },
    ...mapGetters('adminPost', {
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
    filterTitle: {
      get () {
        return this.filter('title')
      },
      set (value) {
        return this.$store.dispatch('adminPost/setFilter', { value: value, name: 'title' })
      }
    }

  },
  mounted: function () {
    // load PAGE
    this.loadPage()
  }
}
</script>

<style scoped>
</style>
