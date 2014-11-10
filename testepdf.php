<?php

ini_set('display_erros', 1);

include($_SERVER['DOCUMENT_ROOT']."/sistema/vendor/phpToPdf/phpToPdf.php");

$my_html_header="
<div style='display:block;'>
  <div style='float:left; width:33%; text-align:left;'>
         Left Header Text
  </div>
  <div style='float:left; width:33%; text-align:center;'>
         Center Header Text
  </div>
  <div style='float:left; width:33%; text-align:right;'>
       Right Header Text
   </div>
   <br style='clear:left;'/>
</div>";

 $my_html="<HTML><h2>PDF from HTML using phpToPDF</h2></HTML>";

//Set Your Options -- see documentation for all options
    $pdf_options = array(
          "source_type" => 'html',
          "source" => $my_html,
          "header" => $my_html_header,
          "action" => 'view');

    //Code to generate PDF file from options above
    phptopdf($pdf_options);