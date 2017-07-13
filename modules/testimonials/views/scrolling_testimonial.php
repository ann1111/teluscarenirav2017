<?php
$this->load->model(array('testimonials/testimonial_model'));
$param         = array('status'=>'1','orderby'=>'RAND()');	
$res_array     = $this->testimonial_model->get_testimonial(10,0,$param);

if(is_array($res_array) && !empty($res_array))
{
	?>
	<div class="fl mt22 w478px"> <a href="<?php echo base_url();?>testimonials" class="btn2s pl10 pr10 mt2 fr mr10 trans_eff" title="View all Testimonials">View all Testsimonials</a>
	  <h3 class="ml13">Testimonials</h3>
	  <div class="cb"></div>
	  <a href="javascript:void(0)" title="Previous" class="prev3"><img src="<?php echo theme_url();?>images/arl2.png" class="db fl mt38 arrow2 trans_eff" alt=""></a> <a href="javascript:void(0)" title="Next" class="next3"><img src="<?php echo theme_url();?>images/arr2.png" class="db fr mt38 arrow2 trans_eff" alt=""></a>
	  <div class="test_cont fl mt25 ml20 rel">
		<div class="test_scroll">
		  <ul class="myulx">
			<?php
			foreach($res_array as $val)
			{
			  $link_details = base_url().'testimonials/details/'.$val['testimonial_id'];
			?>
			  <li>
				<div class="test_cont_inr ac">
				  <div class="lht-18 fs13 mnht_72"><?php echo char_limiter($val['testimonial_description'],100);?></div>
				  <p class="black ttu mt12"><?php echo $val['poster_name'];?></p>
				  <p class="fs12 b orange"><a href="<?php echo base_url();?>testimonials" title="Read More &raquo;" class="uo">Read More &raquo;</a></p>
				</div>
			  </li>
          <?php
			}
		  ?>
		  </ul>
		</div>
	  <div class="cb"></div>
	</div>
	<div class="cb"></div>
  </div>
  <!-- TESTIMONIALS END -->
<?php
}