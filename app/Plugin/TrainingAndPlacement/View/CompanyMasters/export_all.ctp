<?php
$date = date("d/m/Y");
$filename = "Company Master ".$date.".xls";
$contents = "Sr.No.\t Company\t website\t Category\t Email\t Contact\t For Training\t For Job\t \n";
echo $contents;
$i = 0;
foreach ($companyMasters as $CompanyMaster)
{
  if($CompanyMaster['CompanyMaster']['training'] == 1){
    $a = "Yes";
  }
  else{
    $a = "No";
  }
  if($CompanyMaster['CompanyMaster']['job'] == 1){
    $b = "Yes";
  }
  else{
    $b = "No";
  }
  $contents = ++$i."\t".$CompanyMaster['CompanyMaster']['name']."\t".$CompanyMaster['CompanyMaster']['website']."\t".$CompanyMaster['CompanyMaster']['category']."\t".$CompanyMaster['CompanyMaster']['email']."\t".$CompanyMaster['CompanyMaster']['contactno']."\t".$a."\t".$b."\t \n";
  echo $contents;
}
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
header("Pragma: no-cache"); 
header("Expires: 0");
//echo $contents;
 ?>