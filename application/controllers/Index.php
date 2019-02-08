<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Index extends \CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $this->layout->pageDetails("test title","index","sample description");
        $this->layout->headCss(array("css1","css2"));
        $this->layout->headJs(array("js1","js2"));
        $this->layout->footerJs(array("js2","js.........."));
        $this->layout->footerCss(array("cs2","css............"));

        $this->layout->admin_view("admin/base");
    }

}
