<?php
$footer_content = get_db_field_value('wl_cms_pages','page_description',"WHERE friendly_url='footer-content' AND status='1'");

$footer_cat_qry = $this->db->select('category_name,friendly_url,category_alt')->limit(28)->order_by('sort_order')->get_where('wl_categories',array('parent_id'=>'0','status'=>'1'));

$footer_cat_count = $footer_cat_qry->num_rows();

//$this->load->view('banner/footer_banner');
?>
<!-- FOOTER STARTS -->

<?php 

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

  //if (strpos($url,'vendors') === false) {
	  
?>
	<footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 column">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>pages/infopages/about_us">About Us</a></li>
                       <!--  <li><a href="">Prodcuts / Services</a></li> -->
                        <!-- <li><a href="">Testimonials</a></li>
      <li><a href="http://www.teluscare.com/">Newsletter</a></li> -->
                        <li><a href="<?php echo base_url(); ?>pages/infopages/faq_page">FAQ's</a></li>
                    </ul>
                </div>
    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 column">
                    <h4>Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url(); ?>pages/infopages/contact_us">Contact Us</a></li>
                        <!-- <li><a href="">Advertise with Us</a></li> -->
                        <li><a href="<?php echo base_url(); ?>pages/infopages/Privacy_policy">Privacy Policy</a></li>
                        <li><a href="<?php echo base_url(); ?>pages/infopages/legal_disclaimer">Legal Disclaimer</a></li>
      <li><a href="<?php echo base_url(); ?>pages/infopages/team_condition">Terms &amp; Conditions</a></li>
                        <!-- <li><a href="">Sitemap</a></li> -->
                    </ul>
                </div>
    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 column">
                    <h4>Consumers</h4>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url(); ?>pages/infopages/how_to_buy">How to Buy</a></li>
                        <li><a href="<?php echo base_url(); ?>pages/infopages/buying_guidelines">Buying Guidelines</a></li>
                        <!-- <li><a href="">Login</a></li>
                        <li><a href="">Registration</a></li> -->
                    </ul>
                </div> 
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6 column">
                   <h4>SBP</h4>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url(); ?>pages/infopages/how_to_sell">How to Sell</a></li>
                        <li><a href="<?php echo base_url(); ?>pages/infopages/selling_guidelines">Selling Guidelines</a></li>
                        <!-- <li><a href="">Login</a></li>
                        <li><a href="">Registration</a></li> -->
                    </ul>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-10 col-offset-xs-1 column" style="text-align:center;">
                    <h4>Follow</h4>
     <p class="soc_links fr mt2">
      <a class="fbook" href="#" title="Facebook"></a>
      <a class="twit" href="#" title="Twitter"></a>
      <a class="in" href="#" title="linkedin"></a>
      <a class="gplus" href="#" title="Google+"></a>
      <a class="ytube" href="#" title="Youtube"></a>
     </p>
                </div>
            </div>
            <br/>
            <!-- <span class="pull-right text-muted small"><a href="http://www.bootstrapzero.com">Landing Zero by BootstrapZero</a> ©2015 Company</span> -->
        </div>
    </footer>
	
  <?php //} ?>		
  <!-- FOOTER ENDS -->
<!--<p id="back-top"><a href="#top"><span>&nbsp;</span></a></p>-->
<!--BODY ENDS-->