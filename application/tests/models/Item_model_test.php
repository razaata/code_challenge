<?php

class Items_model_test extends TestCase
{
    public function setUp()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('Item_model');
        $this->obj = $this->CI->Item_model;
    }

    public function test_get_all_items()
    {
        $expected = array(
                            1   =>  "Samsung",
                            2   =>  "HTC",
                            3   =>  "Iphone"
                        );
        $Item_model = new Item_model();
        $lists = $Item_model->get_all_items();
        $i = 0;
        foreach ($lists as $item) {
            $this->assertEquals($expected[$item->id], $item->name);
            $i++;
            if($i === 3)
            {
                break;
            }
        }
    }

    public function test_insert_item()
    {
        $data = array(
                        'name'          =>  "Testing Data Insert",
                        'description'   =>  "This is test data from Unit test",
                        'price'         =>  3
                     );
        $_POST = $data;
        $expected = TRUE;
        $Item_model = new Item_model();
        $list = $Item_model->insert_item();
        $actual = $list['status'];
        $this->assertEquals($expected, $actual);
    }

    public function test_update_item()
    {
        $data = array(
                        'id'            =>     3,
                        'name'          =>  "Iphone",
                        'description'   =>  "This is test data from Unit test update",
                        'price'         =>  3
                     );
        $_POST = $data;
        $expected = TRUE;
        $Item_model = new Item_model();
        $list = $Item_model->update_item();
        $actual = $list['status'];
        $this->assertEquals($expected, $actual);
    }
}