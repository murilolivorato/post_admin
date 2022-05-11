
<template>
    <!-- row -->
    <div class="columns" >
        <div class="column">
            <!-- PAGINATION TOTAL -->
            <div class="pagination-total" v-if="showpaginationtotal">
                    <p v-if="!paginationdata.pagination_numbers" class="paginationRegister">{{ title }}</p>
                    <p v-else class="paginationRegister"><span class="sp2"> {{ paginationdata.total_pagination }} </span> {{ titleplural }}</p>
            </div>

            <!-- pagination -->
            <nav class="pagination is-rounded is-centered" role="navigation"  >
                <a v-if="paginationdata.current_page > 1" href="#" aria-label="Previous" class="pagination-previous" @click.prevent="goPrevPage()">
                    <span aria-hidden="true">«</span>
                </a>

                <a  v-if="paginationdata.current_page < paginationdata.last_page" href="#" aria-label="Next" class="pagination-next"  @click.prevent="goNextPage()">
                    <span aria-hidden="true">»</span>
                </a>

                <ul class="pagination-list" v-if="paginationdata.total_pagination > paginationdata.per_page_pagination" >
                    <li v-for="(page, index ) in paginationdata.pagination_numbers"  :key="index" >
                        <a href="#" @click.prevent="changePage(page)"  v-bind:class="page == paginationdata.active_pagination ? 'pagination-link is-current' : 'pagination-link'">
                            {{ page }}
                        </a>
                    </li>
                </ul>

            </nav>
            <!-- end pagination  -->
        </div>
    </div>
</template>
<script>
export default {
  name: 'Pagination',
  props: {
    title: { type: String },
    titleplural: { type: String },
    paginationdata: { type: Object },
    showpaginationtotal: { type: Boolean, default: true }
  },
  methods: {

    goPrevPage () {
      // SEND COMMAND TO CLOSE OTHER BOXES
      this.$emit('changepage', this.paginationdata.current_page - 1)
    },
    goNextPage () {
      // SEND COMMAND TO CLOSE OTHER BOXES
      this.$emit('changepage', this.paginationdata.current_page + 1)
    },
    changePage (page) {
      this.$emit('changepage', page)
    }
  }

}
</script>
