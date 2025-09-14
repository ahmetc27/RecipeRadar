# RecipeRadar - Social Media Platform for Food Enthusiasts

## Overview

RecipeRadar is a social media website designed for food lovers to share recipes, connect with friends, and discover new culinary ideas. Users can create posts, interact with others, and manage their profiles in a user-friendly environment.

## Features

- **User Registration & Authentication**: Secure sign-up and login system
- **Profile Management**: Edit personal information and manage account settings
- **Recipe Sharing**: Create and share detailed recipe posts with photos
- **Social Interactions**: Like, comment on, and share posts
- **Friends System**: Send follow requests and manage friendships
- **Admin Panel**: Special privileges for administrators to manage users and content

## Prerequisites

Before installation, ensure you have:
- Any operating system (Windows, macOS, or Linux)
- XAMPP (includes Apache, MySQL, PHP, and phpMyAdmin)
- Git (for cloning the repository)

## Installation

### 1. Install XAMPP
Download and install XAMPP from the [official website](https://www.apachefriends.org/). Start Apache and MySQL modules from the XAMPP Control Panel.

### 2. Clone the Repository
```bash
cd /path/to/xampp/htdocs
git clone https://github.com/ahmetc27/RecipeRadar.git
cd RecipeRadar
```

### 3. Database Setup
1. Open phpMyAdmin at http://localhost/phpmyadmin
2. Create a new database named `reciperadar_db`
3. Import the SQL file from the `database` folder in the project directory

### 4. Access the Application
Open your web browser and navigate to: http://localhost/RecipeRadar

## Default Login Credentials

**Administrator Account:**
- Username: admin
- Password: admin

**Standard User Account:**
- Username: [user-name]
- Password: [user-password]

## Usage

### Creating an Account
1. Click "Register" on the homepage
2. Fill out the registration form
3. Click "Register" to create your account

### Posting a Recipe
1. Click "Toggle Post Form" on the homepage
2. Fill in recipe details (title, description, instructions, etc.)
3. Upload a photo and select the appropriate season
4. Click "Submit" to share your post

### Managing Friends
1. Go to the "Friends" section
2. Search for users by username
3. Send follow requests and manage existing connections

### Admin Features
Administrators can:
- View all registered users
- Modify user types (user/admin)
- Delete any posts

## Support

For assistance, please:
1. Check the FAQ section in the application
2. Contact support at: info@recipe-radar.at

## Technical Details

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL (via phpMyAdmin)
- **Compatibility**: Cross-platform (Windows, macOS, Linux)

## License

This project is for educational/demonstration purposes.
