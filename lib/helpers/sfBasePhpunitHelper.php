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
  
  public function __construct(PHPUnit_Extensions_SeleniumTestCase $testCase)
  {
    $this->_testCase = $testCase;
  }
}