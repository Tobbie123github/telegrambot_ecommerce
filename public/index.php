<?php
require '../vendor/autoload.php';
require '../includes/db.php';

use GuzzleHttp\Client;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$botToken = $_ENV['TELEGRAM_BOT_TOKEN'];
$apiUrl = "https://api.telegram.org/bot$botToken/";

function sendMessage($chatId, $text)
{
    global $apiUrl;
    $client = new Client();
    $response = $client->post($apiUrl . 'sendMessage', [
        'json' => [
            'chat_id' => $chatId,
            'text' => $text
        ]
    ]);
}

function createOrder($userId, $productId)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, product_id, quantity) VALUES (?, ?, 1)");
    $stmt->execute([$userId, $productId]);
    return $pdo->lastInsertId();
}

$content = file_get_contents("php://input");
$update = json_decode($content, true);

if ($update && isset($update['message'])) {
    $message = $update['message'];
    $chatId = $message['chat']['id'];
    $text = $message['text'];

    switch ($text) {
        case '/start':
            sendMessage($chatId, "Welcome to Marshall Store! Use /products to see our products.");
            break;
        case '/products':
            $stmt = $pdo->query("SELECT * FROM products");
            $products = $stmt->fetchAll();

            
            if(empty($products)){
                sendMessage($chatId, "No products available at the moment..");
            }else{
           
            foreach ($products as $product) {
                $response .="Product Name: " . " " . $product['name'] . "\n";
                $response .= "Price: ".  " ". "#" . $product['price'] . "\n";
                $response .="Description: " . " ". $product['description'] . "\n";
                $response .="ImageURL: " . " ". $product['image'] . "\n";
                $response .= "/buy_" . $product['id'] . " - Buy\n\n";
            }
            sendMessage($chatId, $response);
        }
            break;
        default:
            if (preg_match('/^\/buy_(\d+)/', $text, $matches)) {
                $productId = $matches[1];
                $orderId = createOrder($chatId, $productId);
                sendMessage($chatId, "Order created with ID: $orderId. Proceed to payment.");
                // Add payment link here
            } else {
                sendMessage($chatId, "I didn't understand that command. Click /start to continue.");
            }
            break;
    }
}

