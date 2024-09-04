# Telegram Bot E-Commerce - README

## Introduction

This project is a Telegram Bot-based e-commerce platform developed using PHP. The bot allows administrators to add products to the system and enables users to browse and order products directly through Telegram once they are added to a designated Telegram group.

## Features

- **Admin Functionality:**
  - Add new products with details such as name, description, price, and image.
  - View and manage the list of products.
  - Monitor user orders and manage order statuses.

- **User Functionality:**
  - Browse available products directly in the Telegram group.
  - Place orders through the Telegram bot interface.
  - Receive order confirmation and status updates.

## Installation

### Prerequisites

- PHP 7.3 or higher
- MySQL or any other supported database
- Composer (for managing dependencies)
- Telegram account and bot created via BotFather

### Setup

1. **Clone the repository:*

2. **Install dependencies:**
   Run the following command to install the required PHP libraries:
  composer require guzzlehttp/guzzle
  composer require vlucas/phpdotenv


3. **Configure the database:**
   - Create a new MySQL database.
   - Import the provided SQL file (`database.sql`) to set up the necessary tables.
  

4. **Set up Telegram Bot:**
   - Obtain your bot token from [BotFather](https://core.telegram.org/bots#botfather).
   - Update the bot token in the `.env` file.

5. **Deploy the Bot:**
   - Set up a webhook for the bot using the following command (replace `<your-webhook-url>` with your actual webhook URL):
     ```bash
     https://api.telegram.org/bot<your-bot-token>/setWebhook?url=<your-webhook-url>
     ```
   - Ensure your server is accessible via HTTPS as Telegram requires secure connections.

6. **Configure the Admin Group:**
   - Add the bot to your desired Telegram group.
  

## Contributing

Feel free to fork this project and contribute by submitting pull requests. For major changes, please open an issue first to discuss what you would like to change.

## Contact

For any inquiries or support, please contact [tobbie2611@gmail.com](mailto:tobbie2611@gmail.com).

---

Thank you for using the Telegram Bot E-Commerce platform! We hope this makes your online shopping experience smooth and enjoyable.
