<?php

/**
 *
 * @package    sfPhpunitHelpersPlugin
 * @subpackage helper
 * 
 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
abstract class sfBasePhpunitHelper
{ 
  /**
   * 
   * @var PHPUnit_Extensions_SeleniumTestCase
   */
  protected $_testCase;
  
  /**
   * 
   * @param PHPUnit_Extensions_SeleniumTestCase $testCase
   * 
   * @return sfBasePhpunitHelper
   */
  public function setTestCase(PHPUnit_Extensions_SeleniumTestCase $testCase)
  {
    $this->_testCase = $testCase;
    
    return $this;
  }
  
  /**
   * 
   * @throws Exception
   * 
   * @return PHPUnit_Extensions_SeleniumTestCase
   */
  public function getTestCase()
  {
    if (!$this->_testCase) {
      throw new Exception('The test case must be set before any tries to access it');
    }
    
    return $this->_testCase;
  }
}