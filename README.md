## Table of contents

- [Overview](#overview)
  - [Screenshot](#screenshot)
  - [Links](#links)
- [My process](#my-process)
  - [Built with](#built-with)
  - [What I learned](#what-i-learned)


## Overview
BlogHub is a dynamic blog platform built using PHP and MySQL, designed to let users share and manage blog content with ease. The system includes robust functionality for creating, managing, and moderating posts.

- Users can create blog posts with a title, subtitle, body, category, and image.

- After submission, a toaster notification appears informing the user that the post will be reviewed by the admin before being published.

- Posts must be approved by the admin before they appear on the homepage, ensuring content moderation.

- Users can edit or delete only the posts they have created — other users cannot modify someone else’s content.

- Other users can comment on blog posts, promoting discussion and engagement.

- Admins have a dedicated interface to approve or reject pending posts.

This project demonstrates essential PHP functionalities including CRUD operations, session handling, user roles, and moderation workflows in a blog environment.

### Screenshot

![](./bloghub.png.jpg)

### Links

- Solution URL: [View Code](https://github.com/Ramelzkie96/bloghub.git)
- Live Site URL: [Live Site](https://bloghub-website.infinityfreeapp.com/index.php)

## My process

### Built With
- **PHP** – for server-side scripting and backend logic

- **MySQL** – for managing the database and storing blog data

- **HTML5** – for structuring the web pages

- **CSS3** – for styling and layout

- **JavaScript** – for client-side interactivity and UI enhancements

- **Toastr.js** – for displaying non-blocking notifications

- **PDO** – for secure and flexible database interaction




### What I Learned

- How to build a dynamic content management system using PHP and MySQL
- Implementing CRUD operations securely using PDO
- User authentication and access control to restrict unauthorized actions
- Handling admin approval workflows before publishing content
- Displaying toaster notifications to enhance user feedback
- Preventing unauthorized edits/deletions based on user roles
- Structuring reusable and maintainable code across PHP pages