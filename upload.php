<?php
// The user credentials I will use to login to the WebDav host
$credentials = array(
	'username',
	'password'
);
// Prepare the file we are going to upload

$filename = 'test.txt';
$filepath = "./".$filename;
$filesize = filesize($filepath);
$fh = fopen($filepath, 'r');
// The URL where we will upload to, this should be the exact path where the file
// is going to be placed

$remoteUrl = 'https://xxxxx.stackstorage.com/remote.php/webdav/';
// Initialize cURL and set the options required for the upload. We use the remote
// path we specified together with the filename. This will be the result of the
// upload.

$ch = curl_init($remoteUrl . $filename);

// I'm setting each option individually so it's easier to debug them when
// something goes wrong. When your configuration is done and working well
// you can choose to use curl_setopt_array() instead.
// Set the authentication mode and login credentials
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);

curl_setopt($ch, CURLOPT_USERPWD, implode(':', $credentials));

// Define that we are going to upload a file, by setting CURLOPT_PUT we are
// forced to set CURLOPT_INFILE and CURLOPT_INFILESIZE as well.
curl_setopt($ch, CURLOPT_PUT, true);

curl_setopt($ch, CURLOPT_INFILE, $fh);

curl_setopt($ch, CURLOPT_INFILESIZE, $filesize);

// DEBUG VARIABLES

// print_r($credentials);
// echo $filename;
// echo $filepath;
// echo $filesize;
// echo $fh;
// echo $remoteUrl;
// echo $ch;

// Execute the request, upload the file
curl_exec($ch);

// End
fclose($fh);

echo "UPLOAD DONE :) !";
?>
