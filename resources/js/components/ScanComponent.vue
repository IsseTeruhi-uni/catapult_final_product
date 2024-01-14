<template>
  <div class="qrReader">
    <b style="color:#f00;">result is</b>
    <b style="color:#f00;">{{ result }}</b>
    <b style="color:#f00;">paused is</b>
    <b style="color:#f00;">{{ paused }}</b>
    <qrcode-stream :paused="paused" @init="onInit" @detect="onDetect"></qrcode-stream>
  </div>
</template>

<script>
import { QrcodeStream } from 'vue-qrcode-reader';

export default {
  components: { QrcodeStream },
  name: "ScanComponent",
  data() {
    return {
      result: '',
      paused: false
    };
  },
  methods: {
    onDetect(result) {
      this.result = result[0].rawValue;
      this.paused = true;
      window.location.href = "https://dec-ph4-final-8232e5fa7788.herokuapp.com/employees/" + this.result;   
      },
    async onInit(promise) {
      // show loading indicator
      try {
        await promise;
        // successfully initialized
      } catch (error) {
        if (error.name === 'NotAllowedError') {
          console.log('NotAllowedError');
        } else if (error.name === 'NotFoundError') {
          console.log('NotFoundError');
        } else if (error.name === 'NotSupportedError') {
          console.log('NotSupportedError');
        } else if (error.name === 'NotReadableError') {
          console.log('NotReadableError');
        } else if (error.name === 'OverconstrainedError') {
          console.log('OverconstrainedError');
        } else if (error.name === 'StreamApiNotSupportedError') {
          console.log('StreamApiNotSupportedError');
        } else if (error.name === 'TrackStartError') {
          console.log('TrackStartError');
        } else {
          // browser is probably lacking features (WebRTC, Canvas)
        }
      } finally {
        console.log('finally');
      }
    },
  }
}
</script>