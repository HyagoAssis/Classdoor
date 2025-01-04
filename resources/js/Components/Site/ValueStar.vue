<script setup>

</script>

<template>
    <span class="fw-bold" :class="textColor">{{ value }}<i class="bi-star-fill ms-1"/></span>
</template>

<script>
export default {
    name: 'StarValue',

    props: {
        value: {
            type: Number,
            required: true
        }
    },

    computed: {
      textColor(){
          if(this.value <= 1){
              return 'text-danger';
          }

          if(this.value >= 2 && this.value <= 3){
              return 'text-warning';
          }

          return 'primary-color'
      }
    }
}

</script>
