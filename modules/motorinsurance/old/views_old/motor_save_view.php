<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>


<?php foreach($status as $stat){ echo $stat;   }  ?>


<div class="w90 auto mt30">
	<p class="fr mt1"><a href="/motorinsurance" class="btn1 radius-20t" title="?Go Back">Go Back</a> </p>
	
	<h2 class="bb1 pb5">Thank you</h2>  

	 <div class="cb mb15"></div>
	 
	<div style="text-align:-moz-left;"><h3></br>

	Thank you for SAVING our service. We will get back you soon.</h3></div>

	<div class="cb mb15"></div>

</div>

<?php $this->load->view("bottom_application");?>