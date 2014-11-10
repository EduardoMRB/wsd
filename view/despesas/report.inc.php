<?php
require($_SERVER['DOCUMENT_ROOT']."/sistema/vendor/MPDF/mpdf.php");

$html = "";

foreach($despesas as $value){
  $html .= "<p class='font12arial'>O valor do condominí­o referente ao mês de ". $value->mes . " de ". $value->ano;
  $html .= "com vencimento em ". $value->vencimento ."</p>";
  $html .= "<p class='font12arial'>Valor: " . $value->valor . "</p>";
  $html .= "";


}  

echo $html;