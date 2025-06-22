<template>
    <div :class="textColor" class="d-inline-block rounded p-2">
        <span class="fw-bold"><i class="bi-star-fill me-1"/>{{ value }}</span>
    </div>
</template>

<script>
export default {
    name: 'StarValue',

    props: {
        value: {
            type: [Number, String],
            required: true
        }
    },

    computed: {
      textColor(){
          if(this.value <= 1){
              return 'text-danger bg-danger-subtle';
          }

          if(this.value >= 2 && this.value <= 3){
              return 'text-warning bg-warning-subtle';
          }

          return 'text-success bg-success-subtle'
      }
    }
}

</script>
