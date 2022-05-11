<template>
        <div>
            <div  v-for="i  in Math.ceil(listOptions.length / dividedby ) " class="columns list_check_box" >

                        <!-- col -->
                        <template  v-for="(feature , index ) in listOptions.slice((i - 1) * dividedby , i * dividedby )" >

                            <div class="column list_col" v-if="feature.id == 'select-all'">
                                <input :class="selectAllDataSelection"  type="checkbox"  @click.prevent="selectAllData"   v-model="allSelected"  id="SelectAll" />
                                <label class="cbx columns" for="SelectAll"><span>
                                        <font-awesome-icon icon="check"  v-if="allSelected == true"/>
                                  </span><div class="column textinput"><p>{{ selectalltext }}</p></div></label>
                            </div>

                            <div class="column list_col" v-else >
                                <input class="inp-cbx"  type="checkbox" :value="feature.id" :id="name + '_' + feature.id"   v-model="listValue" />
                                    <label class="cbx columns" :for="name + '_' + feature.id"><span>
                                        <font-awesome-icon icon="check"  v-if="listValue.includes(feature.id)"/>
                                  </span><div class="column textinput"><p>{{ feature.title }}</p></div></label>
                            </div>

                        </template>
                        <!-- end col -->

                </div>
            </div>
  </template>
<script>
export default {
  name: 'CheckInputList',
  props: {
    dividedby: { type: Number },
    list: { type: Array },
    checkedvalue: { type: Array },
    name: { type: String },
    selectall: { type: Boolean, default: false },
    selectalltext: { type: String, default: 'Selecionar Todos' }

  },
  data () {
    return {
      listValue: [],
      allList: [],
      allSelected: false,
      listOptions: []
    }
  },
  methods: {

    changeValue (value) {

    },
    selectAllData: function () {
      if (this.listValue.length != this.listOptions.length - 1) {
        this.listValue = []
        for (var prop in this.list) {
          this.listValue.push(this.list[prop].id)
        }

        this.allSelected = true
      } else {
        this.listValue = []
        this.allSelected = false
      }
    }
  },
  computed: {
    selectAllDataSelection () {
      if (this.allSelected) {
        return 'inp-cbx checked'
      }

      return 'inp-cbx'
    }
  },
  watch: {
    listValue: function (val) {
      if (val.id != 'select-all') {
        this.$emit('input', val)
      }
    }
  },
  created () {
    this.listValue = this.checkedvalue

    if (this.selectall) {
      this.listOptions = [...[{ id: 'select-all', title: this.selectalltext }], ...this.list]
    } else {
      this.listOptions = Object.assign([], this.list)
    }
  }

}
</script>
<style scoped>
/*
    * {
        box-sizing: border-box;
    }*/
    /* ----------------------- divs */
     div.list_check_box {
        padding:4px 0 0 0;
    }
    div.list_col {
        margin-left:10px;
    }

    .cbx {
        -webkit-user-select: none;
        user-select: none;
        cursor: pointer;
        padding: 6px 8px 6px 16px;
        margin-right:14px;
        border-radius: 6px;
        overflow: hidden;
        transition: all 0.2s ease;
    }
    .cbx:not(:last-child) {
        margin-right: 6px;
    }
    .cbx:hover {
        background: rgba(0,119,255,0.06);
    }
    .cbx span ,  .cbx p {
        float: left;
        vertical-align: middle;
        transform: translate3d(0, 0, 0);

    }
    .cbx span  {
        position: relative;
        width: 21px;
        height: 21px;
        border-radius: 4px;
        transform: scale(1);
        border: 1px solid #cccfdb;
        transition: all 0.2s ease;
        box-shadow: 0 1px 1px rgba(0,16,75,0.05);
        margin-top:12px;
    }
    .cbx span  svg {
        position: absolute;
        top: 3px;
        left: 2px;
        color:#FFF;
    }
    .cpx .textinput {
        padding:0px;
        margin:0px;
        border:1px solid;
    }
    .cbx p {
        padding-left: 8px;
        line-height:21px;
    }
    .cbx:hover span {
        border-color: #07f;
    }
    .inp-cbx {
        position: absolute;
        visibility: hidden;
    }
    .inp-cbx:checked + .cbx span , .inp-cbx.checked + .cbx span{
        background: #07f;
        border-color: #07f;
        animation: wave 0.4s ease;
    }
    .inp-cbx:checked + .cbx span  svg ,  .inp-cbx.checked + .cbx span  svg  {
        stroke-dashoffset: 0;
    }

</style>
