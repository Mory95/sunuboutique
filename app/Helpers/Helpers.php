<?php
use Carbon\Carbon;

function dateCommande($date)
{
  return Carbon::parse($date)->format('M d, Y');
}


function messageflash($message, $type){

  if ($type=='success') {
        //echo "success";

    $notification = array(
      'message' => $message,
      'alert-type' => 'success'
    );

  } else if ($type=='info') {
    echo "info";

    $notification = array(
      'message' => $message,
      'alert-type' => 'info'
    );


  }
  else if ($type=='warning') {
    echo "warning";
    $notification = array(
      'message' => $message,
      'alert-type' => 'warning'
    );

  }else {
    echo "error";
    $notification = array(
      'message' => $message,
      'alert-type' => 'error'
    );

  }

  return back()->with($notification);

}


function verifTel($tel){
  $tel1 = substr($tel,0,2);
  if($tel1==77){
        //dd('77');
    return true;
  }
  if($tel1==78){
        //dd('78');
    return true;
  }
  if($tel1==76){
        //dd('76');
    return true;
  }
  if($tel1==70){
        //dd('77');
    return true;
  }

  return false;
}

?>
