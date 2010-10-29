<?php

/**
 *
 * @package    sfPhpunitHelpersPlugin
 * @subpackage testcase
 * 
 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
abstract class sfBasePhpunitSeleniumHelpersTestCase extends sfBasePhpunitSeleniumTestCase
{
  /**
   * 
   * @var unknown_type
   */
  protected $_helpers = array();
  
  /**
   * 
   * @param string $name
   * @param sfBasePhpunitHelper $helper
   * 
   * @return sfBasePhpunitSeleniumTestCase
   */
  public function helperRegister($name, sfBasePhpunitHelper $helper)
  {
    $helper->setTestCase($this);
    $this->_helpers[sfInflector::underscore($name)] = $helper;
    
    return $this;
  }
  
  /**
   * 
   * @param string $name
   * @throws Exception 
   * 
   * @return sfBasePhpunitHelper
   */
  public function helper($name)
  {
    if (!isset($this->_helpers[$name])) {
      throw new Exception('The helper with a given name `'.$name.'` does not exist.');
    }
    
    return $this->_helpers[$name];
  }
  
  public function __call($command, $arguments)
  { 
    $helperName = str_replace('helper', '', $command);
    if ($helperName != $command) {
      return $this->helper(sfInflector::underscore($helperName));
    }
    
    return parent::__call($command, $arguments);
  }
}