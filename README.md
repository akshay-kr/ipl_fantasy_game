# README #

This README would normally document whatever steps are necessary to get your application up and running.

### What is this repository for? ###

* Quick summary
Image Resizer is CodeIgniter PHP application which adds watermark, canvas and resizes images based on the properties given. It automatically creates the directory structure of the images. We deal with two types of images namely Face and HD image. Faces image will not have watermarks and will be of maximum 330x480 pixels. Face images cannot be renamed and deleted but can be directly changed. HD images will have watermarks and can be of maximum 1920x1440 pixels. HD images can be renamed and deleted. 
Three redis queues are used. They are:
1. imageresize - For resizing image including adding watermark and canvas.
2. imagedelete - For deleting images(Only for HD).
3. imagerename - For renaming images(Only for HD).
* Version
1.0

### How do I get set up? ###

* Configuration
1. Redis server must be installed.
   For Linux go to:- https://www.digitalocean.com/community/tutorials/how-to-install-and-use-redis
   
2. GD and Imagick library must be installed.
   GD:- sudo apt-get install php5-gd, 
   Imagick:- sudo apt-get install php5-imagick

* Database configuration
Database:
Pricebaba database is used for accessing the permalink and keyword.
No data is updated inside the database.
* How to run tests
Test are written in test controller and runs automatically when the controller is run.

### Contribution guidelines ###

* Writing tests
Write tests in Test controller.


### Who do I talk to? ###

* Repo owner or admin
Tirthesh Ganatra