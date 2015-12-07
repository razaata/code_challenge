<?php
/**
 * Created by PhpStorm.
 * User: razaata
 * Author: Ata Raza
 * Date: 04/12/15
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Items extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Item_model','',TRUE);
        $this->methods['lists_get']['limit'] = 500; // 500 requests per hour per items
        $this->methods['lists_post']['limit'] = 100; // 100 requests per hour per items
    }

    public function index(){
        $this->lists();
    }

    public function lists_get()
    {
        $Item_model = new Item_model();
        $lists = $Item_model->get_all_items();
        if($lists === FALSE)
        {
            print json_encode(array('status' => 'failed'));
        }
        $id = $this->get('id');
        // If the id parameter doesn't exist return all the users
        if ($id === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($lists)
            {
                // Set the response and exit
                $this->response($lists, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else
            {
                // Set the response and exit
                $this->response(
                    [
                        'status' => FALSE,
                        'message' => 'No users were found'
                    ],
                    REST_Controller::HTTP_NOT_FOUND
                ); // NOT_FOUND (404) being the HTTP response code
            }
        }
        // Find and return a single record for a particular user.
        $id = (int) $id;
        // Validate the id.
        if ($id <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        // Get the user from the array, using the id as key for retreival.
        // Usually a model is to be used for this.
        $list = NULL;
        if (!empty($lists))
        {
            foreach ($lists as $key => $value)
            {
                $value = (array) $value;
                $value['id'] = (int) $value['id'];
                if (isset($value['id']) && $value['id'] === $id)
                {
                    $list = $value;
                }
            }
        }

        if (!empty($list))
        {
            $this->set_response($list, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else
        {
            $this->set_response(
                [
                    'status' => FALSE,
                    'message' => 'Item could not be found'
                ], REST_Controller::HTTP_NOT_FOUND
            ); // NOT_FOUND (404) being the HTTP response code
        }
    }

    /**
     * Insert a item record into the database
     *
     * @access public
     * @return void
     */
    public function lists_post()
    {
        $Item_model = new Item_model();
        if($this->_detect_method() == 'post')
        {
            if(isset($_POST['id']))
            {
                $lists = $Item_model->update_item();
            } else
            {
                $lists = $Item_model->insert_item();
            }
            if($lists['status'] === FALSE)
            {
                $this->response(
                    [
                        'status' => FALSE,
                        'message' => 'Could not save the item'
                    ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                ); // INTERNAL_SERVER_ERROR (500) being the HTTP response code
            } else
            {

                $this->response(
                    [
                        'status' => TRUE,
                        'id' => $lists['id']
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