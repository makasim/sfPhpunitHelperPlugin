<?php

/**
 *
 * @package    sfPhpunitHelpersPlugin
 * @subpackage helper
 * 
 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
class sfPhpunitHelperAdmin extends sfBasePhpunitHelperAdmin
{
  public function clickAtTopMenu($clickAt)
  {
    $this->_testCase->clickAndWait($clickAt);
  }

  public function clickAtEditItem($itemId)
  {
    $this->_testCase->clickAndWait("//tr[{$itemId}]//li[@class='sf_admin_action_edit']/a");
  }

  public function clickAtDeleteItem($itemId)
  {
    //symfony confiramtion is failed in this case.
    $this->_testCase->click("//tr[{$itemId}]//li[@class='sf_admin_action_delete']/a");

    sleep(1);
    $this->_testCase->assertTrue(
      (bool)preg_match('/^Are you sure[\s\S]$/', 
       $this->_testCase->getConfirmation()));
    $this->_testCase->waitForPageToLoad();
  }

  public function clickAtNewItem()
  {
    $this->_testCase->clickAndWait("link=New");
  }

  public function assertItemFieldContains($itemId, $fieldName, $text, $fieldType = 'text')
  {
    $this->_testCase->assertElementContainsText(
      "//tbody/tr[{$itemId}]/td[@class='sf_admin_{$fieldType} sf_admin_list_td_{$fieldName}']",
      $text);
  }

  public function assertItemDeleted()
  {
    $this->_testCase->assertTextPresent("The item was deleted successfully.");
  }
}