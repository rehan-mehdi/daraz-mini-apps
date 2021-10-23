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
            <!-- Enter table rows here -->
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
      const venture = ''  // Change it as per venture (Should be two uppercase letters)

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
    background-color: #34a853!important;
  }
  .in-progress {
    background-color: #FF9900!important;
  }
  .start-now {
    background-color: #11AEB1!important;
  }
  .rollback {
    background-color: #FF9900!important
  }

</style>