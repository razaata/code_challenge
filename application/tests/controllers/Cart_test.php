<?php

/**
 * Part of CI PHPUnit Test
 *
 * @author     Ataraza <https://github.com/kenjis>
 * @license    MIT License
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Cart_test extends TestCase
{
    public function test_add_put()
    {
        $_POST = [
            'customer_id' => 5,
            'item_id' => 3
        ];
        $this->assertNotEmpty(
            $this->request(
                'put',
                'Cart/add',
                $_POST
            )
        );
    }
}
