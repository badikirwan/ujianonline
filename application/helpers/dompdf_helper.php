<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function generate($html,$filename)
  {
    require_once("dompdf/dompdf_config.inc.php");
 
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream($filename.'.pdf',array("Attachment"=>0));
  }