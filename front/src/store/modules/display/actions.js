import MakeFilterSearchUrl from '../../../core/MakeFilterSearchUrl'
import FacyUrl from '../../../core/FacyUrl'
import axios from 'axios'

export default {
  // SET FILTERS
  set_filters: ({ commit, state }) => {
    return new Promise((resolve, reject) => {
      // LOAD PAGE // SET SELECT SEARCH FROM PARAMTERS
      const filterSearchURL = new MakeFilterSearchUrl(state.selectSearch.originalData, state.formOptions)
      // SEARCH ALL FORM OPTIONS
      for (const prop in state.selectSearch.originalData) {
        // get paramter filter like categoria=2-3 will return  category = [2,3]
        const valueFilter = filterSearchURL.getParamterURL(prop)
        if (valueFilter) {
          // IS ARRAY
          if (state.selectSearch.get(prop) instanceof Array) {
            // SET NEW VALUE FOT THE FILTER
            commit('SET_FILTER_DISPLAY', { prop: prop, valueFilter: valueFilter })
            continue
          }

          if (Object.prototype.hasOwnProperty.call(valueFilter, 0)) {
            commit('SET_FILTER_DISPLAY', { prop: prop, valueFilter: valueFilter[0] })
          }
        }
      }

      resolve(true)
    })
  },

  clear_all_filters: ({ commit, state, getters }) => {
    return new Promise((resolve) => {
      commit('CLEAR_ALL_FILTERS')
      resolve(true)
    })
  },

  set_location_options: ({ commit, state, getters }, selectedFilter) => {
    commit('SET_LOCATION_OPTIONS', { selectedFilter: selectedFilter, tempOptions: getters.tempOptions(selectedFilter) })
  },

  // LOAD FORM OPTIOONS
  load_form_options: ({ commit, state, getters }, data) => {
    const formOptionExtention = getters.formOptionExtention(data)

    return new Promise((resolve, reject) => {
      axios.get(state.pageInfo.LOAD_FORM_OPTIONS_URL + formOptionExtention)
        .then(response => {
          commit('SET_FORM_OPTIONS', response.data)

          resolve(true)
        })
    }).catch(error => {
      console.log(error)
    })
  },

  // CHANGE LOADING PAGE STATUS
  change_loading_page_status: ({ commit, state }, status) => {
    commit('SET_DISPLAY_LOADING_PAGE', status)
  },

  // SET PAGINATION FOR THE FIRST TIME
  setFirstPaginationPagination: ({ commit, state, getters }) => {
    return new Promise((resolve, reject) => {
      const page = getters.urlValue('pagina')
      const pageNumber = !page || page === 'undefined' ? 1 : page

      // GO TO PAGINATION NUMBER
      commit('SET_DISPLAY_PAGINATION_CHANGED', pageNumber)

      window.scrollTo(0, 0)
      resolve(true)
    })
  },

  // CHANGE THE PAGINATION
  changePagePagination: ({ commit, state }, page) => {
    return new Promise((resolve, reject) => {
      // GO TO PAGINATION NUMBER
      commit('SET_DISPLAY_PAGINATION_CHANGED', page)

      window.scrollTo(0, 0)
      resolve(true)
    })
  },

  // LOAD THE PAGE
  load_pages: ({ commit, state, getters }, data) => {
    const firstLoad = getters.firstLoad(data)
    return new Promise((resolve, reject) => {
      // TIME TO WAIT
      const waitingTime = firstLoad ? 0 : 400
      // NEW URL to FILTER
      const newUrlPage = state.selectSearch(state.pagination.pagination.current_page)
      const url = state.pageInfo.LOAD_DISPLAY_URL + '?' + newUrlPage.filters + '&' + newUrlPage.pagination
      axios.get(url)
        .then(response => {
          // filters
          const wait = setTimeout(() => {
            clearTimeout(wait)
            // POPULATE
            commit('SET_DISPLAY_DATA', response.data.data)

            // LOAD THE DATA
            commit('SET_DISPLAY_PAGINATION', response.data.pagination)

            // LOAD THE DATA
            commit('SET_DISPLAY_PAGINATION_NUMBERS')

            // SET SEARCH URL
            commit('SET_DISPLAY_SEARCH_URL', state.pageInfo.LOAD_DISPLAY_URL + newUrlPage.filters)

            // SET SEARCH URL
            commit('SET_DISPLAY_OLD_FILTER', { filters: newUrlPage.filters, pagination: newUrlPage.pagination })

            // SET STATUS
            commit('SET_VERIFY_HAS_FILTERS', newUrlPage.hasFilterSelected)
            resolve({ ...response.data, ...{ query: newUrlPage.filters, page: state.pagination.pagination.current_page } })
          }, waitingTime)
        })
    })
  },

  make_fancy_redirect_link: ({ commit, state }) => {
    return new Promise((resolve, reject) => {
      // FANCY URL
      const newURL = new FacyUrl(state.selectSearch, state.formOptions)
      const urlFancydFilters = newURL.getURL(state.pagination.pagination.current_page, null)

      resolve(urlFancydFilters)
    })
  },

  // MAKE FANCY URL
  makeFancyURL: ({ commit, state }, typeSearch = null) => {
    return new Promise((resolve, reject) => {
      // FANCY URL
      const newURL = new FacyUrl(state.selectSearch, state.formOptions)
      const urlFancydFilters = newURL.getURL(state.pagination.pagination.current_page, typeSearch)

      // CHANGE FANCY URL
      window.history.pushState('', '', state.pageInfo.PAGE_URL + urlFancydFilters)

      resolve(true)
    })
  },

  // SET FILTER
  setFilter: ({ commit }, data) => {
    commit('SET_FILTER', data)
  },

  remove_filter_element: ({ commit }, data) => {
    commit('REMOVE_FILTER_ELEMENT', data)
  }
}
