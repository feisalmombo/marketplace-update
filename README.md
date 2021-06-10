[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]


<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://github.com/feisalmombo/marketplace-update">
    <img src="images/logo.png" alt="MarketPlace Logo">
  </a>

  <h3 align="center">MarketPlace</h3>

  <p align="center">
    MarketPlace is a smarter way to find financial products.Compare loans from multiple providers in one simple search.
    <br />
    <a href="https://github.com/feisalmombo/marketplace-update"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://compare.getpesa.co.tz">View Demo</a>
    ·
    <a href="https://github.com/feisalmombo/marketplace-update/issues">Report Bug</a>
    ·
    <a href="https://github.com/feisalmombo/marketplace-update/issues">Request Feature</a>
  </p>
</p>



<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#objectives">Project Objectives</a></li>
      </ul>
      <ul>
        <li><a href="#stories">User Stories</a></li>  
      </ul>
      <ul>
        <li><a href="#personas">User Personas</a></li>
      </ul>
       <ul>
        <li><a href="#summary">Summary Functions</a></li>
      </ul>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#database">Relation Database</a></li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#environment">Environment variables</a></li>
    <li><a href="#testing">Testing API</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgements">Acknowledgements</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

[![Product Name Screen Shot][product-screenshot]](https://compare.getpesa.co.tz/)

## Project Objectives
The purpose of this project is to develop a financial marketplace that will allow users to compare and apply for loans from formal financial institutions such as banks and Microfinance Institutions (MFIs).

This project will solve three main problems:
* The lack of access to financial information particularly loan products in the market.
* The lack of transparency in pricing leads to hidden costs and overpricing of credit products.
* Lack of fair pricing by formal financial institutions.

The main benefits to users will be:
* Open and transparent access for all (internet) users to financial information (application to disbursal).
* Educate users on pricing of credit and managing expectations of borrowers.
* Eventually level the playing rough by driving prices down through fair competition.

The vision of the marketplace is to level the playing ground through open source information leading to fairly priced products which eventually augur well for the borrowers.

## User Stories
As a User:
1. I need to be able to compare the prices of different loan products.
2. I need to be able to apply for loans I am interested in.
3. I need to be able to track and get notified on the status of my loan.

As an Admin
1. I need to be able to easily upload loan product information.
2. I need to be able to view loan comparison searches for different users.
3. I need to be able to review loan applications - approve or reject (give reason).
4. I need to be able to see a summary of the number of applications, type of loans being applied for,the value and volume of the loan applications, top ranking metrics.
5. I need to be able to easily download user information in PDF or CSV formats.

## User Personas
1. Existing Borrower - Bank or MFI
2. New Borrower - Bank or MFI

## Summary Functions
1. Create Loan Products
2. Compare Loans
3. Apply for Loans

## Built With

This section should list any major frameworks that you built your project using. Leave any add-ons/plugins for the acknowledgements section. Here are a few examples.

### Front End Development
* [HTML 5]
* [CSS]
* [Javascript]
* [Jquery]
* [Vue JS]

### Style
* [Bootstrap](https://getbootstrap.com)
* [Customized  template]
* [Laravel Snippets]
* [Just In Mind for design system architecture]
* [Just color picker]

### Back End (Technology)
* [Laravel PHP Framework](https://laravel.com)

### Database
* [MySQL]
* [MySQL Workbench for designing Databases]
* [Phpmyadmin]

### SMS Package
* [African’s Talking for sending OTP (One Time Password) SMS and other SMS notifications via message]

### Editor
* [Microsoft Visual Studio code]

### Deployment (DEV OPS)
* [AWS (Amazon Web Services)]
* [PUTTY Configuration]
* [FileZilla]

### Packages versions
* [Dompdf - For reading pdf documents 0.8.4]
* [Maatwebsite/excel 3.1]
* [PHP 7.1.3]
* [Laravel framework 5.7.*]
* [Consoletvs/charts 5.*]
* [africanstalking/africanstalking 2.4]

### Collaboration Tools.
* [Trello]
* [Bitbucket]
* [Github]

### API TESTING
* [Postman]
* [Insomnia]

<!-- GETTING STARTED -->
## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

### Prerequisites

1. Install XAMPP web server
2. Any Editor (Preferably VS Code or Sublime Text)
3. Any web browser with latest version

### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/feisalmombo/marketplace-update.git
   ```
2. Switch to the repo folder
    ```sh
    cd marketplace-update
    ```

3. Install all the dependencies using composer 
   ```sh
   composer install
   ```
4. Install NPM packages
   ```sh
   npm install
   ```
5. Copy the example env file and make the required configuration changes in the .env file
    ```sh
    cp .env.example .env
    ```
6. Generate a new application key
    ```sh
    php artisan key:generate
    ```
7. Before migrate you must comment the PermissionsServiceProvider.php file first

8. Then you can migrate to run the database migrations and seeders (Set the database connection in .env before migrating)
    ```sh
    php artisan migrate:refresh --seed
    ```
9. Uncomment the PermissionsServiceProvider.php file and save and continue

10. This SDK provides convenient access to the Africa's Talking via composer
    ```sh
    composer require africastalking/africastalking
    ```
11. Start the local development server
    ```sh
    php artisan serve
    ```
You can now access the server at http://localhost:8000

## Commands used for Laravel Artisan Cache Commands
1. Clearing Configuration Cache
    ```sh
    php artisan config:cache
    ```

    ```sh
    php artisan config:clear
    ```
2. Route Caching:
    ```sh
    php artisan route:clear
    ```

    ```sh
    php artisan route:cache
    ```
3. Views Caching:
    ```sh
    php artisan view:clear
    ```

    ```sh
    php artisan view:cache
    ```
4. Clearing Composer Cache:
    ```sh
    composer dump-autoload
    ```

### Relation Database
This is a sample of database used in our system when you follow the following commands above you migrate the database and seeder and you can get the relation database like this.

[![Relation Database Schema][relation-database]](https://github.com/feisalmombo/marketplace-update)

<!-- USAGE EXAMPLES -->
## Usage

You can use this SDK for either production or sandbox apps. For sandbox, the app username is ALWAYS found in the dashboard via [dashboard](https://account.africastalking.com/auth/login?next=%2F)

```php
use AfricasTalking\SDK\AfricasTalking;

$username = 'YOUR_USERNAME'; // use 'sandbox' for development in the test environment
$apiKey   = 'YOUR_API_KEY'; // use your sandbox app API key for development in the test environment
$AT       = new AfricasTalking($username, $apiKey);

// Get one of the services
$sms      = $AT->sms();

// Use the service
$result   = $sms->send([
    'to'      => '+2XXYYYOOO',
    'message' => 'Hello World!'
]);

print_r($result);
```

_For more details, please refer to the [MarketPlace](https://compare.getpesa.co.tz)_



<!-- ROADMAP -->
## Roadmap

See the [open issues](https://github.com/feisalmombo/marketplace-update/issues) for a list of proposed features (and known issues).



<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b develop`)
3. Commit your Changes (`git commit -m 'Add some feature'`)
4. Push to the Branch (`git push origin develop`)
5. Open a Pull Request

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/api

Request headers

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|
| Yes      	| X-Requested-With 	| XMLHttpRequest   	|
| Optional 	| Authorization    	| Token {JWT}      	|

<!-- CONTACT -->
## Contact

Your Name - [@FeisalMombo](https://twitter.com/FeisalMombo) - feisalmombo29@gmail.com

Project Link: [https://github.com/feisalmombo/marketplace-update](https://github.com/feisalmombo/marketplace-update)



<!-- ACKNOWLEDGEMENTS -->
## Acknowledgements
* [GitHub Emoji Cheat Sheet](https://www.webpagefx.com/tools/emoji-cheat-sheet)
* [Img Shields](https://shields.io)
* [Choose an Open Source License](https://choosealicense.com)
* [GitHub Pages](https://pages.github.com)
* [Animate.css](https://daneden.github.io/animate.css)
* [Loaders.css](https://connoratherton.com/loaders)
* [Slick Carousel](https://kenwheeler.github.io/slick)
* [Smooth Scroll](https://github.com/cferdinandi/smooth-scroll)
* [Sticky Kit](http://leafo.net/sticky-kit)
* [JVectorMap](http://jvectormap.com)
* [Font Awesome](https://fontawesome.com)




<!-- MARKDOWN LINKS & IMAGES -->
[contributors-shield]: https://img.shields.io/github/contributors/feisalmombo/marketplace-update.svg?style=for-the-badge
[contributors-url]: https://github.com/feisalmombo/marketplace-update/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/feisalmombo/marketplace-update.svg?style=for-the-badge
[forks-url]: https://github.com/feisalmombo/marketplace-update/network/members
[stars-shield]: https://img.shields.io/github/stars/feisalmombo/marketplace-update.svg?style=for-the-badge
[stars-url]: https://github.com/feisalmombo/marketplace-update/stargazers
[issues-shield]: https://img.shields.io/github/issues/feisalmombo/marketplace-update.svg?style=for-the-badge
[issues-url]: https://github.com/feisalmombo/marketplace-update/issues
[license-shield]: https://img.shields.io/github/license/feisalmombo/marketplace-update.svg?style=for-the-badge
[license-url]: https://github.com/feisalmombo/marketplace-update/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://www.linkedin.com/in/feisal-mombo-332322135/
[product-screenshot]: images/screenshot.PNG
[relation-database]: images/database_relation.PNG
