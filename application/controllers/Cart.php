<?php
/**
 * Created by PhpStorm.
 * User: razaata
 * Date: 04/12/15
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Cart extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Cart_model','',TRUE);
    }

    public function add_put()
    {
        $Cart_model = new Cart_model();
        if($this->_detect_method() == 'put'){
            $result = $Cart_model->insert_cart();
            if($result['status'] === FALSE)
            {
                $this->response(
                    [
                        'status' => FALSE,
                        'message' => 'Could not save the item into cart'
                    ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                ); // INTERNAL_SERVER_ERROR (500) being the HTTP response code
            } else
            {
                $this->response(
                    [
                        'status' => TRUE,
                        'id' => $result['id']
                    ], REST_Controller::HTTP_CREATED
                ); // CREATED (201) being the HTTP response code
            }
        } else
        {
            $this->response(
                [
                    'status' => FALSE,
                    'message' => 'Nothing Post'
                ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            ); // INTERNAL_SERVER_ERROR (500) being the HTTP response code
        }
    }
}