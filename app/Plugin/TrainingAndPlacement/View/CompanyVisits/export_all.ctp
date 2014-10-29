<?php
$date = date("d/m/Y");
$filename = "Company Visits ".$date.".xls";
$contents = "Sr.No.\t Company\t preplacementtalk\t visitdate\t placementtype\t placementvenue\t \n";
echo $contents;
$i = 0;
foreach ($companyVisits as $CompanyVisit)
{
  $contents = ++$i."\t".$CompanyVisit['CompanyVisit']['company_master_id']."\t".$CompanyVisit['CompanyVisit']['pptdate']."\t".$CompanyVisit['CompanyVisit']['visitdate1']."\t".$CompanyVisit['CompanyVisit']['placementtype']."\t".$CompanyVisit['CompanyVisit']['placementvenue']."\t \n";
  echo $contents;
}
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
header("Pragma: no-cache"); 
header("Expires: 0");
//echo $contents;
 ?>