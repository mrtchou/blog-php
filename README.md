Context
The world of web development with PHP is at your fingertips and you need visibility to be able to convince your future employers at a glance.

Description of the need
The project is therefore to develop your professional blog. This website is broken down into two main groups of pages:

the pages useful to all visitors;
the pages for administering your blog.
Here is the list of pages that should be accessible from your website:

the home page ;
the page listing all the blog posts;
the page displaying a blog post;
the page for adding a blog post;
the page allowing to modify a blog post;
the pages allowing to modify / delete a blog post;
user login / registration pages.

You will develop an administration part which must be accessible only to registered and validated users.

The administration pages will therefore be accessible on conditions and you will ensure the security of the administration part.

Let's start with the pages that are useful to all Internet users.

On the home page, you will need to present the following information:

your first and last name;
a photo and / or a logo;
a catchphrase that looks like you (example: “Martin Durand, the developer you need!”);
a menu allowing you to navigate among all the pages of your website;
a contact form (upon submission of this form, an e-mail with all this information will be sent to you) with the following fields:
last name First Name,
contact email,
message,
a link to your CV in PDF format;
and all the links to social networks where you can be followed (GitHub, LinkedIn, Twitter ...).

on the page listing all the blog posts (from the most recent to the oldest), you must display the following information for each blog post:

the title ;
the date of the last modification;
the châpo;
and a link to the blog post.
On the page presenting the details of a blog post, the following information must be displayed:

the title ;
the chapô;
the contents ;
the author;
the date of the last update;
the form for adding a comment (submitted for validation);
lists of validated and published comments.
On the page for modifying a blog post, the user has the option of modifying the title, chapô, author and content fields.

In the footer menu, there should be a link to access the blog administration.

Constraints
This time around, we won't be using WordPress. Everything will be developed by you. The only lines of code that can come from elsewhere will be those of the Bootstrap theme, which you will be careful to choose. Presentation matters! It is also allowed to use one or more external libraries provided they are integrated using Composer.

Please note, your blog must be easily navigable on a mobile (mobile phone, phablet, tablet…). This is essential ! It is essential: D
We strongly recommend that you use a templating engine like Twig, but you don't have to.

On the administration part, you will ensure that only people with "administrator" right have access; other users will only be able to comment on articles (with validation before publication).

Important: You will make sure that there are no security vulnerabilities (XSS, CSRF, SQL Injection, session hijacking, possible PHP script upload, etc.).

Your project must be pushed and available on GitHub. I advise you to work with pull requests. Since the majority of project communications on GitHub are in English, your commits must be in English.

You will need to create all the issues (tickets) corresponding to the tasks you will have to perform to complete the project.

Be sure to validate your tickets to make sure that they cover all the requests of the project. Give an indicative estimate in time or effort points (if you are familiar with the agile methodology) and try to keep this estimate.

Writing these tickets will allow you to agree on a common vocabulary. It is highly appreciated that they are written in English!

Nota Bene
Your project should be monitored via SymfonyInsight, or Codacy for the quality of the code. You will make sure to get a minimum silver medal (for SymfonyInsight). In addition, compliance with PSR is recommended in order to offer a code that is understandable and easily upgradeable.

If you can't make up your mind on the Bootstrap theme, here's one that might be right for you http://bit.ly/2emOTxY (source: startbootstrap.com).

In the event that a feature seems to you to be poorly explained or missing, talk to your mentor to make a decision together about the choices you would like to make. What must prevail must be the deadlines.

Help to approach the project step by step
In order to make your progress more fluid, here is a proposal for a way of working:

Step 1 - Read the full statement and detailed specifications.
Step 2 - Create the UML diagrams.
Step 3 - Create the GitHub repository for the project.
Step 4 - Create all the issues on the GitHub repository (https://github.com/username/nom_du_repo/issues/new).
Step 5 - Estimate all of your outcomes.
Step 6 - Begin application development and offer pull requests for each feature / issue. (The estimate will be done as you develop and will be discussed with your mentor.)
Step 7 - Have your mentor review your code (code proposed in the pull request (s)), and once validated merge the pull request (s) in the main branch. (This review will be used to validate your implementation of best practices and the consistency of your code. The validation will be done continuously during the sessions.)
Step 8 - Validate the quality of the code through SymfonyInsight or Codacy.
Step 9 - Demonstrate the entire application.
Step 10 - Prepare all of your deliverables and submit them to the platform.

INSTALLATION
so to install my code on your home, you must follow the following steps:
- download the controller, model, view, public folders. And the index.php, autoloader.php, and .htacces files. You will find the database in sql format, to load on your server.

-You need first configure the database, in the DataBase.php file.
Then you load the previously downloaded folders and files to your server.

The design style is done with bootstrap. A link is in the header.php file to load bootstrap styles, and other related libraries. You don't need to touch the header.php file if you don't have a specific need.
once the files are loaded, and the database created and configured. You will be able to fully benefit from a professional blog.
