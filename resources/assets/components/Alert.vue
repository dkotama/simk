<template>
<div class="col-md-5">
  <div :class="alertClasses" role="alert" v-show="show">
    <slot></slot>
    <button type="button" class="close" aria-label="Close" @click="show = false"><span aria-hidden="true">&times;</span></button>
  </div>
</div>
</template>


<script>

export default {
  props: ['type'],

  data() {
    return {
      show: true
    }
  },

  methods: {
    getType(type) {
      switch (type) {
        case 'success':
          return 'alert-success';
        default:
          return 'alert-info';
      }
    },
  },

  computed: {
    alertClasses() {
      var type = this.type;
      
      return {
        'alert' : true,
        'alert-success' : type == 'success',
        'alert-info' : type == 'info'
      }
    }
  }
};

</script>