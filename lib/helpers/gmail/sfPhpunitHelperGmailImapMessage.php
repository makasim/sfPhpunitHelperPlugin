<?php

/**
 *
 * @package    sfPhpunitHelpersPlugin
 * @subpackage helper
 * 
 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
class sfPhpunitHelperGmailImapMessage extends sfBasePhpunitHelper
{
  protected $_imap;
  
  protected $_messageNumber;
  
  protected $_body;
  
  protected $_header;
  
  public function __construct($imap, $messageNumber) 
  {
    $this->_imap = $imap;
    $this->_messageNumber = $messageNumber;    
  }
  
  public function getSubject()
  {
    return $this->_getHeaderInfo()->subject;
  }
  
  public function getTo()
  {
    return $this->_getHeaderInfo()->toaddress;
  }
  
  public function getFrom()
  {
    return $this->_getHeaderInfo()->fromaddress; 
  }
  
  public function getBodyPart($mimeType)
  {
    return $this->get_part($this->_imap, $this->_messageNumber, $mimeType);
  }
  
  protected function _getBodyRaw()
  {
    if (!$this->_body) {
      $this->_body = imap_body($this->_imap, $this->_messageNumber);
    }
    
    return $this->_body;
  }
  
  protected function _getHeaderInfo()
  {
    if (!$this->_header) {
      $this->_header = imap_headerinfo($this->_imap, $this->_messageNumber);
    }
    
    return $this->_header;
  }
  
  ### FUNCTIONAS FROM http://www.linuxscope.net/articles/mailAttachmentsPHP.html ###
  
  protected function get_mime_type(&$structure) {
   $primary_mime_type = array("TEXT", "MULTIPART","MESSAGE", "APPLICATION", "AUDIO","IMAGE", "VIDEO", "OTHER");
   if($structure->subtype) {
   	return $primary_mime_type[(int) $structure->type] . '/' .$structure->subtype;
   }
   	return "TEXT/PLAIN";
  }
   
  protected function get_part($stream, $msg_number, $mime_type, $structure = false,$part_number    = false) {
   
   	if(!$structure) {
   		$structure = imap_fetchstructure($stream, $msg_number);
   	}
   	if($structure) {
   		if($mime_type == $this->get_mime_type($structure)) {
   			if(!$part_number) {
   				$part_number = "1";
   			}
   			$text = imap_fetchbody($stream, $msg_number, $part_number);
   			if($structure->encoding == 3) {
   				return imap_base64($text);
   			} else if($structure->encoding == 4) {
   				return imap_qprint($text);
   			} else {
   			return $text;
   		}
   	}
   
		if($structure->type == 1) /* multipart */ {
   		while(list($index, $sub_structure) = each($structure->parts)) {
   			
                        $prefix = null;
                        if($part_number) {
   				$prefix = $part_number . '.';
   			}
   			$data = $this->get_part($stream, $msg_number, $mime_type, $sub_structure,$prefix .    ($index + 1));
   			if($data) {
   				return $data;
   			}
   		} // END OF WHILE
   		} // END OF MULTIPART
   	} // END OF STRUTURE
   	return false;
   } // END OF FUNCTION
}