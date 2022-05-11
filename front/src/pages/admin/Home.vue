<template>
    <!-- content -->
    <div class="content" id="main-content" >
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Seja Bem Vindo</h5>
                    </div>

                    <!-- card-body -->
                    <div class="card-body  card_form " >
                        <p class="card-category">Olá Admin  , você está no sistema administrativo</p>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- end content -->
</template>

<script>
import { mapMutations } from 'vuex'

export default {
  name: 'home',
  methods: {
    ...mapMutations('adminMain', {
      setLoadingPage: 'SET_LOADING_PAGE'
    })
  },
  mounted: function () {
    // loading page is false
    this.setLoadingPage(false)
  }

}
</script>

<style scoped>

</style>
