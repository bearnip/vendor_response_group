<?php include('includes/header.html'); ?>

	 <!-- RFPs we can respond to -->
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 pContent">
          <h2 class="sectionTitle">Available Requests For Proposal</h2>


          <table class="table">
        	<tr><th>Summary</th><th>Projection</th><th>Length</th><th>Width</th><th>Completion Date</th>
        	<th>View Full Details</th></tr>

        	<?php 
        	foreach($rfp_cursor as $rfp){

            if(!in_array( $rfp["rfpnum"], $filledRfps ) ){
        		$hq = ($rfp["audio"] == true ? "Yes" : "No");

        		echo "<tr>";
      
        		echo "<td>" . $rfp["summary"] . "</td>";

            echo "<td>" . $rfp["projection"][0] . "</td>";
        		echo "<td>" . $rfp["length"] .        "</td>";
            echo "<td>" . $rfp["width"] .         "</td>";
        		echo "<td>" . $rfp["compdate"] .      "</td>"; 
        	
    				echo '<td><form action = "." method="POST">
							 <input type="hidden" name="action" value="viewSingleRfp">
							 <input type="hidden" name="RfpNum" value="' . $rfp["rfpnum"] . '">
							 <input type="submit" class="btn respondButton" value="View">
						  </form></td></tr>'; 
            }

        	}?>

          </table>

        </div>
        <div class="col-md-2"></div>

      </div><!-- End row -->

<?php include('includes/footer.html');