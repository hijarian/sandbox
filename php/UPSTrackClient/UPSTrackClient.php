<?php

      //Configuration
      $access = "0CA4DC16A164E088";
      $userid = "kuty";
      $passwd = "softdrink_9";

      $accessSchemaFile = dirname(__FILE__)."/AccessRequest.xsd";
      $requestSchemaFile = dirname(__FILE__)."/TrackRequest.xsd";
      $responseSchemaFile = dirname(__FILE__)."/TrackResponse.xsd";

      $endpointurl = 'https://wwwcie.ups.com/ups.app/xml/Track';
      $outputFileName = "XOLTResult.xml";


      try
      {
		$security = <<<ENDL
<?xml version="1.0" ?>
<AccessRequest xml:lang='en-US'>
  <AccessLicenseNumber>$access</AccessLicenseNumber>
  <UserId>$userid</UserId>
  <Password>$passwd</Password>
</AccessRequest>
ENDL;

		$request = <<<ENDL
<?xml version="1.0" ?>
<TrackRequest>
  <Request>
    <TransactionReference>
      <CustomerContext>guidlikesubstance</CustomerContext>
    </TransactionReference>
    <RequestAction>Track</RequestAction>
    <RequestOption>activity</RequestOption>
  </Request>
  <TrackingNumber>I should not even exist: 仚</TrackingNumber>
</TrackRequest>
ENDL;

         //create Post request
         $form = array
         (
             'http' => array
             (
                 'method' => 'POST',
                 'header' => 'Content-type: application/x-www-form-urlencoded',
                 'content' => "$security$request"
             )
         );

         //print form request
         print_r($form);


         $request = stream_context_create($form);
         $browser = fopen($endpointurl , 'rb' , false , $request);
         if(!$browser)
         {
             throw new Exception("Connection failed.");
         }

         //get response
         $response = stream_get_contents($browser);
         fclose($browser);

         if($response == false)
         {
            throw new Exception("Bad data.");
         }
         else
         {
            //save request and response to file
  	    $fw = fopen($outputFileName,'w');
            fwrite($fw , "Response: \n" . $response . "\n");
            fclose($fw);

            //get response status
            $resp = new SimpleXMLElement($response);
            echo $resp->Response->ResponseStatusDescription . "\n";
         }
      }
      catch(Exception $ex)
      {
      	 echo $ex;
      }

?>

