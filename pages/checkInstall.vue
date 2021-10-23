<template>
    <div class="container-fluid visible-xs">
        <div class="row">
            <div class="col-xs-12">
                <img src="https://img.alicdn.com/imgextra/i4/O1CN01GABPzq1kBSNyAFA3K_!!6000000004645-0-tps-750-350.jpg" class="img-responsive" style="margin: 0 0 20px 0;">
                <form @submit.prevent="checkInstalls">
                    <div class="form-group">
                        <label class="enter-phone">Check Your Installs</label>
                        <input type="text" name="number" class="form-control col s6" placeholder="03123456789" id="number" pattern="03[0-9]{2}[0-9]{7}" required="required" v-model='mobile'/>
                        <button type="submit" id="btn" class="btn btn-primary" :disabled="loader">Check Install
                            <div v-if="loader" class="loader" id="loader-1"></div>
                        </button>
                    </div>
                </form>

                <div v-if="installBox">
                    <div v-if="countNumber">
                        <label for="installs" style="font-size: 1rem;color: rgba(0,0,0,0.87);text-transform: uppercase; font-weight: 400;">Total installs</label>
                        <h4 class="installNumber">{{count}}</h4>
                    </div>
                    <div v-else>
                        <h4 class="text-center">You have 0 Install. Please click <NuxtLink to="/">here</NuxtLink> to invite your friends</h4>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
        installBox : false,
        count: '-',
        mobile: '',
        countNumber: '',
        loader: false
        }
    },

    methods: {
        checkInstalls() {
            this.loader = true
            let mobile = this.mobile.replace(/^0+/, "")
            let payload = { 
                phone: mobile
            }
            this.$axios.$post('/installations', payload)
            .then (result => {
                this.installBox = true

                let {success, count} = result

                if (success) {
                    if(count != 0)
                    {
                        this.countNumber = true
                        this.count = count
                    }

                }
                else {
                    this.countNumber = false
                }
            })
            .catch ( e => {
                //console.log(e.message)
            })
            .finally( () => {
                this.mobile = '',
                this.loader= false
            })
        }
    }
}
</script>
