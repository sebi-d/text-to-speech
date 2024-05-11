<?php

$endpoint = 'https://westeurope.api.cognitive.microsoft.com/';
$key = '87272c46530b46ca945291d4bcd65bc9';
$region = 'westeurope';

try {
    $text = $_POST['text'];

    $url = "https://westeurope.tts.speech.microsoft.com/cognitiveservices/v1";

    $headers = array(
        "Ocp-Apim-Subscription-Key: $key",
        "Content-Type: application/ssml+xml",
        "X-Microsoft-OutputFormat: riff-24khz-16bit-mono-pcm",
        "User-Agent: curl",
    );

    $requestBody = "<speak version='1.0' xmlns='http://www.w3.org/2001/10/synthesis' xml:lang='en-US'><voice xml:lang='en-US' xml:gender='Female' name='en-US-AvaMultilingualNeural'>$text</voice></speak>";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);

    if(curl_errno($ch)){
        echo 'Curl error: ' . curl_error($ch);
    }

    curl_close($ch);

    header('Content-Type: audio/x-wav');
    echo $response;

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>