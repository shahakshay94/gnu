<?php
$date = date("d/m/Y");
$filename = "Company Jobs ".$date.".xls";
$contents = "Sr.No.\t Company_id\t Designation\t probationperiod\t Salary\t \n";
echo $contents;
$i = 0;
foreach ($companyJobs as $CompanyJob)
{
  $contents = ++$i."\t".$CompanyJob['CompanyJob']['company_master_id']."\t".$CompanyJob['CompanyJob']['name']."\t".$CompanyJob['CompanyJob']['probationperiod']."\t".$CompanyJob['CompanyJob']['salary']."\t \n";
  echo $contents;
}
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
header("Pragma: no-cache"); 
header("Expires: 0");
//echo $contents;
 ?>