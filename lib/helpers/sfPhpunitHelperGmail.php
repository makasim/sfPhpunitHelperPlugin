<?php

/**
 *
 * @package    sfPhpunitHelpersPlugin
 * @subpackage helper
 * 
 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
class sfPhpunitHelperGmail extends sfBasePhpunitHelper
{
  /**
   * @return sfPhpunitHelperGmail
   */
  public function open()
  {
    //wait for mail to be delivered
    sleep(10);
    
    $this->_testCase->openAndWait('http://gmail.com');
    
    return $this;
  }
  
  /**
   * 
   * @param string $email
   * @param string $password
   * 
   * @return sfPhpunitHelperGmail
   */
  public function login($email, $password)
  {
    $this->_testCase->type("Email", "newuser.jjthreads");
    $this->_testCase->type("Passwd", "asdfFDSA123#");
    $this->_testCase->clickAndWait("signIn");
    
    return $this;
  }
  
  /**
   * @return sfPhpunitHelperGmail
   */
  public function assertNewMail($from, $subject)
  {
    $this->_testCase->assertTextPresent($from);
    $this->_testCase->assertElementContainsText("//tr[@bgcolor='#ffffff']//td[3]//b[1]", $subject);
    
    return $this;
  }
  
  /**
   * @return sfPhpunitHelperGmail
   */
  public function clickAtMailWithSubject($subject)
  {
    $this->_testCase->clickAndWait("link={$subject}");
    
    return $this;
  }
}