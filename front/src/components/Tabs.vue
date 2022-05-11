<template>
    <div>
        <div class="tabs" >
              <ul  :id="nametab" >
                <li v-for="( tab, index ) in tabs"  :key="index" :class="{'is-active': tab.isActive}">
                            <a :href="tab.href" @click="selectTab(tab)" v-if="tab.name">{{ tab.name }}</a>
                 </li>
              </ul>
            </div>
            <div class="tabs-details">
                <slot></slot>
            </div>
    </div>
</template>

<script>
export default {
  name: 'Tabs',
  props: {
    nametab: { type: String },
    showstatus: { type: Boolean, default: false }
  },
  data () {
    return { tabs: [] }
  },
  created () {
    this.tabs = this.$children
  },
  methods: {
    selectTab (selectedTab) {
      this.tabs.forEach(tab => {
        tab.isActive = (tab.name === selectedTab.name)
      })
      this.$emit('changestatustab', selectedTab.url_title)
    }
  }

}
</script>

<style scoped>
    ul#tab_list_one {
        padding:0px !important;
        margin:0px !important;
    }
    ul#tab_list_one li {
        padding:0px 5px 0 5px !important;
    }

    ul#tab_list_one li a {
        font-size:16px;

    }

</style>
