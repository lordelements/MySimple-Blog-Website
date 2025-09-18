## Blog Website Built with Laravel, Vue.js, and Inertia.js

This is a Blog Website built using Laravel for the backend, Vue.js for the frontend, and Inertia.js to seamlessly connect the two. The website allows users to create, edit, view, and comment on blog posts. It also provides an admin interface to manage the content. The data is stored in a MySQL database.

---

## Technologies Used

** Laravel:**  A PHP framework used for the backend API, routing, authentication, and database management.

** Vue.js ** : A progressive JavaScript framework for building the user interface.

** Inertia.js: A framework that enables building single-page apps using server-side routing, leveraging Vue.js without the need for a traditional API.

** MySQL: A relational database management system for storing the blog posts, user data, and comments.

---

## Features

** User Authentication: Allows users to register, log in, and manage their profiles.

** Blog Post CRUD: Users can create, read, update, and delete blog posts.

** Commenting System: Authenticated users can add comments to blog posts.

** Pagination: Pagination is implemented for navigating through a large list of posts.

** Admin Features: Admin users can manage posts and comments.

** Responsive Design: The website is fully responsive and optimized for mobile and desktop use.

---

Installation
Prerequisites

PHP (>= 7.4)

Composer: Dependency management tool for PHP

Node.js (>= 14.x)

MySQL or any other supported database

---

### Steps to Install

* Clone the repository:

git clone https://github.com/yourusername/your-repository-name.git
cd your-repository-name

---

* Install Laravel dependencies:

composer install

---

* Set up the environment file:

Copy .env.example to .env:

cp .env.example .env

---

Then, configure the database and other environment variables in the .env file.

* Generate application key:

php artisan key:generate

---

* Run database migrations:

php artisan migrate

---

* Install front-end dependencies:

npm install

---

* Compile assets:

npm run dev

---

* Start the Laravel development server:

php artisan serve

---

Now, you can access the application at http://localhost:8000.
