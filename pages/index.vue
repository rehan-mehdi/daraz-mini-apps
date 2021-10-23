<template>
    <div class="container-fluid visible-xs">
      <div class="row">
        <div class="col-xs-12">
          <img src="https://img.alicdn.com/imgextra/i1/O1CN01NzF0b71rlpCShsFvy_!!6000000005672-2-tps-750-300.png" class="img-responsive" style="margin: 0 0 20px 0;">
          <img src="https://img.alicdn.com/imgextra/i3/O1CN017yQO8z23khcETjght_!!6000000007294-2-tps-702-140.png" class="img-responsive" style="margin: 0;">
          <img src="https://img.alicdn.com/imgextra/i3/O1CN01V0DOVo1u2tBkIK0hj_!!6000000005980-2-tps-702-1045.png" class="img-responsive" style="margin: 0;">
          <img src="https://img.alicdn.com/imgextra/i4/O1CN01RDlNsv1REgWw1qmHO_!!6000000002080-2-tps-702-472.png" class="img-responsive" style="margin: 0;">
          <img src="https://img.alicdn.com/imgextra/i4/O1CN01qhppdX1s9BOp1h4QI_!!6000000005723-2-tps-702-153.png" class="img-responsive" style="margin: 0;">
          <img src="https://img.alicdn.com/imgextra/i1/O1CN01fSrDLr1pDMA0rBUnc_!!6000000005326-2-tps-702-140.png" class="img-responsive" style="margin: 0;">
          <form v-if="submitNot" @submit.prevent="inviteFriends">
            <div class="form-group">
              <input type="text" name="email" class="form-control col s6" placeholder="03123456789" id="username" pattern="03[0-9]{2}[0-9]{7}" required="required" v-model='mobile'/>
              <button type="submit" id="btn" class="btn btn-primary" :disabled="loader">INVITE FRIENDS
                <div v-if="loader" class="loader" id="loader-1"></div>
              </button>
            </div>
          </form>
          
          <div v-if="congratulation">
            <img src="https://img.alicdn.com/imgextra/i2/O1CN019VrxLN1ivb3P8GfP3_!!6000000004475-0-tps-750-580.jpg" class="img-responsive">
            <p style="text-align: center; text-transform: uppercase; margin-top: 20px; margin-bottom:0px; font-size: 20px; color: #FF400B; font-weight: 700;">Share now to invite your friends</p>
            <button @click="copytoclipboard" type="submit" id="btn" class="btn btn-primary copy-link col-sm-8 col-xs-12 center">Click Here to Copy Link</button>
            <div v-if="showMessage">
              <p class="text-center text-uppercase" style="margin-bottom: 20px; font-size: 12px;">Your Referral Link is <kbd>Copied</kbd></p>
            </div>
            
            <div class="text-center">
                <a :href="fb_link" target="_blank" class="fb-xfbml-parse-ignore social-img" id="fbid">
                    <img src="https://img.alicdn.com/tfs/TB1kEtxXACy2eVjSZPfXXbdgpXa-250-250.png" style="max-height: 60px;">
                </a>
      
                <a :href="twitter_link" target="_blank" class="twitter-share-button social-img" id="twid" data-size="large">
                    <img src="https://img.alicdn.com/tfs/TB1OeeUoDZmx1VjSZFGXXax2XXa-250-250.png" style="max-height: 60px;">
                </a>
            </div>
          </div>

          <a class="tnc-link" href="https://pages.daraz.pk/wow/i/pk/landingpage/tnc-daraz-dosti-program?hybrid=1">Referral Terms and Conditions</a>
          <NuxtLink to="/checkInstall">
            <img src="https://img.alicdn.com/imgextra/i4/O1CN019OzQmx1H9yFBjXQZ1_!!6000000000716-2-tps-718-250.png" class="img-responsive" style="margin: 20px 0 20px 0;">
          </NuxtLink>
          <h6 style="text-transform: uppercase; text-align: center; color: #f84e1f; font-weight: bold; margin-top: 30px; margin-bottom: 20px;">
          ------ Other Promotions ------
          </h6>
          <a href="#">
            <img src="https://img.alicdn.com/imgextra/i2/O1CN019EieFa1ybvxNFbKYc_!!6000000006598-2-tps-702-188.png" class="img-responsive" style="margin: 0 0 20px 0;">
          </a>

        </div>
      </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      submitNot: true,
      congratulation: false,
      mobile: '',
      final_link: '',
      fb_link : '',
      twitter_link: '',
      showMessage: false,
      loader: false
    }
  },
  methods: {
        inviteFriends() {
            this.loader = true
            let mobile = this.mobile.replace(/^0+/, "")
            let payload = { 
                phone: mobile
            }
            this.$axios.$post('/generate', payload)
            .then (result => {
                this.submitNot = false
                let {success, message, final_link} = result
                if (success) {
                    this.congratulation = true
                    const fb_baseURL = 'https://www.facebook.com/sharer/sharer.php?u='
                    const twitter_baseURL = 'https://twitter.com/intent/tweet?text='
                    this.final_link = final_link
                    let segments = final_link.split('&deeplink')
                    this.twitter_link = twitter_baseURL + segments[0] + '?text=?deeplink' + segments[1]
                    this.fb_link = fb_baseURL + final_link
                }
                else {
                    //console.log(message)
                }
            })
            .catch ( e => {
                //console.log(e.message)
            })
            .finally( () => {
                this.mobile = '',
                this.loader= false
            })
        },
        async copyFinalLink(text) {
            try {
                await this.$copyText(text);
            } catch (e) {
                //console.error(e);
            }
        },
        copytoclipboard(){
          this.copyFinalLink(this.final_link)
          this.showMessage = true
          
        }
    }
}
</script>
