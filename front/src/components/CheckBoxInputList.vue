<template>
    <div class="block-item cboxtags-list">
        <div class="row">
            <ul class="ks-cboxtags" v-if="componentIsLoaded">
                <!-- li -->
                <li   v-for="( feature , index ) in list" v-if="showList(index)" >
                    <input  type="checkbox"  :value="feature.id" :id="namelist + feature.id"   v-model="listValue" >
                    <label :for="namelist + feature.id">  <font-awesome-icon :icon="verifyContain(feature.id)"  /> {{ feature.title }}</label>
                </li>
                <!-- end li -->
            </ul>
        </div>
        <div class="row">
            <p class="statusListBTN"  v-if="showLimitBtn" ><a href="#" @click.prevent="changeStatusList()" ><font-awesome-icon :icon='statusListIcon'  /><span>{{ statusListText }}</span></a></p>
        </div>
    </div>
</template>

<script>
export default {
  name: 'CheckBoxInputList',
  props: {
    list: { type: Array },
    checkedvalue: { type: Array },
    limit: { type: Number, default: null },
    namelist: { type: String, default: null }
  },
  data () {
    return {
      listValue: [],
      statusList: 'close',
      componentIsLoaded: false
    }
  },
  methods: {
    verifyContain (id) {
      if (this.listValue.includes(id)) {
        return 'check'
      }
      return 'plus'
    },
    showList (index) {
      // OPEN
      if (this.statusList === 'open') {
        return true
      }

      // CLOSE
      if (index <= this.limit) {
        return true
      }

      return false
    },
    changeStatusList () {
      if (this.statusList === 'close') {
        this.statusList = 'open'
        return
      }

      this.statusList = 'close'
    }

  },

  computed: {
    statusListIcon () {
      if (this.statusList === 'close') {
        return 'plus-circle'
      }

      return 'minus-circle'
    },
    statusListText () {
      if (this.statusList === 'close') {
        return 'Mais Opções'
      }

      return 'Menos Opções'
    },
    showLimitBtn () {
      if (this.limit == null) {
        return false
      }

      if (this.list.length < this.limit) {
        return false
      }

      return true
    }

  },
  watch: {
    listValue: function (val) {
      this.$emit('input', val)
    }
  },
  created () {
    // SET LIST
    this.listValue = this.checkedvalue

    // SET IS OPEN
    if (this.limit == null) {
      this.statusList = 'open'
    }

    // COMPONENT IS LOADED
    this.componentIsLoaded = true
  }
}
</script>

<style scoped>
    div.cboxtags-list {
        padding:10px 0 20px 0;
    }
    ul.ks-cboxtags {
        padding:5px 0 5px 0;
        list-style: none;
        margin:0px;
    }
    ul.ks-cboxtags li{
        display: inline;
    }
    ul.ks-cboxtags li label{
        display: inline-block;
        background-color: rgba(255, 255, 255, .9);
        border: 2px solid rgba(139, 139, 139, .3);
        color: #adadad;
        border-radius: 25px;
        white-space: nowrap;
        margin: 3px 0px;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
        transition: all .2s;
    }

    ul.ks-cboxtags li label {
        padding: 8px 12px;
        cursor: pointer;
    }

    ul.ks-cboxtags li label::before {
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        font-size: 12px;
        padding: 2px 6px 2px 2px;

    }

    ul.ks-cboxtags li input[type="checkbox"]:checked + label::before {

    }

    ul.ks-cboxtags li input[type="checkbox"]:checked + label {
        border: 2px solid #1bdbf8;
        background-color: #12bbd4;
        color: #fff;
        transition: all .2s;
    }

    ul.ks-cboxtags li input[type="checkbox"] {
        display: absolute;
    }
    ul.ks-cboxtags li input[type="checkbox"] {
        position: absolute;
        opacity: 0;
    }
    ul.ks-cboxtags li input[type="checkbox"]:focus + label {
        border: 2px solid #e9a1ff;
    }

    ul.ks-cboxtags li svg {
        margin-right:5px;
        font-size:12px;
    }

    p.statusListBTN {
        padding-top:20px;
    }

    p.statusListBTN a{
        font-size:16px;
    }
    p.statusListBTN a svg{
       margin-right:8px;
    }
    p.statusListBTN a span{
        font-size:17px;
    }
</style>
