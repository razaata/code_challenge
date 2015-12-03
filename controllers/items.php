<?php
/**
 * Created by PhpStorm.
 * User: araza
 * Date: 4/1/15
 * Time: 7:03 PM
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {

    /**
     * Detect method
     *
     * Detect which method (POST, PUT, GET, DELETE) is being used
     *
     * @return string
     */


    public function __construct()
    {
        // echo "constructor"; die;
        parent::__construct();
        $this->load->database();
        $this->load->model('Item_model','',TRUE);
        $this->load->model('Cart_model','',TRUE);


    }
    private function _detect_method() {
        $method = strtolower($this->input->server('REQUEST_METHOD'));

        if ($this->config->item('enable_emulate_request')) {
            if ($this->input->post('_method')) {
                $method = strtolower($this->input->post('_method'));
            } else if ($this->input->server('HTTP_X_HTTP_METHOD_OVERRIDE')) {
                $method = strtolower($this->input->server('HTTP_X_HTTP_METHOD_OVERRIDE'));
            }
        }

        if (in_array($method, array('get', 'delete', 'post', 'put'))) {
            return $method;
        }

        return 'get';
    }

    public function index(){
        $this->lists();
    }

    public function save(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $Item_model = new Item_model();
        if($this->_detect_method() == 'post'){
            if(isset($_POST['id'])){
                $result = $Item_model->update_item();
            } else {
                $result = $Item_model->insert_item();
            }

            if($result['status'] === FALSE)
            {
                print json_encode(array('status' => 'failed','error' => 'data error'));
            }
            else
            {
                print json_encode(array('id' => $result['status'], 'status' => 'success'));
            }
        } else {
            print json_encode(array('status' => 'failed','error' => 'Nothing Post'));
        }

    }

    public function lists(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $Item_model = new Item_model();
        $result = $Item_model->get_all_items();


        if($result === FALSE)
        {
            print json_encode(array('status' => 'failed'));
        }

        else
        {
            print json_encode($result);
        }
    }


}