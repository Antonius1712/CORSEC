# CorSec Web Application

**CorSec** is a web application designed to streamline and manage corporate secretarial tasks efficiently. It provides a secure environment for storing confidential files, ensuring that only authorized users can access sensitive information. This README outlines the key features, setup instructions, and other essential details to help you get started with CorSec.

## Table of Contents
- [Features](#features)
- [Technology Stack](#technology-stack)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Security](#security)
- [Deployment](#deployment)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Features
- **Confidential File Storage**: Securely store corporate documents and ensure that only users with granted access can view or download them.
- **User Access Management**: Role-based access control allowing admins to manage which users have access to specific files or sections of the application.
- **Audit Logs**: Track all actions related to file access and user management to maintain a clear record for compliance and security audits.
- **Task Management**: Organize and manage corporate secretarial tasks to ensure nothing is overlooked.
- **Notification System**: Alerts for important events such as new file uploads, changes in user access, or task deadlines.

## Technology Stack
- **Frontend**: 
  - **HTML5** for structuring the web pages.
  - **CSS3** and **Bootstrap** for responsive and modern UI design.
  - **JavaScript** for interactive features and dynamic content.
- **Backend**: [Laravel](https://laravel.com/) - A robust PHP framework for handling server-side logic, data management, and security.
- **Database**: [MSSQL](https://www.microsoft.com/en-us/sql-server/sql-server-downloads) - A reliable relational database management system used to securely store application data.
- **Authentication**: A proprietary encryption method provided by the company for secure user authentication (details cannot be published).

## Installation

### Prerequisites
- [PHP](https://www.php.net/) >= 7.4
- [Composer](https://getcomposer.org/) for dependency management
- [MSSQL](https://www.microsoft.com/en-us/sql-server/sql-server-downloads) for the database

### Steps
1. **Clone the repository**:
   ```bash
   git clone https://github.com/Antonius1712/CORSEC.git
   cd corsec
   ```
2. **Install backend dependencies**:
   ```bash
   composer install
   ```
3. **Environment setup**:
   Copy `.env.example` to `.env`:
   ```bash
   cp .env.example .env
   ```
   Configure the .env file with your MSSQL database credentials and other environment-specific variables.

4. **Database migration: Run the migrations to set up the required tables in your MSSQL database**:
   ```bash
   php artisan migrate
   ```
5. **Generate application key**:
   ```bash
   php artisan key:generate
   ```
6. **Start the development server**:
   ```bash
   php artisan serve
   ```
7. **Access the application: Open your browser and navigate to http://localhost:8000**:

## Configuration

Edit the .env file to configure your database connection, mail server, and other environment-specific settings. Ensure that the MSSQL database credentials are correctly set up to connect to your database.

## Usage

- **Login**: Use your credentials to log in and access the dashboard.
- **File Uploads**: Upload and manage confidential files, ensuring that they are accessible only to authorized users.
- **User Management**: Admins can assign roles and permissions to users, controlling who can access specific files or perform certain actions.
- **Task Management**: Create, assign, and track corporate secretarial tasks to ensure compliance and efficient management.

## Security

- **Access Control**: Utilize role-based access control to manage permissions.
- **Encryption**: All sensitive data, including files, are encrypted using a proprietary method to ensure confidentiality.
- **Audit Logs**: Detailed logs of user actions are stored for audit purposes.


## Deployment

To deploy CorSec to a production environment, follow these steps:
1. Set up your production environment (web server, database, etc.).
2. Deploy the application using your preferred deployment method (e.g., traditional server setup).
3. Configure environment variables in the .env file on the production server.
4. Run migrations on the production database:
   ```bash
   php artisan migrate --force
   ```

## Contact

For any questions or support, please reach out to:

- **Name**: Antonius Christian
- **Email**: antonius1712@gmail.com
- **Phone**: +6281297275563
- **LinkedIn**: [Antonius Christian](https://www.linkedin.com/in/antonius-christian/)

Feel free to connect with me via email or LinkedIn for any inquiries or further information.


## Screenshots

## Screenshots

Here are some screenshots of the Corsec application:

### Login
![Login](https://raw.githubusercontent.com/Antonius1712/docs-screenshots/master/CORSEC/LOGIN.png)
*Login page for the application.*

### Admin Page - Add New Document
![Admin Page - Add New Document](https://raw.githubusercontent.com/Antonius1712/docs-screenshots/master/CORSEC/ADMIN-PAGE-ADD-NEW-DOCUMENT.png)
*Screenshot of the admin page where new documents can be added.*

### Admin Page - Add New Master Document
![Admin Page - Add New Master Document](https://raw.githubusercontent.com/Antonius1712/docs-screenshots/master/CORSEC/ADMIN-PAGE-ADD-NEW-MASTER-DOCUMENT.png)
*Screenshot of the admin page for adding new master documents.*

### Admin Page - Document
![Admin Page - Document](https://raw.githubusercontent.com/Antonius1712/docs-screenshots/master/CORSEC/ADMIN-PAGE-DOCUMENT.png)
*Overview of the admin page for managing documents.*

### Admin Page - Master Document
![Admin Page - Master Document](https://raw.githubusercontent.com/Antonius1712/docs-screenshots/master/CORSEC/ADMIN-PAGE-MASTER-DOCUMENT.png)
*Screenshot showing the admin page for master documents.*

### Document List
![Document List](https://raw.githubusercontent.com/Antonius1712/docs-screenshots/master/CORSEC/DOCUMENT-LIST.png)
*View of the document list within the application.*

### Home Page
![Home Page](https://raw.githubusercontent.com/Antonius1712/docs-screenshots/master/CORSEC/HOME%20PAGE.png)
*The home page of the application.*
