<template>
         <div v-show="isActive"><slot></slot></div>
</template>
<script>
export default {
  name: 'Tab',
  props: {
    name: { required: true },
    selected: { default: false },
    url_title: { type: String, default: null }
  },

  data () {
    return {
      isActive: false
    }
  },
  computed: {
    styleTab () {
      return this.isActive === true ? '' : 'hidden'
    }
  },
  mounted () {
    this.isActive = this.selected
  }

}
</script>
