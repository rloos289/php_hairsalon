# _Hair Salon_

#### _An app to help a hair salon stay organized, 9/23/16_

#### By _**Ryan Loos**_

## Setup/Installation Requirements

* _Clone this repository to your desktop_
* _Run composer install in terminal_
* _Create a database by running the following commands in terminal_
* _-CREATE DATABASE hair_salon;_
* _-USE hair_salon;_
* _-CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR (255));_
* _-CREATE TABLE clients (id serial PRIMARY KEY, name VARCHAR (255), stylist_id INT);_
* _start an apache server_
* _start a server in web directory (php -S localhost:8000)_

_You must host this webpage locally_

## Behavior Driven Development

| Behavior      | Input       |Output|
| ------------- |-------------| -----|
| Create a stylist category and save the individual instance to the database | "Suzan" | "Suzan" |
| Create functionality that list all stylists | click | "Suzan","Jacob" |
| Create functionality that deletes all stylists | click | "" |
| Be able to locate a stylist by a unique ID | 1 | "Suzan" |
| Update a stylist's information in the system | "Suzan" | "Suzy" |
| Delete a stylist in the system | "Suzan" | "" |

| Create a client category and save the individual instance to the database | "Lauren" | "Lauren" |
| Create functionality that list all clients | click | "Lauren","Mitch" |
| Create functionality that deletes all clients | click | "" |
| Be able to locate a client by a unique ID | 1 | "Lauren" |
| Update a client's information in the system | "Lauren" | "Lory" |
| Delete a client in the system | "Lauren" | "" |

| Be able to find all clients under a certain stylist | "Suzan" | "Lauren","Mitch" |

## Known Bugs

_None yet_

## Support and contact details

_Ryan Loos: Rloos289@gmail.com_

## Technologies Used

_HTML,
PHP,
TWIG 1.0,
SILEX 1.1,
MAMP_

### License

*This webpage is licensed under the GPL license.*

Copyright (c) 2016 **_Ryan Loos_**
