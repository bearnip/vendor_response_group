<?php include('includes/header.html'); ?>

<div class="row ">

	<div class="col-md-2"></div>


	<div class="col-md-8  pContent" id="rfpTable">
		
		<h2 class="sectionTitle"><?php echo $rfp["title"] ?> </h2>

		<table class="table">
			<tr><th>Purpose</th><td>			<?php echo $rfp["purpose"] ?></td></tr>
			<tr><th>Projection</th><td>			<?php echo $rfp["projection"] ?></td></tr>
			<tr><th>HQ Audio</th><td>			<?php echo $hq ?></td></tr>
			<tr><th>Stadium</th><td>			<?php echo $stadium ?></td></tr>
			<tr><th>Class Number</th><td>		<?php echo $rfp["classNum"] ?></td></tr>
			<tr><th>Length</th><td>				<?php echo $rfp["size"]["length"] ?></td></tr>
			<tr><th>Width</th><td>				<?php echo $rfp["size"]["width"] ?></td></tr>
			<tr><th>Height</th><td>				<?php echo $rfp["size"]["height"] ?></td></tr>
			<tr><th>Budget</th><td>				<?php echo $rfp["budget"] ?></td></tr>
		</table>

		<div id="doResponse">Create Response</div>

	</div>


	<div class="col-md-2">
				

	</div>

</div>

<div class="pContent" id="slideUp">
 <div id="closeForm">Back</div>

		<form action="." method="POST" class="form-horizontal" id="responseForm" role="form">

			<h2 class="sectionTitle">Respond To Proposal</h2>

			<div id="left">
				<div class="form-group">
                	<label class="col-xs-1" for="propTitle">Proposal Title</label>
            	    <input type="text" class="form-control input-small" name="propTitle" data-parsley-required data-parsley-trigger="focusout">
            	</div>

            	<div class="form-group">
                	<label class="col-xs-3" for="propCost">Proposal Cost</label>
                	<input type="text" class="form-control" name="propCost" data-parsley-trigger="focusout" 
                	data-parsley-pattern="/\b\d{1,3}(?:,?\d{3})*(?:\.\d{2})?\b/">
            	</div>

			</div><!--End of left section -->



			<div id="middle">

				<input type="hidden" name="action" value="submitResponse">
				<input type="hidden" name="RfpNum" value="<?php echo $_POST["RfpNum"]; ?>">
		
				<div class="form-group">
                	<label class="col-xs-3" for="sumDesc">Summary Description</label>
               	 	<textarea rows="10" cols="40" name="sumDesc" data-parsley-minlength="20"></textarea>
            	</div>

			</div><!-- End of middle section -->



			<div id="right">
				<div id="vendorPartnerInputs">
             		<div class="form-group">
             	   		<label class="col-xs-3" for="vP0">Vendor Partner</label>
             	   		<input type="text" class="form-control" name="vP0">
            		</div>
            	
            	</div>
            	
            	<div id="addPartner" alt="add partner"><h3>+</h3></div>
			</div>

			<div class="clear"></div>


			<div id="fileAndSubmit">
           		<p>Add File</p>
           		<input type="file" name="responseFile">
           		<input id="submitForm" type="submit" class="btn btn-default tab" value="submit">
           	</div>
		</form>
</div>








<?php include('includes/footer.html'); ?>