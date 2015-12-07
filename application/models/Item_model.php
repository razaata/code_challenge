<?php
/*
 * Item Model for code challenge.
 */

class Item_model extends CI_Model
{
    public $name;
    public $description;
    public $price;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_items()
    {
        $query = $this->db->get('items');
        return $query->result();
    }

    public function insert_item()
    {
        $this->name    = $_POST['name'];
        $this->description  = $_POST['description'];
        $this->price     = $_POST['price'];
        $this->db->insert('items', $this);
        if ($this->db->affected_rows() == '1')
        {
            return array('status'=>TRUE,'id'=>$this->db->insert_id());
        }
        return array('status'=>FALSE);
    }

    public function update_item()
    {
        $this->name    = $_POST['name'];
        $this->description  = $_POST['description'];
        $this->price     = $_POST['price'];
        $this->db->update('items', $this, array('id' => $_POST['id']));
        if ($this->db->affected_rows() >= 0) // update query run without error
        {
            return array('status'=>TRUE,'id'=>$_POST['id']);
        }
        return array('status'=>FALSE);
    }
}