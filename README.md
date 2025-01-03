# ABOUT
This is a company profile website project for Dealkan Property. The website displays comprehensive information about the company, property services, and the list of properties managed. The property data shown on this website comes from an external API that has been previously developed.

## TABLE OF CONTENTS

-   [Getting Started](#getting-started)
    - [Installation](#installation)
    - [Configuration](#configuration)
- [Architecture and Design](#architecture-and-design)
  - [Architecture](#architecture)
  - [Design](#design)
- [Contact Information](#contact-information)
- [License](#license)

## GETTING STARTED

### Installation

#### Clone Project

#### Install PHP dependencies with Composer

```bash
composer install
```

#### Generate autoload files

```bash
composer dump-autoload
```

#### Copy the .env file

```bash
cp .env.example .env
```

#### Generate the application key

```bash
php artisan key:generate
```

#### Start the Laravel development server

```bash
php artisan serve
```

#### Compile front-end assets

```bash
npm run dev
```

### Configuration

#### API KEYS
To integrate with the external API, you need to configure the API settings in your `.env` file. 
```
API_BASE_URL= # Change to your API base URL
API_CLIENT_ID= # Change to your CLIENT ID
```
If you have any questions or need further assistance regarding API details, please contact the relevant person or team responsible for the API.

### Architecture

This project uses the **Repository Pattern** architecture to separate data access logic from business logic. Here is a brief explanation of the main components:

1. **Repositories**:
    - Classes responsible for interacting with data sources, whether it be a database or external API.
    - Example: `PrimaryRepository.php`, `SecondaryRepository.php`

2. **Services**:
    - Classes containing business logic that use repositories to manipulate data.
    - Example: `PrimaryService.php`, `SecondaryService.php`

3. **Controllers**:
    - Classes handling HTTP requests, calling services to retrieve data, and returning responses to the user.
    - Example: `PrimaryController.php`, `SecondaryController.php`

    - Classes representing data structures in the database.
    - Example: `Property.php`, `User.php`

### Design

The design of this project focuses on responsibility separation and code readability, following these design principles:

1. **Separation of Concerns**:
    - Separating data access, business logic, and presentation logic to facilitate maintenance and development.

2. **Modular Design**:
    - Using separate components to handle data access (repositories), business logic (services), and request handling (controllers).

3. **Responsive UI**:
    - Employing responsive design to ensure the website is accessible across various devices and screen sizes.

4. **Clean Code Practices**:
    - Adhering to clean coding practices to ensure the code is easy to read and maintain.

5. **External API Integration**:
    - Integrating data from external APIs to display property information, using caching mechanisms if needed for efficiency.


## Contact Information

For any questions or support regarding this project, please contact the relevant team members:

<!-- - **Project Manager:** [Name] - [email@example.com]
- **Full-Stack Developer:** [Name] - [email@example.com]
- **Back-End Developer:** [Name] - [email@example.com]
- **UI/UX Designer:** [Name] - [email@example.com]
- **UI/UX Designer:** [Name] - [email@example.com]
- **UI/UX Designer:** [Name] - [email@example.com] -->


## License
This project is licensed under a proprietary license. The code and content are for internal use only and cannot be distributed or modified without permission from the company.

#   i k a d o k p - d e a l k a n  
 