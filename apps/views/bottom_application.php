<?php $this->load->view('project_footer'); ?> 
<?php if ($this->config->item('bottom.debug'))
{
?>
 <p class="mt5 mb5" align="center"><?php //$this->output->enable_profiler($this->config->item('bottom.debug')); ?><p>  
 
<?php
 }  
?>
<script type="text/javascript" src="<?php echo resource_url(); ?>Scripts/script.int.dg.js"></script>
<?php //$this->output->enable_profiler(true);?>
<?php $this->load->view("modals");?>
<script src="https://www.google.com/recaptcha/api.js"></script>
</body>
</html>