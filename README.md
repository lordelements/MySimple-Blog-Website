## Blog Website Built with Laravel, Vue.js, and Inertia.js

This is a Blog Website built using Laravel for the backend, Vue.js for the frontend, and Inertia.js to seamlessly connect the two. The website allows users to create, edit, view, and comment on blog posts. It also provides an admin interface to manage the content. The data is stored in a MySQL database.

---

## Technologies Used

**Laravel**:  A PHP framework used for the backend API, routing, authentication, and database management.

**Vue.js**: A progressive JavaScript framework for building the user interface.

**Inertia.js**: A framework that enables building single-page apps using server-side routing, leveraging Vue.js without the need for a traditional API.

**MySQL**: A relational database management system for storing the blog posts, user data, and comments.

---

## Features

**User Authentication**: Allows users to register, log in, and manage their profiles.

**Blog Post CRUD**: Users can create, read, update, and delete blog posts.

**Commenting System**: Authenticated users can add comments to blog posts.

**Pagination**: Pagination is implemented for navigating through a large list of posts.

**Admin Features**: Admin users can manage posts and comments.

**Responsive Design**: The website is fully responsive and optimized for mobile and desktop use.

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

---

### How It Works

Home Page: Displays a list of all blog posts, each with the title, content snippet, and comment count. Users can click to view individual posts.

Create Post: Authenticated users can create a new post from the "Create Post" page.

Post View: Each post has a page with full content and an option to comment. Users can also view comments, and if authenticated, post a new comment.

Admin Panel: Admin users have the ability to edit or delete any post and manage comments.

Pagination: Posts are paginated for easy navigation. Pagination is handled using the Pagination component.

---

### Controller and Service Flow

**Controller**: The controller handles the incoming HTTP requests for displaying, creating, and deleting posts, as well as adding comments.

**Inertia.js**: This helps render the pages with Vue components while keeping the backend logic inside Laravel. It sends and receives data as props to the Vue components.

**Vue Components**: The frontend uses Vue components to display posts, comments, and pagination, making the site highly interactive.

---

### Example: Blog Post with Comments

Below is an example of how a post is displayed in the frontend using the PostCard component.

---

```php

<template>
  <div class="post-card">
    <h3>{{ post.title }}</h3>
    <p>{{ post.content }}</p>
    <p>{{ post.comments?.length || 0 }} Comments</p>
  </div>
</template>

<script setup>
defineProps({
  post: {
    type: Object,
    required: true,
  },
})
</script>
```

**In this example, we access the post object as a prop and display the title, content, and comment count**.

## Full Project Structure

---

```text

app/
    Http/
        Controllers/
            PostController.php
            CommentController.php
    Models/
        Post.php
        Comment.php
    Services/
        PostService.php
        CommentService.php
    Resources/
        views/
            posts/
                index.blade.php
                show.blade.php
    routes/
        web.php
    database/
        migrations/
            create_posts_table.php
            create_comments_table.php
```

---

## Future Enhancements

**Search Functionality**: Allow users to search for posts by keywords.

**User Profiles**: Implement user profiles to display posts created by a specific user.

**Tags and Categories**: Add functionality to categorize posts with tags.

**Likes and Reactions**: Allow users to like or react to posts and comments.

**Contributing**

## Fork the repository.

**Create a new branch for your feature**: git checkout -b feature-name.

**Make your changes and commit**: git commit -am 'Add new feature'.

**Push to your branch**: git push origin feature-name.

**Create a pull request**.

