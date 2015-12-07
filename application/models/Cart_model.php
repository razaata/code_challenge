<?php
/*
 * Cart Model for code challenge.
 */

class Cart_model extends CI_Model
{
    public $customer_id;
    public $item_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_cart()
    {
        $this->customer_id = $_POST['customer_id'];
        $this->item_id = $_POST['item_id'];
        $this->db->insert('cart', $this);
        if ($this->db->affected_rows() == '1') {
            return array('status' => TRUE, 'id' => $this->db->insert_id());
        }
        return array('status' => FALSE);
    }
}