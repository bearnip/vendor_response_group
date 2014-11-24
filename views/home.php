<?php include ('includes/header.html'); ?>

      <!-- Second row -->
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 pContent">
          <h2 class="sectionTitle">Your Responses</h2>
          <table class="table table-stripeld">
            <tr><th>RFP Title</th><th>Date Filled</th><th>Status</th></tr>
       
            <?php 
            foreach($myResponses as $response){
              echo '<tr><td>' . $response["Rfpnum"] . '</td>';
              echo '<td>' . $response["title"] . '</td>';
              echo '<td>' . "$" . $response["cost"] . '</td></tr>';

            }
            ?>
          </table>

        </div>
        <div class="col-md-2"></div>

      </div>


    
    </div><!-- End of container -->

 <?php include('includes/footer.html'); ?>