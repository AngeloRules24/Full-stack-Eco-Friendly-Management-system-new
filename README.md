# 🌿 EcoNest

EcoNest is a community-driven sustainability web platform built with PHP and MySQL. It brings together eco-conscious users under one platform — enabling them to share gardening knowledge, exchange homegrown produce, swap eco-friendly products, explore recycling programmes, and learn about energy conservation.

---

## 📋 Table of Contents

- [Project Description](#project-description)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Database Structure](#database-structure)
- [Installation & Setup](#installation--setup)
- [Usage Guide](#usage-guide)
- [Project Structure](#project-structure)
- [Contributors](#contributors)

---

## 📖 Project Description

EcoNest is a full-stack web application designed to foster sustainable living through community engagement. Users can register, log in, and access a range of green-living features — from sharing gardening tips and joining community garden projects, to swapping eco-friendly products and browsing local recycling drop-off programmes. The platform also includes an energy conservation education module covering different forms of renewable and non-renewable energy.

---

## ✨ Features

### 🔐 Authentication

- User registration and login system
- Session-based authentication
- Profile management and updates

### 🌱 Community Gardening

- Share and browse gardening tips with comments and likes
- Create and join community gardening projects
- Exchange homegrown produce with other users (with offer/accept/reject flow)

### ♻️ Recycling Programme

- Browse local recycling drop-off locations
- View accepted recyclable materials (e-waste, plastic, glass, paper, clothing, aluminium)
- Nearby mall and centre information

### 🔄 Eco-Friendly Product Swap

- List products available for swapping
- Browse and make swap offers to other users
- Manage incoming and outgoing swap offers

### ⚡ Energy Conservation

- Educational module covering 9 energy types:
  Solar, Wind, Water, Heat, Electrical, Sound, Light, Mechanical, Chemical
- Visual guides and descriptions for each energy type

### 🔔 Notifications

- In-platform notification system for offer updates and activity alerts

### 👤 User Profile

- View and update personal profile information

### ❓ Help Page

- In-platform help and support page

---

## 🛠 Tech Stack

| Layer        | Technology                            |
| ------------ | ------------------------------------- |
| Frontend     | HTML5, CSS3, JavaScript               |
| Backend      | PHP 8.2                               |
| Database     | MySQL / MariaDB 10.4 (via phpMyAdmin) |
| Server       | Apache (XAMPP / WAMP recommended)     |
| DB Interface | MySQLi (PHP extension)                |

---

## 🗄 Database Structure

**Database name:** `econestdb`

| Table                  | Description                                             |
| ---------------------- | ------------------------------------------------------- |
| `user`                 | Stores registered user accounts and profile information |
| `gardeningtips`        | Community-submitted gardening tips and posts            |
| `post_comments`        | Comments on gardening tip posts                         |
| `post_likes`           | Likes on gardening tip posts                            |
| `gardeningprojects`    | Community gardening project listings                    |
| `project_participants` | Users who have joined gardening projects                |
| `produceexchange`      | Homegrown produce listed for exchange                   |
| `exchange_details`     | Offer details for produce exchanges                     |
| `productswap`          | Products listed for eco-friendly swapping               |
| `myswap`               | User's own swap listings                                |
| `swap_offers`          | Offers made on product swaps                            |
| `notifications`        | In-platform notifications for user activity             |

---

## ⚙️ Installation & Setup

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) or [WAMP](https://www.wampserver.com/) installed
- PHP 8.2 or higher
- MySQL / MariaDB

### Steps

**1. Clone or download the repository**

```
git clone https://github.com/yourusername/econest.git
```

Or download and extract the ZIP into your server's root directory.

**2. Place files in the correct directory**

For XAMPP, place the project folder inside:

```
C:/xampp/htdocs/
```

Ensure the folder structure looks like:

```
htdocs/
└── econest/
    ├── index.php
    ├── conn.php
    ├── header.php
    ├── footer.php
    ├── communitygardening/
    ├── recyclingprogram/
    ├── ecofriendlyproductswap/
    ├── energyconservation/
    └── signinsignup/
```

**3. Import the database**

- Start Apache and MySQL in XAMPP Control Panel
- Open your browser and go to `http://localhost/phpmyadmin`
- Create a new database named `econestdb`
- Click **Import** and select the `econestdb.sql` file
- Click **Go**

**4. Configure the database connection**

Open `conn.php` and verify the credentials match your setup:

```php
$localhost = 'localhost';
$user = 'root';
$pass = '';           // Add your MySQL password if set
$dbName = 'econestdb';
```

**5. Launch the application**

Open your browser and navigate to:

```
http://localhost/econest/index.php
```

---

## 📘 Usage Guide

### Registering an Account

1. Navigate to the **Sign Up** page via `signinsignup/register.php`
2. Fill in your details and submit
3. You will be redirected to a successful registration confirmation page

### Logging In

1. Navigate to `signinsignup/login.php`
2. Enter your credentials to access the platform

### Community Gardening

- Browse tips at `communitygardening/sharegardeningtip/sharegardeningtip.php`
- Post a new tip, comment on others, or like posts
- View and join projects at `communitygardening/gardeningproject/gardeningproject.php`
- List your homegrown produce for exchange at `communitygardening/exchangehomegrownproduce/`

### Product Swap

- Browse available swaps at `ecofriendlyproductswap/product-swap.php`
- Make an offer via `ecofriendlyproductswap/offer.php`
- Manage your offers at `ecofriendlyproductswap/manage_offers.php`

### Recycling Programme

- Browse recycling locations and categories at `recyclingprogram/recyclingprogram.php`

### Energy Conservation

- Access the energy education hub at `energyconservation/energyconservation.php`
- Click on any energy type to read more about it

---

## 📁 Project Structure

```
econest/
├── index.php                        # Homepage
├── conn.php                         # Database connection
├── header.php                       # Shared header
├── footer.php                       # Shared footer
├── basepath.php                     # Base path configuration
├── logout.php                       # Logout handler
├── notifications.php                # Notifications page
├── aboutus.php                      # About Us page
├── UpdateProfile.php                # Profile update page
├── 11. Help Page.php                # Help page
├── 12. My Profile.php               # My profile page
│
├── signinsignup/
│   ├── login.php
│   ├── register.php
│   ├── insertnewuser.php
│   ├── userexistence.php
│   └── successfulregistration.php
│
├── communitygardening/
│   ├── communitygardening.php
│   ├── sharegardeningtip/
│   ├── gardeningproject/
│   └── exchangehomegrownproduce/
│
├── recyclingprogram/
│   └── recyclingprogram.php
│
├── ecofriendlyproductswap/
│   ├── product-swap.php
│   ├── offer.php
│   ├── manage_offers.php
│   └── swap.php
│
└── energyconservation/
    ├── energyconservation.php
    ├── 2. Solar Energy.php
    ├── 3. Wind Energy.php
    └── ... (9 energy types total)
```

---

## 👥 Contributors

| Name | Role |
|Mahalia Jaya Shanker |Team Leader|
|Angel Phumelela Mngomezulu|Team Member|
|Chu Jie Na |Team Member|
|Hannah Kow Hui Cheng |Team Member|

> Built as part of a diploma software engineering group assignment. EcoNest aims to make sustainable living more accessible and community-driven. 🌍
