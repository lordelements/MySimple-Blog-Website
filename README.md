
##Blog Website

---
This is a blog website built using Laravel, Vue.js, Inertia.js, and MySQL. It provides a platform for users to create, edit, and comment on blog posts. This project demonstrates the integration of modern JavaScript frameworks with a PHP backend and is designed with clean and intuitive user interfaces.
---
##Technologies Used

Laravel: A powerful PHP framework used for handling backend logic, routing, database management, and API functionality.

Vue.js: A progressive JavaScript framework used for building the front-end of the application with a reactive user interface.

Inertia.js: A framework for building modern single-page apps using classic server-side routing and controllers, simplifying the integration of Vue with Laravel.

MySQL: A relational database management system used for storing data such as blog posts, comments, and user information.
---
##Features

User Authentication: Users can register, login, and manage their account.

CRUD Operations for Blog Posts: Users can create, read, update, and delete their posts.

Commenting System: Users can add comments to posts.

Pagination: Posts are paginated to ensure a smooth user experience when browsing.

Admin Features: Admin users have the ability to manage posts and comments.

##Installation
Prerequisites
---
Before running the project, ensure you have the following installed:

PHP (>= 7.4)

Composer

Node.js (>= 14.x)
---
MySQL or a compatible database system

Steps to Set Up

Clone the repository:

git clone https://github.com/yourusername/your-repository-name.git
cd your-repository-name


Install Laravel dependencies:

Run the following command to install PHP dependencies:

composer install


Set up your .env file:

Copy the .env.example file to .env:

cp .env.example .env


Update the .env file with your MySQL database credentials and other environment variables.

Generate the application key:

php artisan key:generate


Set up the database:

Run the migrations to create the necessary tables:

php artisan migrate


Install front-end dependencies:

Install Node.js dependencies:

npm install


Compile assets:

Run the following command to compile your JavaScript and CSS:

npm run dev


Run the development server:

Start the Laravel development server:

php artisan serve


You can now access your app at http://localhost:8000.

Usage

Home Page: Displays all blog posts with the option to read more or view individual posts.

Create Post: Logged-in users can create new blog posts.

Comment System: Users can add comments to blog posts.

Admin Panel: Admin users can manage posts and comments.

Contributing

Contributions are welcome! If you would like to contribute to this project, please follow these steps:

Fork the repository

Create a new branch (git checkout -b feature-name)

Make your changes and commit them (git commit -am 'Add new feature')

Push to the branch (git push origin feature-name)

Create a pull request
