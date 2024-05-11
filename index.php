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
        "X-Microsoft-OutputFormat: audio-24khz-160kbitrate-mono-mp3",
        "User-Agent: curl",
    );

    $requestBody = "<speak version='1.0' xmlns='http://www.w3.org/2001/10/synthesis' xml:lang='en-US'><voice name='en-US-AriaNeural'>$text</voice></speak>";

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if(curl_errno($ch)){
        echo 'Curl error: ' . curl_error($ch);
    }

    curl_close($ch);

    // Output the audio data directly
    header('Content-Type: audio/mpeg');
    echo $response;

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>