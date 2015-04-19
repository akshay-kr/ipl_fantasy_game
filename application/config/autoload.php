<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('database','pagination');
$autoload['helper'] = array('url','main_helper');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('player_model','user_model');
