<?php
namespace WSD\Test\Config;

use WSD\Config\ConfigContainer;

class ConfigContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConfigContainer
     */
    private $container;
    
    public function setUp()
    {
        $this->container = new ConfigContainer(__DIR__ . '/config_test.yml');
    }
    
    public function test_db_params_are_returned_correctly()
    {
        $expected = [
            'adapter' => 'mysql',
            'database' => 'test',
            'host' => 'localhost',
            'user' => 'root',
            'pass' => '',
        ];

        $this->assertEquals($expected, $this->container->getDBParams());
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Specified file doest not exist
     */
    public function test_exception_is_thrown_if_invalid_file_is_given_to_constructor()
    {
        $container = new ConfigContainer('invalid-path');
    }

    /**
     * @expectedException Symfony\Component\Yaml\Exception\ParseException
     **/
    public function test_invalid_configuration_file_throws_exception()
    {
        $container = new ConfigContainer(__DIR__ . '/invalid_config.yml');
    }
}
