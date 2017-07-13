<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>

<style type="text/css">
	.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
	.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
	.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
	.tg .tg-s6z2{text-align:center}
	.tg .tg-spn1{background-color:#f9f9f9;text-align:center}
	.tg .tg-4eph{background-color:#f9f9f9}
	.success{  font-size: 20px;  margin: 0 0 0 500px; color:green;}
</style>

<div class="w90 auto mt90">
<p class="fr mt1"><a href="<?php echo base_url(); ?>vendors/" class="btn1 radius-20t" title="�Go Back">Go Back</a> </p>
<p class="fr mt1"><a href="<?php echo base_url(); ?>vendors/pestcontrol/edit_vendor_entries" class="btn1 radius-20t" title="�Go Back">Edit Vendor Entries</a> </p>

	<?php 
	
	foreach($status as $ss){  if($ss['success']){ echo '<span class="success">'.$ss.'</span>'; }else{echo '<span class="red">'.$ss.'</span>'; } }
	?>	

	<h2 class="bb1 pb5 black text-center"> Add - Rates - Pest Control Service</h2>
	<div class="cb mb15"></div>
	
	<?php echo form_open_multipart('/vendors/pestcontrol/add_pestcontrol_rates', 'id="exclude_data"'); ?>	
	
	<div class="mt20 w80 short_form fs14 auto p20 border1">

	  <fieldset class="pb15 mt30" style="border:0;">

		<p class="w36 pt8">

		  <label for="type_service">TYPE OF SERVICE : <b class="red">*</b></label>
		</p>

		<div class="w62">

				<?php echo get_pest_type_of_service_field('type_of_service','type_of_service',00); ?>

		</div>

		<div class="cb pb10"></div>



		<p class="w36 pt8">
		  <label for="type_permises">TYPE OF PREMISES : <b class="red">*</b></label>
		</p>

		<div class="w62">

		  <?php echo get_type_of_premises_field('premises','premises',00); ?>

		</div>

		<div class="cb pb10"></div>

		<p class="w36 pt8">

		  <label for="select_permises">SELECT PREMISES <b class="red">*</b> :</label>

		</p>

		<div class="w62 kop">
			<select name="" style="color:#111;" ><option >Select</option></select>
		 <?php //echo get_kind_of_premises_field('kind_premises','kind_premises',00); ?>
		
		</div>
		
		<div class="cb pb10"></div>

		<p class="w36 pt8">

		  <label for="enter_rate">ENTER RATE (AED) <b class="red">*</b> :</label>

		</p>

		<div class="w62">
			<input type="text" name="rate" class="form-control"/>
		</div>
		
		<div class="cb pb10"></div>

		<p class="w36 pt8">

		  <label for="upload_doc">UPLOAD DOC <b class="red">*</b> :</label>

		</p>

		<div class="w62">
			<input type="file" name="file1" class="form-control" style="padding:0;"/>
		</div>
	</fieldset>

	</div>	 
	  <div class="cb mb15"></div>
	  <div class="fl w25 short_form ml16">
		<p class="mt6" style="width:100%"></p>
	  </div>
	 <div class="fl w70 short_form ml16">
		<p class="mt6" style="width:50%;text-align:center;">
			<input name="sbt_btn" value="Add Rates" name="submit" id="Add_rates" class="btn3 radius-3 trans_eff" type="submit">
		</p>
	 </div>
	 <?php echo form_close(); ?>
	 
</div>


	 
 <div class="cb mb15"></div>	

<style>
.multiselect {padding: 5px;width: 65%;height:100px;border-radius: 5px;border: 1px solid #999;font-size: 14px;cursor: pointer;}.multiselect-on {    color:#ffffff;    background-color:#000099;}
</style>
	
<script>

  $("#select_all").click(function(){  //"select all" change
	var status = this.checked; // "select all" checked status
    $('.multiselect input[type=checkbox]').each(function(){ //iterate all listed checkbox items
        this.checked = status; //change ".checkbox" checked status
    });
});

				$('document').ready(function(){
					
					$('.premises').on('change',function(){
						var get_val = $(this).val();
						if(get_val == 1 || get_val == 3 ){
							
							$('.kop').html('<select id="kind_premises" name="kind_premises" class="form-control"></select>');
							if(get_val == 3){
								var elem = ["Select","STUDIO","1 BHK","2 BHK","3 BHK","4 BHK","5 BHK"];  
							}else{
								var elem = ["Select","1 BHK","2 BHK","3 BHK","4 BHK","5 BHK"];     
							}
							
							var sel = document.getElementById('kind_premises');
							for(var i = 0; i < elem.length; i++) {
								var opt = document.createElement('option');
								opt.innerHTML = elem[i];
								opt.value = i;
								sel.appendChild(opt);
							}
							
						}if(get_val == 2 || get_val == 4 || get_val == 5){
							$('.kop').html('<select id="area" name="area" class="form-control"></select>');
							
							var elem = ["Select","below 500 sqft","500 sqft to 1000 sqft","1000 sqft to 2000 sqft","2000 sqft to 3000 sqft","3000 sqft to 4000 sqft","4000 sqft to 5000 sqft","5000 sqft to 7000 sqft","7000 sqft to 10000 sqft","10000 sqft to 20000 sqft","20000 sqft & above"];     

							var sel = document.getElementById('area');
							for(var i = 0; i < elem.length; i++) {
								var opt = document.createElement('option');
								opt.innerHTML = elem[i];
								opt.value = i;
								sel.appendChild(opt);
							}
						}
						
					});
				});
			
			
</script>
<?php $this->load->view("bottom_application");?>