<!DOCTYPE html>
<html lang="en" style="background-color: #FE4100;">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    .lzd-act-richtext {
      padding: 0px !important;
      margin: 0px !important;
    }

    .inner-content {
      width: 100%;
    }

   body{
      font-family: 'Work Sans', sans-serif;
      background-color: #FE4100;
   }

    p {
      margin: 0;
    }


   .email-input {
      width: 50%;
      margin: 0px 40px;
      font-size: 17pt;
      border-radius: 20px;
      height: 45px;
      border: 0px;
      text-align: center;
   }

   .email-button {
      background-color: #FF2847;
      color: #FFFFFF;
      font-size: 17pt;
      border-radius: 20px;
      padding: 0px 30px;
      height: 45px;
      border: 0px;
      box-shadow: 0 1px 5px 0px rgba(0,0,0,0.2);

   }

    .error-message {
      font-size: 17pt;
    }

   .dynamic-text {
      font-size: 32pt;
      line-height: 45pt;
      font-weight: 800;
      color: #FFE939;
   }

   .static-text {
      font-size: 17pt;
      line-height: 17pt;
      color: #FFFFFF;
   }

    .red-box {
      width: 50%;
      background-color: #FF2847;
      text-align: center;
      padding: 50px 20px;
      border-radius: 20px;
    }

    .orange-box {
      width: 100%;
      background-color: #FE5A03;
      text-align: center;
      padding: 50px 20px;
      border-radius: 20px;
    }

    .blue-box {
      width: 50%;
      background-color: #1663EC;
      text-align: center;
      padding: 50px 20px;
      border-radius: 20px;
    }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  
  @media (max-width: 600px) {
   table {
      width: 100%;
   }

   .email-input {
      width: 100%;
      margin: 0px;
      font-size: 12px;
   }

   .email-button {
      width: 100%;
      margin-top: 10px;
      font-size: 12px;
   }

    .error-message {
      font-size: 12pt;
    }

    .full-width {
      width: 100%!important;
    }

   .dynamic-text {
      font-size: 16px;
      line-height: 16px;
   }

   .static-text {
      font-size: 12px;
      line-height: 15px;
   }

    .red-box {
      padding: 20px 20px;
    }

    .orange-box {
      padding: 20px 20px;
    }

    .blue-box {
      padding: 20px 20px;
    }
  } 
  </style>
</head>
<body>
   <div style="background-color: #FE4100;">
      <div class="full-width" style="width: 1188px; margin: auto; border-radius: 20px;background-color: #1663EC;margin-bottom: 20px">
      <div style="display: flex;">
        <div style="width: 100%; padding: 10px 10px; text-align: center;border-radius: 20px;">
          <form action="" method="POST">
              <div>
                <input type="email" name="email" class="email-input" placeholder="Enter Your Daraz Email" required>
                <input type="submit" name="search" value="Submit" class="btn btn-primary email-button" style="background-color: #FF2847; box-shadow: 0 1px 5px 0px rgba(0,0,0,0.2);">
              </div>
            </form>
        </div>
      </div>
    </div>
    <?php
      $connection = mysqli_connect('locahost','dbname','pwd');
      $db = mysqli_select_db($connection,'u344480234_dbdb');
      if(isset($_POST['search'])){
        $message2 = "Sorry we cound not find your progress, make sure to track with your Daraz Email ID";
          $email = $_POST['email'];
          $email = mysqli_real_escape_string($connection,$email);
          $query = "SELECT * from lookback_pk where email ='$email'";
          $query_run = mysqli_query($connection, $query);

          $count = mysqli_num_rows($query_run);

          if($count < 1){

          echo'<div class="full-width" style="width: 1188px; margin: auto;">
                <div>
                  <p class="error-message" style="color: #fff!important; text-align: center;"> Oops, there is something wrong. Please enter your correct details or try a valid email address.</p>
                </div>
              </div>';
                
            }

        while($row = mysqli_fetch_array($query_run)){

          // $selected = array("selected"=>"completed","selected"=>"In Progress","selected"=>"incomplete");

        echo '<style>.default-table{display: show;}</style>';

         $check_1 = $row['days_since_signup'];
         $check_2 = $row['saved_amount'];
         $check_3 = $row['top_months'];
         $check_4 = $row['least_months'];
         $check_5 = $row['saved_amount_share'];
         $check_6 = $row['top_category'];
         $check_7 = $row['dmbrand_1'];
         $check_8 = $row['seller_city'];
         
    ?>

    <div class="default-table full-width" style="width: 1188px; margin: auto; background-color: #FFFFFF; border-radius: 20px;">
      <div style="display: flex;">
        <div class="red-box" style=" margin: 10px 5px 5px 10px;">
          <p><span class="static-text">It's been</span> <span class="dynamic-text"><?php echo $check_1; ?></span> <span class="static-text">days, since we became friends ❤️</span></p>
        </div>
        <div class="red-box" style="margin: 10px 10px 5px 5px;">
          <p><span class="static-text">You saved </span> <span class="dynamic-text">Rs. <?php echo $check_2; ?></span> <span class="static-text">this year from Daraz!</span></p>
        </div>
      </div>

      <div style="display: flex;">
        <div class="red-box" style="margin: 5px 5px 5px 10px;">
          <p><span class="static-text">You shopped most on the month of<br></span> <span class="dynamic-text"><?php echo $check_3; ?><br></span> <span class="static-text">Could it be your birthday month? <span>😜</span></span></p>
        </div>
        <div class="red-box" style="margin: 5px 10px 5px 5px;">
          <p><span class="static-text">You shopped least on the Month of<br></span> <span class="dynamic-text"><?php echo $check_4; ?><br></span> <span class="static-text">No worries, we will offer you special deals throughout the year</span></p>
        </div>
      </div>

      <div style="display: flex;">
        <div class="orange-box" style="margin: 5px 10px 5px 10px;">
           <p><span class="static-text">You're</span> <span class="dynamic-text">One</span> <span class="static-text">of our</span> <span class="dynamic-text">15,087,086</span> <span class="static-text">customers who availed up to</span> <span class="dynamic-text"><?php echo round($check_5 * 100); ?>% off</span> <span class="static-text">on discounts this year</span></p>
        </div>
      </div>

      <div style="display: flex;">
        <div class="blue-box" style="margin: 5px 5px 5px 10px;">
          <div>
            <p><span class="static-text">Your favorite category was <br><span class="dynamic-text">"<?php echo $check_6; ?>"</span> <br>Hope you enjoyed your purchase</span></p>
          </div>
        </div>
        <div class="blue-box" style="margin: 5px 10px 5px 5px;">
          <div>
            <p><span class="static-text">Your favorite brand was</span> <span class="dynamic-text">"<?php echo $check_7; ?>"</span> <span class="static-text">from DarazMall You must be loving it ❤️</span></p>
          </div>
        </div>
      </div>

      <div style="display: flex;">
        <div class="orange-box" style="margin: 5px 10px 10px 10px;">
            <p><span class="static-text">Top cities, you bought from were</span> <span class="dynamic-text">"<?php echo $check_8; ?>"</span> <span class="static-text">Covering more than 100KM of distance, specially for you!</span></p>
        </div>
      </div>
    </div>
          <?php
          }
        }
      ?>
   </div>
 <script>

  // all content including images has been loaded
    window.onload = function() {
        // post our message to the parent
        window.parent.postMessage(
            // get height of the content
            document.body.scrollHeight
            // set target domain
            ,"*"
        )
    };
</script>
</body>
</html>
