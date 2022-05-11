<template>
  <q-page class="flex flex-center">
  {{ currentUser }}
  </q-page>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'PageIndex',
  computed: {
    ...mapGetters('adminLogin', ['currentUser'])
  }
}
</script>
