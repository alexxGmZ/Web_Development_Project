# Web Development Project

You can edit or optimize the code, Just follow the Rules

__This is the Web Development Project Repository for Finals__ 

__Contributing Members:__

* Gomez (alexxShandsome)
* Arganda (earlylalo)
* Encabo (orly20)

__Dependencies:__

* Bootstrap Version 5
* XAMPP
* XAMPP for Linux

__Rules for Maintaining This Project__

* Use TABS for indention for uniformity in all editors that uses TABS, do not convert tabs to spaces.
* Follow Proper indention formatting.
* Code readability is priority, "It's okay to be buggy as long as readable".
* Push changes in the ```testing``` branch because ```main``` is for production only, which means it should be stable and has little bugs.
* Every page has should have their own separate CSS file.
* List ecountered bugs in the "Known Bug/s" section.

__Things To Do:__

* Change Color Scheme (Lean more on Pastel or Lighter color)
* Restructure Database and its Tables to Fit the new Project
* Create a User Profile Page (```user_profile.php```)
* Redesign Landing Page (```landing.php```)
* Redesign Registration Page (```registration.php```)
* Redesign Login Page (```login.php```)
* Redesign and Rename New Article page to New Post (```new_article.php``` to ```new_post.php```)
* Improve Navbar design (```navbar.php``` and ```logged_in_navbar.php```)

__Known Bug/s:__

* (Insert known bugs here)



__New Database Name: memesite__

__Table/s:__

```

```

__Old Database Name:__ article_site

__Table/s:__

```
Registered_Users
    * FIRST_NAME      varchar(30)
    * LAST_NAME       varchar(30)
    * USER_NAME       varchar(30)
    * EMAIL           varchar(30) (PK)
    * PASSWORD        text
    * GENDER          varchar(30)
    * BIRTHDAY        date
    * ADDRESS         text
    * PROFILE_PIC     text
    * BIO             text

Written_Article
    * HEADLINE        varchar(200) (PK)
    * CONTENT         text
    * AUTHOR          varchar(30)
    * THUMBNAIL       text
    * CATEGORY        varchar(30)
    * PUBLISH_DATE    date
```
