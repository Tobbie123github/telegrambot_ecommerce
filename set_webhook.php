<?php
$botToken = "";
$webUrl = ""; // Ensure no spaces, yout weburl for the webhook

$url = "https://api.telegram.org/bot$botToken/setWebhook?url=$webUrl/bot_ecommerce/public/index.php";

$response = file_get_contents($url);

if ($response === FALSE) {
    if (isset($http_response_header)) {
        error_log('Error setting webhook: ' . $http_response_header[0]);
    } else {
        error_log('Error setting webhook: Unable to connect to Telegram API.');
    }
} else {
    $result = json_decode($response, true);
    if ($result['ok']) {
        echo 'Webhook set successfully';
    } else {
        echo 'Failed to set webhook: ' . $result['description'];
    }
}
?>
