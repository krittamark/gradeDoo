<?php

require 'data.class.php';
require 'config/config.php';

class Grade extends Data {
    // Configure variables
    private $idLength = 5;
    private $passLength = 10;
    
    // Do not change these variables
    private $error; // Error return variable
    private $id;    // Student number
    private $pass;  // Password
    private $term;  // Term 


    public function __construct($id, $pass) {
            
        // Check that the data entered is correct length
        if (strlen($id) === $this->idLength && strlen($pass) === $this->passLength) {
            $this->id = $id;
            $this->pass = $pass;
        } 

    }


    public function getGrade(string $term) {
        
        if (!empty($this->id) && !empty($this->pass)) {
            
            // Get key data
            Data::__construct($term);
            // Make post data
            $data = [
                "__LASTFOCUS" => 							"",
                "__VIEWSTATE" => 							Data::getViewState(),
                "__EVENTTARGET" => 							"",
                "__EVENTARGUMENT" => 						"",
                "__EVENTVALIDATION" =>                      Data::getEventValidation(),
                'ctl00$ContentPlaceHolder1$TextBox1' => 	$this->id,
                'ctl00$ContentPlaceHolder1$TextBox2' => 	$this->pass,
                'ctl00$ContentPlaceHolder1$Button1' => 		"แสดงผล"
            ];

            // Get link from config then replace data
            $link = str_replace('__DATA__', $term, LINK);

            // Start curl connection
            $connection = curl_init($link);
            // Set get return data
            curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
            // Send post method to connection
            curl_setopt($connection, CURLOPT_POSTFIELDS, $data);
            // Execute curl connection
            $response = curl_exec($connection);
            // Close curl connection
            curl_close($connection);
            
            if (!empty($response)) {
                $response = str_replace('__NAME__' , Data::getName(), TEXT_TITLE) . $response;
            } else {
                $response = str_replace('__NAME__' , ERROR_MESSAGE, TEXT_TITLE);
            }

            return $response;
        }
    }
}