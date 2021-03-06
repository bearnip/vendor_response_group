<?php include('includes/header.html'); ?>

<div class="row ">

	<div class="col-md-2"></div>


	<div class="col-md-6  pContent" id="rfpTable">
		
		<h2 class="sectionTitle"><?php echo $rfp["rfpnum"]; ?> </h2>

		<table class="table">

			<tr><th>Summary</th>			<td><?php if(isset($rfp["summary"])){echo $rfp["summary"];} ?></td></tr>
			<tr><th>Contact</th>			<td><?php if(isset($rfp["contact"])){echo $rfp["contact"];} ?></td></tr>
			<tr><th>Email</th>				<td><?php if(isset($rfp["email"])){echo $rfp["email"];} ?></td></tr>
			<tr><th>Phone</th>				<td><?php if(isset($rfp["phone"])){echo $rfp["phone"];} ?></td></tr>
			<tr><th>Purpose</th>			<td><?php if(isset($rfp["purpose"])){echo $rfp["purpose"];}?></td></tr>
			<tr><th>Audio</th>				<td><?php if(isset($rfp["audio"])){ $rfp["audio"];} ?></td></tr>
			<tr><th>Seats</th>				<td><?php if(isset($rfp["seats"])){echo $rfp["seats"];} ?></td></tr>
			<tr><th>Projection</th>			<td><?php if(isset($rfp["projection"])){echo $rfp["projection"][0];} ?></td></tr>
			<tr>	<th>Podium</th>				<td><?php if(isset($rfp["podium"][0])){echo $rfp["podium"][0];} ?></td></tr>
			<tr><th>Class Number</th>		<td><?php if(isset($rfp["classnum"])){echo $rfp["classnum"];} ?></td></tr>
			<tr><th>Length</th>				<td><?php if(isset($rfp["length"])){echo $rfp["length"];} ?></td></tr>
			<tr><th>Width</th>				<td><?php if(isset($rfp["height"])){echo $rfp["height"];} ?></td></tr>
			<tr><th>Height</th>				<td><?php if(isset($rfp["width"])){echo $rfp["width"];}  ?></td></tr>
			<tr><th>Budget</th>				<td><?php if(isset($rfp["budget"])){echo $rfp["budget"];} ?></td></tr>
			<tr><th>Completetion Date</th>	<td><?php if(isset($rfp["compdate"])){echo $rfp["compdate"];}?></td></tr>
		</table>

		<div id="doResponse">Create Response</div>

	</div>


	<div class="col-md-3">
				

	</div>

</div>


<div class="pContent" id="slideUp">
 	
 	<div id="closeForm">Back</div>

		<form action="." method="POST" class="form-horizontal" id="responseForm" role="form">

			<h2 class="sectionTitle">Respond To Proposal</h2>


			<div id="middle">

				<input type="hidden" name="action" value="submitResponse">
				<input type="hidden" name="RfpNum" value="<?php echo $_POST["RfpNum"]; ?>">
				<input type="hidden" name="userID" value="<?php echo $rfpObj->getUserId ?>">

				<div class="form-group">
                	<label class="col-xs-1" for="propTitle">Proposal Title</label>
            	    <input type="text" class="form-control input-small" name="propTitle" data-parsley-required data-parsley-trigger="focusout">
            	</div>

            	<div class="form-group">
                	<label class="col-xs-3" for="propCost">Proposal Cost</label>
                	<input type="text" class="form-control" name="propCost" data-parsley-trigger="focusout" 
                	data-parsley-pattern="/^\d{1,}\.\d{2}$/">
            	</div>
		
				<div class="form-group">
                	<label class="col-xs-3" for="sumDesc">Summary Description</label><br />
               	 	<textarea rows="10" cols="40" name="sumDesc" data-parsley-minlength="20" required
               	 	 data-parsley-trigger="focusout" ></textarea>
            	</div>


            	<input type="file" name="responseFile" id="fileButton">
           		<input id="submitForm" type="submit" class="btn btn-default tab" value="submit">


			</div><!-- End of middle section -->


            <div id="right">

            	

            	<div id="vendorPartnerInputs">
             		<div class="form-group">
             	   		<label class="col-xs-3" for="vP0">Vendor Partner</label>
             	  		<input type="text" class="form-control" name="vP0">
            		</div>
            		
            	</div>
            	
            	
            </div>




           	
		</form>

		 <div id="addButtonDiv">
            	<div id="addPartner" alt="add partner"><h3>+</h3></div>
            </div>
</div>








<?php include('includes/footer.html'); ?>