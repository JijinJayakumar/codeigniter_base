<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**

 * @package    Ci

 * @subpackage Library

 * @author     Jijin

 * @disclamer Please do not change ,  feel free to create new one

 */
use app\libraries\Library;
class Layout extends Library
{
    public $headerArray=[];
    public $footerArray=[];
    public function __construct()
    {
        parent::__construct();
    }

    public function defaultHeader(){

        $this->defaulHeader['css']=array("la la laaaaaa", "la laaaa.......");
      $this->headerArray= array_merge_recursive($this->headerArray, $this->defaulHeader);

    }

    public function defaultFooter(){
        $this->defaulFooter =array("js"=>array("la la laaaaaa footer", "Footer la laaaa......."),"css"=>array("aaaaaa"));
        $this->footerArray= array_merge_recursive($this->footerArray, $this->defaulFooter);
    }


    public function pageDetails($title='',$currentPage='',$description='')
    {
        $this->headerArray['page'] = array(
            "title" => $title,
            "description" => $description,
            "current_page"=>$currentPage,
        );
    }

    public function headCss($data=[]){
        $this->headerArray['css']=$data;
    }

    public function headJs($data = [])
    {
        $this->headerArray['js']=$data;
    }

    public function footerCss($data = [])
    {
        $this->footerArray['css'] = $data;
    }

    public function footerJs($data = [])
    {
        $this->footerArray['js'] = $data;
    }


    public function view($file,$data=[]){

        $this->defaultHeader();
        $this->defaultFooter();
     
        $this->ci->load->view("", $this->headerArray);
        $this->ci->load->view("", $this->headerArray);
        $this->ci->load->view("", $data);
        $this->ci->load->view("", $this->footerArray);


    }

  

}
