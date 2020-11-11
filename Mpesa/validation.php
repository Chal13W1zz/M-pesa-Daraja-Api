<?php
    header("Content-Type: application/json");
    
    if (!isset($_GET["token"]))
    {
        echo "Technical error";
        exit();
    }

    if ($_GET["token"]!='c9b10b9a7b1f4ff9824743cc741eaea29c4e5e8880502bab86f5e87b1b1d6e7c$')
    {
        echo "Invalid authorization";
        exit();
    }

    $response = '{ "ResultCode": 0, "ResultDesc": "Confirmation Received Successfully" }';

    // Save the M-PESA input stream. 
    $mpesaResponse = file_get_contents('php://input');

    /* If we have any validation, we will do it here then change the $response if we reject the transaction */
    // Your Validation
    // $response = '{  "ResultCode": 1, "ResultDesc": "Transaction Rejected."  }';
    /* Ofcourse we will be checking for amount, account number(incase of paybill), invoice number and inventory.
    But we reserve this for future tutorials*/

    // log the response
    $logFile = "validationResponse.txt";

    // will be used when we want to save the response to database for our reference
    $jsonMpesaResponse = json_decode($mpesaResponse, true); 

    // write the M-PESA Response to file
    $log = fopen($logFile, "a");
    fwrite($log, $mpesaResponse);
    fclose($log);

    echo $response;

?>