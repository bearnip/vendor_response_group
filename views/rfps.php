<?php include('includes/header.html'); ?>

	 <!-- RFPs we can respond to -->
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 pContent">
          <h2 class="sectionTitle">Available Requests For Proposal</h2>


          <table class="table">
        	<tr><th>Title</th><th>Podium</th><th>Projection</th><th>Seats</th><th>Stadium</th>
        	<th>Completion Date</th><th>HQ Audio</th></tr>

        	<?php 
        	foreach($allRfps as $rfp){

        		$hq = ($rfp["hqAudio"]==true ? "Yes" : "No");
        		$stadium = ( $rfp["stadium"]==true ? "Yes" : "No");

        		echo "<tr>";
        		//echo "<td>" . $rfp["RfpNum"] . "</td>"; 
        		echo "<td>" . $rfp["title"] . "</td>";
        		echo "<td>" . $rfp["podiumType"] . "</td>";
        		echo "<td>" . $rfp["projection"] . "</td>";
        		echo "<td>" . $rfp["seats"] . "</td>";
        		echo "<td>" . $stadium . "</td>";
        		echo "<td>" . $rfp["compDate"] . "</td>";    /********** Format This *********/
        		//echo "<td>" . $rfp["size"]["length"] . "x" . $rfp["size"]["width"] .  "x" . $rfp["size"]["height"] . "</td>";
				echo '<td><form action = "." method="POST">
							<input type="hidden" name="action" value="viewSingleRfp">
							<input type="hidden" name="RfpNum" value="' . $rfp["RfpNum"] . '">
							<input type="submit" class="btn respondButton" value="View">
						</form></td></tr>'; 

        	}?>

          </table>

        </div>
        <div class="col-md-2"></div>

      </div><!-- End row -->

<?php include('includes/footer.html');