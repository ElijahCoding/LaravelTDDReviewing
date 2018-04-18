<template>
  <div class="alert alert-success alert-flash" role="alert" v-show="show">
      <strong>Success!</strong> {{ body }}
</div>
</template>

<script>
    export default {
        props: ['message'],

        data() {
          return {
            body: this.message,
            show: false
          }
        },

        created() {
          if (this.message) {
            this.body = this.message
            this.show = true
          }
        },

        methods: {

        }
    }
</script>

<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>
