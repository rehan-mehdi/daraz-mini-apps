<template>
    <div class="container-fluid hidden-sm hidden-lg hidden-xl html-wrapper">
      
      <form style="margin: 0 0 20px 0;" class="col-sm-push-4 col-sm-4 col-xs-12" @submit.prevent="getMissionStatuses">
        <div class="form-group">
          <input type="email" name="email" class="form-control" placeholder="Enter Your Daraz Email" required v-model="email" spellcheck="false">
  
        <input type="submit" name="search" class="btn btn-primary col-sm-12 col-xs-12" value="Track Your Progress" style="background-color: #FFB200; margin-top: 10px;color: #FFFFFF; font-weight: bold; border-bottom: 4px solid #D09203; box-shadow: 0 1px 5px 0px rgba(0,0,0,0.2)" :disabled="fetching">
        </div>
      </form>
  
      <div class="row" style="margin: 20px 0">
  
        <!-- No record found -->
        <div class="row" v-if="recordNotFound">
           <div class="col-xs-12">
              <h5 style="color: #fff!important; text-align: center;">Start your mission now and see your progress tomorrow!</h5>
              <h5 style="color: #fff!important; text-align: center;">Sorry we could not find your progress, make sure to track with your Daraz Email ID</h5>
           </div>
        </div>
  
        <!-- Record found -->
        <!-- Show total missions completed count -->
        <div class="row" v-if="Object.entries(record).length">
           <div class="col-xs-12">
              <h4 style="color: #fff!important; text-align: center; font-size: 17px;">Total Missions Completed: {{record.total_missions_completed}}</h4>
           </div>
        </div>
  
        <table class="table">
          <tbody>
              <!-- Mission 1 Row -->
              <tr>
                <th class="col-xs-2" style="border-top: none!important;"><img src="https://img.alicdn.com/imgextra/i3/O1CN011a7c591GYPnjyTgNU_!!6000000000634-2-tps-100-100.png" class="img-responsive center-block missionIcon"></th>
                <th class="missionTitle col-xs-6" style="border-top: none!important;">Open Daraz App for 5 days</th>
                <td class="col-xs-4" style="border-top: none!important;"> 
                    <button type="button" class="btn btn-primary btn-xs" :class="setBgColor(record.mission_1)">
                      <a href="https://bit.ly/3C3MaUD" class="link" target="_top">{{record.mission_1 || 'Start Now'}}</a>
                    </button> 
                </td>
              </tr>
  
              <!-- Mission 2 Row -->
              <tr>
                <th class="col-xs-2"><img src="https://img.alicdn.com/imgextra/i3/O1CN01E49N591UDG7yuWQA3_!!6000000002483-2-tps-100-100.png" class="img-responsive center-block missionIcon"></th>
                <th class="missionTitle col-xs-6">Add 5 Deals to your cart</th>
                <td class="col-xs-4"> 
                  <button type="button" class="btn btn-primary btn-xs" v-if="record.mission_2 === 'Completed'" :class="setBgColor('Completed')">Completed</button> 
                  <button type="button" class="btn btn-primary btn-xs-locked disabled" disabled v-else>Locked</button>
                </td>
              </tr>
  
              <!-- Mission 3 Row -->
              <tr>
                <th class="col-xs-2"><img src="https://img.alicdn.com/imgextra/i4/O1CN01FO6tVL1kKcLDTg1aV_!!6000000004665-2-tps-100-100.png" class="img-responsive center-block missionIcon"></th>
                <th class="missionTitle col-xs-6">Share any 3 Mega Deals with your friends</th>
                <td class="col-xs-4"> 
                    <button type="button" class="btn btn-primary btn-xs" :class="setBgColor(record.mission_3)">
                      <a href="https://bit.ly/37aKGts" class="link" target="_top">{{record.mission_3 || 'Start Now'}}</a>
                    </button> 
                </td>
              </tr>
  
              <!-- Mission 4 Row -->
              <tr>
                <th class="col-xs-2"><img src="https://img.alicdn.com/imgextra/i2/O1CN01PDOxxr1WMXNnfoY1r_!!6000000002774-2-tps-100-100.png" class="img-responsive center-block missionIcon"></th>
                <th class="missionTitle col-xs-6">Place an order of Rs. 1,499 & more</th>
                <td class="col-xs-4"> 
                    <button type="button" class="btn btn-primary btn-xs" :class="setBgColor(record.mission_4)">
                      <a href="https://bit.ly/3icNSee" class="link" target="_top">{{record.mission_4 || 'Start Now'}}</a>
                    </button>  
                </td>
              </tr>
  
              <!-- Mission 5 Row -->
              <tr>
                <th class="col-xs-2"><img src="https://img.alicdn.com/imgextra/i3/O1CN01ARrTLZ27Ps374Kl5o_!!6000000007790-2-tps-100-100.png" class="img-responsive center-block missionIcon"></th>
                <th class="missionTitle col-xs-6">Recharge your Mobile Balance</th>
                <td class="col-xs-4"> 
                      <button type="button" class="btn btn-primary btn-xs" :class="setBgColor(record.mission_5)">
                        <a href="https://bit.ly/3kWiMHE" class="link" target="_top">{{record.mission_5 || 'Start Now'}}</a>
                      </button>
                </td>
              </tr>
  
              <!-- Mission 6 Row -->
              <tr>
                <th class="col-xs-2"><img src="https://img.alicdn.com/imgextra/i4/O1CN01hyh7Xu286SsbKNkl3_!!6000000007883-2-tps-100-100.png" class="img-responsive center-block missionIcon"></th>
                <th class="missionTitle col-xs-6">Share an image review on Daraz</th>
                <td class="col-xs-4"> 
                      <button type="button" class="btn btn-primary btn-xs" :class="setBgColor(record.mission_6)">
                        <a href="https://bit.ly/2PNi83R" class="link" target="_top">{{record.mission_6 || 'Start Now'}}</a>
                      </button>
                </td>
              </tr>
              
              <!-- Mission 7 Row -->
              <tr>
                <th class="col-xs-2"><img src="https://img.alicdn.com/imgextra/i4/O1CN01Ow5Dm21cekpdo83HS_!!6000000003626-2-tps-100-100.png" class="img-responsive center-block missionIcon"></th>
                <th class="missionTitle col-xs-6">Collect any 5 vouchers</th>
                <td class="col-xs-4"> 
                      <button type="button" class="btn btn-primary btn-xs" :class="setBgColor(record.mission_7)">
                        <a href="https://bit.ly/3BVRCZy" class="link" target="_top">{{record.mission_7 || 'Start Now'}}</a>
                      </button>
                </td>
              </tr>
  
              <!-- Mission 8 Row -->
              <tr>
                <th class="col-xs-2"><img src="https://img.alicdn.com/imgextra/i1/O1CN015UzvWV1PiKvGllMMO_!!6000000001874-2-tps-100-100.png" class="img-responsive center-block missionIcon"></th>
                <th class="missionTitle col-xs-6">Pay any utility bills</th>
                <td class="col-xs-4">
                    <button type="button" class="btn btn-primary btn-xs" :class="setBgColor(record.mission_8)">
                      <a href="https://bit.ly/2ViVEKS" class="link" target="_top">{{record.mission_8 || 'Start Now'}}</a>
                    </button> 
                </td>
              </tr>
  
              <!-- Mission 9 Row -->
              <tr>
                <th class="col-xs-2"><img src="https://img.alicdn.com/imgextra/i3/O1CN01eFJNRE1LLeqcx6t2v_!!6000000001283-2-tps-100-100.png" class="img-responsive center-block missionIcon"></th>
                <th class="missionTitle col-xs-6">Clicks any 5 push notifications</th>
                <td class="col-xs-4">
                    <button type="button" class="btn btn-primary btn-xs" :class="setBgColor(record.mission_9)">
                      <a href="https://bit.ly/2TMG2yM" class="link" target="_top">{{record.mission_9 || 'Start Now'}}</a>
                    </button>    
                </td>
              </tr>
  
              <!-- Mission 10 Row -->
              <tr>
                <th class="col-xs-2"><img src="https://img.alicdn.com/imgextra/i3/O1CN01kbdzph1Q21x99oO7o_!!6000000001917-2-tps-100-100.png" class="img-responsive center-block missionIcon"></th>
                <th class="missionTitle col-xs-6">Place an order through Daraz Wallet</th>
                <td class="col-xs-4">
                    <button type="button" class="btn btn-primary btn-xs" :class="setBgColor(record.mission_10)">
                      <a href="https://bit.ly/3rI6R3y" class="link" target="_top">{{record.mission_10 || 'Start Now'}}</a>
                    </button>    
                </td>
              </tr>

              <!-- Mission 11 Row -->
              <tr>
                <th class="col-xs-2"><img src="https://img.alicdn.com/imgextra/i3/O1CN01WP2Bm31kJF9jp1fpR_!!6000000004662-2-tps-100-100.png" class="img-responsive center-block missionIcon"></th>
                <th class="missionTitle col-xs-6">Follow any 5 Co-sponsers/Brand partners from Azaadi Sale</th>
                <td class="col-xs-4">
                    <button type="button" class="btn btn-primary btn-xs" :class="setBgColor(record.mission_11)">
                      <a href="https://bit.ly/3j7J2hG" class="link" target="_top">{{record.mission_11 || 'Start Now'}}</a>
                    </button>    
                </td>
              </tr>
          </tbody>
        </table>
  
      </div>
    </div>
  </template>
  
  <script>
  
  export default {
    data() {
      return {
        email: '',                  // User input email will be stored in this variable
        fetching: false,            // To disable "Track your progress" button during axios call
        record: {},                 // Status information. Will be filled if email is found
        recordNotFound: false       // To show error msg if email is not found
      }
    },
    methods: {
      getMissionStatuses() {
        let email = this.email.trim().toLowerCase() // It requires that all the email should come in lowercase from ODPS to OTS
  
        // Empty in main branch
        const venture = 'PK'  // Change it as per venture (Should be two uppercase letters)
  
        let payload = {
          email,          // Required
          venture         // Required
        }
  
        this.fetching = true      // This will disable the Submit button
  
        this.$axios.$post('/mission/get-status', payload)
        .then( response => {
          let {success, message, record} = response
          if (success) {
            this.record = record
            if (!Object.entries(record).length) {
              // No record found
              this.recordNotFound = true
            } else {
              this.recordNotFound = false
            }
          } else {
            console.log('Success: false; Message:', message)
          }
        })
        .catch (err => {
          console.log('Error:', err.message)
        })
        .finally( () => {
          this.fetching = false       // Enable the submit button
          this.email = ''             // Clear email field
        })
      },
  
      // Dynamically set background color
      setBgColor(status) {
        if (status === 'Completed')     return {'completed': true}
        if (status === 'Start Now')     return {'start-now': true}
        if (status === 'In Progress')   return {'in-progress': true}
        // If status is not undefined but contain some value other than Completed, Start Now, In Progress
        // For example: 3/4, 11/19 etc
        if (status !== undefined)       return {'rollback': true}
  
        // Return empty object at initial render
        return {}
      }
    }
  }
  </script>
  
  <style>
    .completed {
      background-color: #008e2e!important;
    }
    .in-progress {
      background-color: #FF9900!important;
    }
    .start-now {
      background-color: #008E2E!important;
    }
    .rollback {
      background-color: #FF9900!important
    }
  
  </style>
