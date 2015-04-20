<?php

$config['first_link']     = 'First';
$config['div']         = 'container'; //Div tag id
$config['base_url']     = base_url().'manage/'.$ajax_function;
$config['total_rows']    = $TotalRec;
$config['per_page']     = $perPage;
$config['postVar']     = 'page';
 
$this->ajax_pagination->initialize($config);
echo $this->ajax_pagination->create_links();

