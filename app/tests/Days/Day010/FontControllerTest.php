<?php

use Days\Day010\FontController;

/**
 * @group now
 */
class FontControllerTest extends ControllerTestCase
{
    public function testIndexReturnsView()
    {
        $test = new FontController;

        $response = $test->index();
        $this->assertIsView($response);
    }
}