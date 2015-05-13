<?php 
if($this->session->flashdata('success')!="")
echo '<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><b>SUCCESS!</b> '.$this->session->flashdata('success').'</div>';
if($this->session->flashdata('error')!="")
echo '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><b>ERROR!</b> '.$this->session->flashdata('error').'</div>';
