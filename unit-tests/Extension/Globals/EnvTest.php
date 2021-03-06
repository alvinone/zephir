<?php
/*
 +--------------------------------------------------------------------------+
 | Zephir Language                                                          |
 +--------------------------------------------------------------------------+
 | Copyright (c) 2013-2017 Zephir Team and contributors                     |
 +--------------------------------------------------------------------------+
 | This source file is subject the MIT license, that is bundled with        |
 | this package in the file LICENSE, and is available through the           |
 | world-wide-web at the following url:                                     |
 | https://zephir-lang.com/license.html                                     |
 |                                                                          |
 | If you did not receive a copy of the MIT license and are unable          |
 | to obtain it through the world-wide-web, please send a note to           |
 | license@zephir-lang.com so we can mail you a copy immediately.           |
 +--------------------------------------------------------------------------+
*/

namespace Extension\Globals;

use Test\Globals\Env;

class EnvTest extends \PHPUnit_Framework_TestCase
{
    /**
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        parent::setUp();

        if (strpos(ini_get('variables_order'), 'E') === false) {
            $this->markTestSkipped(
                "variables_order ini directive does not contain 'E'." .
                "Make sure you have set variables_order to 'EGPCS' in php.ini."
            );
        }

        if (!isset($_ENV)) {
            $_ENV = [];
        }
    }

    /** @test */
    public function readStandard()
    {
        $tester = new Env();

        $this->assertSame($_ENV['USER'], $tester->read('USER'));
        $this->assertSame($_ENV['USER'], getenv('USER'));
    }

    /** @test */
    public function readNew()
    {
        $_ENV['NEW_VARIABLEFROM'] = __FUNCTION__;
        $tester = new Env();

        $this->assertSame($_ENV['NEW_VARIABLEFROM'], $tester->read('NEW_VARIABLEFROM'));
        $this->assertSame(__FUNCTION__, $tester->read('NEW_VARIABLEFROM'));
    }
}
