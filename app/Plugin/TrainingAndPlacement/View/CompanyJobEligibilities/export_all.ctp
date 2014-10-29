<?php
$date = date("d/m/Y");
$filename = "Company Job Eligibility ".$date.".xls";
$contents = "Sr.No.\t Company_id\t Company_job_id\t min_eligibility_SSC\t min_eligibility_HSC\t min_eligibility_Degree\t Interested\t Hiring\t Verbal\t Aptitude\t Interview\t GD\t HR\t \n";
echo $contents;
$i=0;
foreach ($companyJobEligibilities as $CompanyJobEligibility)
{
  if($CompanyJobEligibility['CompanyJobEligibility']['verbal'] == 1){
    $a = "Yes";
  }
  else{
    $a = "No";
  }
  if($CompanyJobEligibility['CompanyJobEligibility']['aptitude'] == 1){
    $b = "Yes";
  }
  else{
    $b = "No";
  }
   if($CompanyJobEligibility['CompanyJobEligibility']['interview'] == 1){
    $c = "Yes";
  }
  else{
    $c = "No";
  }
   if($CompanyJobEligibility['CompanyJobEligibility']['gd'] == 1){
    $d = "Yes";
  }
  else{
    $d = "No";
  }
   if($CompanyJobEligibility['CompanyJobEligibility']['hr'] == 1){
    $e = "Yes";
  }
  else{
    $e = "No";
  }
  $contents = ++$i."\t".$CompanyJobEligibility['CompanyJobEligibility']['company_master_id']."\t".$CompanyJobEligibility['CompanyJobEligibility']['company_job_id']."\t".$CompanyJobEligibility['CompanyJobEligibility']['min_eligible_10']."\t".$CompanyJobEligibility['CompanyJobEligibility']['min_eligible_12']."\t".$CompanyJobEligibility['CompanyJobEligibility']['min_eligible_degree']."\t".$CompanyJobEligibility['CompanyJobEligibility']['interestedin']."\t".$CompanyJobEligibility['CompanyJobEligibility']['hiring']."\t".$a."\t".$b."\t".$c."\t".$d."\t".$e."\t \n";
  echo $contents;
}
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
header("Pragma: no-cache"); 
header("Expires: 0");
//echo $contents;
 ?>