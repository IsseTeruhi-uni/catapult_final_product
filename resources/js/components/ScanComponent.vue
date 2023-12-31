<template>
  <div class="qrReader">
    <qrcode-stream :paused="paused" @init="onInit" @decode="onDecode"></qrcode-stream>
  </div>
</template>

<script>
import {QrcodeStream} from 'vue-qrcode-reader'
  export default {
    components: { QrcodeStream },
    name: "qrcode-reader",
    data () {
      return {
        paused: false
      }
    },
    methods: {
      async onInit (promise) {
        // show loading indicator
        try {
          await promise
          // successfully initialized
        } catch (error) {
          if (error.name === 'NotAllowedError') {
            // user denied camera access permisson
          } else if (error.name === 'NotFoundError') {
            // no suitable camera device installed
          } else if (error.name === 'NotSupportedError') {
            // page is not served over HTTPS (or localhost)
          } else if (error.name === 'NotReadableError') {
            // maybe camera is already in use
          } else if (error.name === 'OverconstrainedError') {
            // passed constraints don't match any camera. Did you requested the front camera although there is none?
          } else {
            // browser is probably lacking features (WebRTC, Canvas)
          }
        } finally {
          // hide loading indicator
        }
      },
      onDecode(content){
        console.log(content)
        this.paused = true
        alert(content)
      },
      onLoaded() {
        console.log(`Ready to start scanning barcodes`)
      },
    }
  }
</script>