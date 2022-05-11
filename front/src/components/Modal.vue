<template>
    <transition name="modal" >
        <div class="modal-mask"   >
            <div class="modal-wrapper"  >
                <!--  @click.stop -->
                <div :class="modalStyleArea"  @click.stop  v-click-outside="outside"   @click="inside">

                    <a class="close-modal" @click="$emit('close')" v-if="btnclose == true"></a>

                    <div class="modal-header" v-if="hasHeaderSlot">
                        <slot name="header" class="modal-card-title "></slot>
                    </div>
                    <slot name="body"></slot>

                    <slot name="footer"  @click.stop ></slot>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import ClickOutSideEvent from '../mixins/ClickOutSideEvent'

export default {
  props: {
    modalstyle: { type: String },
    btnclose: { type: Boolean, default: true },
    closeoutside: { type: Boolean, default: false }
  },
  data () {
    return { countClickOutside: 0 }
  },
  methods: {
    outside: function (e) {
      if (this.countClickOutside > 0) {
        if (this.closeoutside) {
          this.$emit('close')
        }
      }

      this.countClickOutside++
    },
    inside: function (e) {

    }
  },
  computed: {
    modalStyleArea () {
      return this.modalstyle == null ? 'modal-container' : this.modalstyle + ' modal-container'
    },
    hasHeaderSlot () {
      return !!this.$slots.header
    }
  },
  mixins: [ClickOutSideEvent]
}
</script>
<style scoped>
   @import url("../../src/css/components/modal.css");

    .modal-container {
        padding: 20px 30px 20px 30px !important;
    }
</style>
