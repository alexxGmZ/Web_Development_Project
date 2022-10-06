# Database Wannabe

__This is the Web Systems & Technologies Database Laboratory Activity__ 

__Contributing Members:__
* Gomez A. (Leader)
* Esma
* Arganda
* Bragais

__Dependencies:__
* Bootstrap Version 5
* XAMPP 7.4.29
* XAMPP for Linux 7.4.29-0 

__Task List:__
- [x] Required Fields
- [x] Upload Validation
- [x] Storing Data to Database
- [x] Fetching Information from Database
- [x] Output Created Articles to Landing Page
- [x] Session Implementation
- [x] Connect All Pages

__Rules for Maintaining This Project__
* Use TABS for indention for uniformity in all editors that uses TABS
* Follow Proper indention formatting
* Code readability is priority, "It's okay to be buggy as long as readable"

__Database Name:__ article_site
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

