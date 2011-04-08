<?php

/**
 *
 * @package    sfPhpunitHelpersPlugin
 * @subpackage helper
 * 
 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
class sfPhpunitHelperGmailImap extends sfBasePhpunitHelper
{
  protected $_login;
  
  protected $_password;
  
  protected $_imap;
  
  protected $_messageNumber;
  
  public function login($login, $password)
  {
    $this->_connect($login, $password);
  }
  
  public function deleteAll()
  {    
    if ($this->_messageNumber > 0) {
      foreach (imap_fetch_overview($this->_getImap(),"1:{$this->_messageNumber}",0) as $message) {
        imap_delete($this->_getImap(), $message->msgno);
      }

      imap_expunge($this->_getImap());
      $this->_reconnect();
    }
  }
  
  public function waitForNew($seconds, $numberOfMails = 1)
  {
    $startTime = time();
    while ($startTime + $seconds > time()) {
      $currentMessageNumber = $this->_getMessagesNumber();
      if ($currentMessageNumber >= $this->_messageNumber + $numberOfMails) {       
        $this->_reconnect();
        
        return true;
      }
      
      sleep(1);
    }
    
    return false;
  }
  
  public function getLast()
  {
    return new sfPhpunitHelperGmailImapMessage($this->_getImap(), $this->_messageNumber);
  }
  
  public function getBeforeLast()
  {
    return new sfPhpunitHelperGmailImapMessage($this->_getImap(), $this->_messageNumber - 1);
  }
  
  //public function waitFor
  
  protected function _reconnect()
  {
    $this->_close();
    $this->_connect($this->_login, $this->_password);
  }
  
  protected function _close()
  {
    $this->_imap && imap_close($this->_imap);
  }
  
  protected function _connect($login, $password)
  {
    $this->_login = $login;
    $this->_password = $password;
    
    $this->_imap = imap_open('{imap.gmail.com:993/ssl}INBOX', $login, $password);
    
    $this->_messageNumber = $this->_getMessagesNumber();
  }
  
  protected function _getStatus($option)
  {
    $constantName = 'SA_' . strtoupper($option);
    
    $status = imap_status($this->_getImap(), '{imap.gmail.com:993/ssl}INBOX', constant($constantName));

    return $status->{$option};
  }
  
  protected function _getMessagesNumber()
  {
    return $this->_getStatus('messages');
  }
  
  protected function _getImap()
  {
    if (!$this->_imap) {
      throw new Exception('The resource imap has not setuped yet. You should login to gmail before any other use');
    }
    
    return $this->_imap;
  }
  
  public function __destruct() 
  {
    $this->_close();
  }
}