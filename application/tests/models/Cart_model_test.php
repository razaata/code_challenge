<?php

class Cart_model_test extends TestCase
{
    public function setUp()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('Cart_model');
        $this->obj = $this->CI->Cart_model;
    }

    public function test_insert_cart()
    {
        $data = array(
                        'customer_id'   =>  1,
                        'item_id'       =>  2
                     );
        $_POST = $data;
        $expected = TRUE;
        $Cart_model = new Cart_model();
        $list = $Cart_model->insert_cart();
        $actual = $list['status'];
        $this->assertEquals($expected, $actual);
    }
}