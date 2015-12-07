<?php

/**
 * Part of CI PHPUnit Test
 *
 * @author     Ataraza <https://github.com/kenjis>
 * @license    MIT License
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Items_test extends TestCase
{
    public function test_lists_get()
    {
        // $this->assertNotEmpty($this->request('get','Items/lists'));
    }

    public function test_lists_post()
    {
        $_POST = [
            'name' => 'New Test',
            'description' => 'This is slfk asdkj lsdf.',
            'price' => 3
        ];

        $this->assertNotEmpty(
            $this->request(
                'post',
                'Items/lists',
                $_POST
            )
        );
    }
}
