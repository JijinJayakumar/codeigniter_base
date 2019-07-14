<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$autoload['packages']  = array();
$autoload['libraries'] = array(
    'database',
    'email',
    'session',
    'format',
    'layout'
    
);
$autoload['drivers']   = array();
$autoload['helper']    = array(
    'url',
    'file',
    'site_helper'
);
$autoload['config']    = array(
    'site_urls'
);
$autoload['language']  = array();
$autoload['model']     = array(
    'crud'
);
