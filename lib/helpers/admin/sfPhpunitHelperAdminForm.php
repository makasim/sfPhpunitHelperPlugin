<?php

/**
 *
 * @package    sfPhpunitHelpersPlugin
 * @subpackage helper
 * 
 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
class sfPhpunitHelperAdminForm extends sfBasePhpunitHelperAdmin
{
  public function clickAtBackToList()
  {
    $this->_testCase->clickAndWait("link=Back to list");
  }

  public function clickAtSaveForm()
  {
    $this->_testCase->clickAndWait("//input[@value='Save']");
  }

  public function assertFormNotSaved()
  {
    $this->_testCase->assertTextPresent('The item has not been saved due to some errors.');
  }

  public function assertFormSaved()
  {
    $this->_testCase->assertTextPresent('regexp:The item was (created|updated) successfully.');
  }

  public function assertFormFieldError($fileName, $errorText)
  {
    $this->_testCase->assertElementContainsText("css=.sf_admin_form_field_{$fileName}", $errorText);
  }
  
  public function assertFormGlobalError($errorText)
  {
    $this->_testCase->assertElementContainsText("css=ul.error_list li", $errorText);
  }

  public function assertItemDeleted()
  {
    $this->_testCase->assertTextPresent("The item was deleted successfully.");
  }
  
  public function typeTinymce($frameId, $text)
  {
    $this->_testCase->selectFrame($frameId);
    $this->_testCase->focus('tinymce');
    $this->_testCase->type('tinymce', $text);
    $this->_testCase->selectFrame('relative=parent');
  }
}