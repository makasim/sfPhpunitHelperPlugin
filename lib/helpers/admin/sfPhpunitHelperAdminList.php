<?php

/**
 *
 * @package    sfPhpunitHelpersPlugin
 * @subpackage helper
 * 
 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
class sfPhpunitHelperAdminList extends sfBasePhpunitHelperAdmin
{
  /**
   * 
   * @param string $rowNumber
   * 
   * @return sfPhpunitHelperAdminList
   */
  public function clickAtEdit($rowNumber)
  {
    $this->_testCase->clickAndWait(
      "//tr[{$rowNumber}]//li[@class='sf_admin_action_edit']/a");
    
    return $this;
  }

  /**
   * 
   * @param int $rowNumber
   * 
   * @return sfPhpunitHelperAdminList
   */
  public function clickAtDelete($rowNumber)
  {
    //symfony confiramtion is failed in this case.
    $this->_testCase->click("//tr[{$rowNumber}]//li[@class='sf_admin_action_delete']/a");

    sleep(1);
    $this->_testCase->assertTrue(
      (bool)preg_match('/^Are you sure[\s\S]$/', 
       $this->_testCase->getConfirmation()));
    $this->_testCase->waitForPageToLoad();
    
    return $this;
  }

  /**
   * 
   * @return sfPhpunitHelperAdminList
   */
  public function clickAtNew()
  {
    $this->_testCase->clickAndWait("link=New");
    
    return $this;
  }
  
  public function clickAtRowLink($rowNumber, $cellName, $cellType = 'text')
  {
    $this->_testCase->clickAndWait(
      "//tbody/tr[{$rowNumber}]" . 
      "/td[@class='sf_admin_{$cellType} sf_admin_list_td_{$cellName}']/a");
  }
  
  /**
   * 
   * @return sfPhpunitHelperAdminList
   */
  public function assertListPresent()
  {
    $this->_testCase->assertElementPresent('css=div.sf_admin_list');
    
    return $this;
  }
  
  /**
   * 
   * @param string $cellName
   * @param string $expectedText
   * @param string $cellType
   * 
   * @return sfPhpunitHelperAdminList
   */
  public function assertHeaderContains($cellNumber, $expectedText, $cellType = 'text')
  {
    $this->_testCase->assertElementContainsText(
      "//thead/tr[1]/th[{$cellNumber}]",
      $expectedText);
    
    return $this;
  }

  /**
   * 
   * @param string $rowNumber
   * @param string $cellName
   * @param string $expectedText
   * @param string $cellType
   * 
   * @return sfPhpunitHelperAdminList
   */
  public function assertRowContains($rowNumber, $cellName, $expectedText, $cellType = 'text')
  {
    $this->_testCase->assertElementContainsText(
      "//tbody/tr[{$rowNumber}]/td[@class='sf_admin_{$cellType} sf_admin_list_td_{$cellName}']",
      $expectedText);
      
    return $this;
  }
  
  /**
   * 
   * @return sfPhpunitHelperAdminList
   */
  public function assertItemDeleted()
  {
    $this->_testCase->assertTextPresent("The item was deleted successfully.");
    
    return $this;
  }
  
  /**
   * 
   * @param int $expectedTotal
   * 
   * @return sfPhpunitHelperAdminList
   */
  public function assertPagerTotal($expectedTotal)
  {
    throw new Exception('not implemented yet');
    
    return $this;
  }
  
  /**
   * 
   * @param int $expectedFrom
   * 
   * @return sfPhpunitHelperAdminList
   */
  public function assertPagerFrom($expectedFrom)
  {
    throw new Exception('not implemented yet');
    
    return $this;
  }
  
  /**
   * 
   * @param int $expectedTo
   * 
   * @return sfPhpunitHelperAdminList
   */
  public function assertPagerTo($expectedTo)
  {
    throw new Exception('not implemented yet');
    
    return $this;
  }
}