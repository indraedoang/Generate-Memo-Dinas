<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once APPPATH."/third_party/PHPExcel/PHPExcel.php";

class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
        $this->excel = new PHPExcel();    
    }
    // Kresna testing for experiment
    public function load($path="") {
    	$objReader = PHPExcel_IOFactory::createReader('Excel5');
        $this->excel = $objReader->load($path);
    }

    public function save($path) {
        // Write out as the new file
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save($path);
    }

    public function stream($filename,$stream) { 
    	if (ob_get_length() > 0) ob_end_clean();      
        header('Content-type: Content-Type: application/vnd.openXMLformats-officedocument.spreadsheetml.sheet');
	    header("Content-Disposition: attachment; filename=\"".$filename."\"");
		header('Cache-Control: max-age=0');
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($stream, 'Excel2007');
		$objWriter->save('php://output');    
    }

    public function  __call($name, $arguments) {  
        // make sure our child object has this method  
        if(method_exists($this->excel, $name)) {  
            // forward the call to our child object  
            var_dump($name);var_dump($arguments);
            //return call_user_func_array(array($this->excel, $name), $arguments);  
        }  
        return null;  
    }  
}
?>
