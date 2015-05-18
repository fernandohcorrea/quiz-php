<?php

namespace Quiz;

/**
 * Description of Bootstrap
 *
 * @author fcorrea
 */
final class Bootstrap {

    private static $instance;
    private $cfg = array();

    private function __construct(array $config = NULL) 
    {
        if (is_null($config) && is_file(__DIR__ . DIRECTORY_SEPARATOR . 'Config/Core.php')) {
            $this->cfg = require __DIR__ . DIRECTORY_SEPARATOR . 'Config/Core.php';
        } else {
            $this->cfg = $config;
        }
        $this->validateCfg();
    }

    /**
     * @param array $config | NULL
     * @return \Quiz\Bootstrap
     */
    public static function getInstance(array $config = NULL)
    {
        $cls = __CLASS__;

        if (!is_object(self::$instance) && !(self::$instance instanceof $cls)) {
            self::$instance = new $cls($config);
        }

        return self::$instance;
    }

    private function validateCfg()
    {
        $requiredCfg = array(
            'questions_dir'
        );

        foreach ($requiredCfg as $keyCfg) {
            if (!isset($this->cfg[$keyCfg]) || empty($this->cfg[$keyCfg])) {
                $exMessage = sprintf('Invalid config key[%s]', $keyCfg);
                throw new \RuntimeException($exMessage, 500);
            }
        }

        if (!is_dir($this->cfg['questions_dir'])) {
            $exMessage = sprintf('Invalid path[%s]', $this->cfg['questions_dir']);
            throw new \RuntimeException($exMessage, 500);
        }
    }
    
    public function getConfig($configKey = NULL, $throws=TRUE)
    {
        if(!isset($this->cfg[$configKey]) && $throws){
            $exMessage = sprintf('Invalid config key[%s]', $configKey);
            throw new \RuntimeException($exMessage, 500);
        }
        
        return (isset($this->cfg[$configKey])) ? $this->cfg[$configKey] : NULL ;
    }
    
    
}
