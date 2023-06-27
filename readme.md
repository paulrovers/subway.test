#Welcome to the readme file of the subway test

- project url http://subway.test
- smtp account needed 
- mysql account needed
- build on php 8.0

#Login details for admin
- email: paul@rovers.nl
- pass: admin

#install project
- upload the files to your hosting and make the /public/ path your root hosting directory
- run composer install to get all vendor packages
- change the filename .env_example to .env and fill in the database and smtp details
- execute the subway.sql file in your database
- add a line to your hosts file:  YourServerIp subway.test