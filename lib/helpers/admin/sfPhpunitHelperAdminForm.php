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
  /**
   *
   * @return sfPhpunitHelperAdminForm
   */
  public function clickAtBackToList()
  {
    $this->_testCase->clickAndWait("link=Back to list");

    return $this;
  }

  /**
   *
   * @return sfPhpunitHelperAdminForm
   */
  public function clickAtSaveForm()
  {
    $this->_testCase->clickAndWait("//input[@value='Save']");

    return $this;
  }

  /**
   *
   * @return sfPhpunitHelperAdminForm
   */
  public function assertFormNotSaved()
  {
    $this->_testCase->assertTextPresent('The item has not been saved due to some errors.');

    return $this;
  }

  /**
   *
   * @return sfPhpunitHelperAdminForm
   */
  public function assertFormSaved()
  {
    $this->_testCase->assertTextPresent('regexp:The item was (created|updated) successfully.');

    return $this;
  }

  /**
   *
   * @return sfPhpunitHelperAdminForm
   */
  public function assertFormFieldError($fieldName, $errorText)
  {
    $this->_testCase->assertElementContainsText("css=.sf_admin_form_field_{$fieldName}", $errorText);

    return $this;
  }

  /**
   *
   * @return sfPhpunitHelperAdminForm
   */
  public function assertFormGlobalError($errorText)
  {
    $this->_testCase->assertElementContainsText("css=ul.error_list li", $errorText);

    return $this;
  }

  /**
   *
   * @return sfPhpunitHelperAdminForm
   */
  public function assertItemDeleted()
  {
    $this->_testCase->assertTextPresent("The item was deleted successfully.");

    return $this;
  }

  /**
   *
   * @return sfPhpunitHelperAdminForm
   */
  public function typeTinymce($frameId, $text)
  {
    $this->_testCase->selectFrame($frameId);
    $this->_testCase->focus('tinymce');
    $this->_testCase->type('tinymce', $text);
    $this->_testCase->selectFrame('relative=parent');

    return $this;
  }

  /**
   *
   * @param string $formName
   * @param string $fieldName
   * @param string $text
   *
   * @return sfPhpunitHelperAdminForm
   */
  public function type($formName, $fieldName, $text)
  {
    $this->_testCase->type("{$formName}_{$fieldName}", $text);

    return $this;
  }
}