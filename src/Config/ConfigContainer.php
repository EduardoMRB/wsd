<?php
namespace WSD\Config;

use Symfony\Component\Yaml\Yaml;
/**
 * Class ConfigContainer
 * @author Eduardo Borges <eduardomrb@gmail.com>
 */
class ConfigContainer
{
    public function __construct($file)
    {
        if (!is_file($file)) {
            throw new \InvalidArgumentException('Specified file doest not exist');
        }

        $this->data = YAML::parse(file_get_contents($file));
    }

    /**
     * Returns parameters for DB connection
     *
     * @return Array
     */
    public function getDBParams()
    {
        return $this->data['database'];
    }
}

