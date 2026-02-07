
# BD_Quake – Earthquake Damage & Shelter Information System

BD_Quake is a full-stack, web-based application designed to assist in disaster management during earthquakes. The platform provides real-time information on damaged buildings, allows users to report damaged locations, view nearby shelters on an interactive map, and enables authorities to manage and analyze earthquake-related data efficiently.

## 🚀 Features

* **User Authentication:** Users can register, log in, and securely manage their sessions.
* **Report Damaged Buildings:** Users can submit reports of damaged buildings with location data.
* **Nearby Shelters:** View verified shelter locations using an interactive map powered by Leaflet.js.
* **Admin Panel:** Admins can monitor, manage, and analyze earthquake-related reports and data.
* **Responsive Frontend:** Built with HTML, CSS, and JavaScript for a user-friendly experience.

## 🧠 Problem Statement

During earthquakes, the lack of real-time information about damaged areas and verified shelter locations hinders effective disaster response. Additionally, there is no centralized system for users to report and track disaster-related data.

BD_Quake addresses these challenges by:

* Providing a platform to report damaged locations with geographical data.
* Displaying verified shelter locations on a map.
* Offering an admin panel to manage and analyze reports and shelter data.

## 🛠️ Tech Stack
* **Frontend:** HTML, CSS, JavaScript
* **Backend:** PHP (RESTful APIs)
* **Database:** MySQL
* **Mapping:** Leaflet.js (Interactive Maps)
* **Version Control:** Git & GitHub

## 🔄 System Workflow

1. **User Interaction:** A user submits a request (e.g., report a damaged building or view nearby shelters).
2. **Backend Validation:** The backend API validates and processes the request.
3. **Data Management:** Data is stored/retrieved from a MySQL database.
4. **Response:** The backend returns a JSON response to the frontend.
5. **UI Update:** The frontend dynamically updates the user interface based on the returned data.

## 🧩 Key Concepts & Technologies Used
* **CRUD Operations:** The system performs Create, Read, Update, and Delete operations to manage reports, shelters, and user data.
* **Authentication & Authorization:** Session-based authentication ensures secure access to the platform.
* **Database Integration:** MySQL database is used for storing user reports, shelter data, and other related information.
* **Map-based Visualization:** Leaflet.js is used to display shelter locations and damaged areas on an interactive map.

## 🛠️ Installation Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/Zisanminhaz/BD_Quake.git
```

### 2. Set Up the Environment

Ensure that you have PHP and MySQL set up on your local machine. You can use XAMPP, WAMP, or any LAMP stack environment.

### 3. Database Configuration

Create a MySQL database and import the database schema.

```sql
CREATE DATABASE bd_quake;
USE bd_quake;
```

Import the schema (you can create an SQL file for this):

```bash
source bd_quake.sql
```

### 4. Configure the Database

In the `config/config.php` file, update the database connection settings with your MySQL credentials.

```php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'bd_quake');
```

### 5. Run the Application

If you're using XAMPP or WAMP, place the project in the `htdocs` directory. You can access the app by visiting `http://localhost/bd-quake` in your browser.

## 🧑‍💻 Project Structure

* **`app/`**: Contains the core application logic, including controllers, models, and views.

  * **`controllers/`**: Handles various application actions like user authentication, reporting damage, and viewing shelters.
  * **`models/`**: Contains PHP files that define data models (e.g., `User.php`, `Shelter.php`, `Report.php`).
  * **`views/`**: Includes the HTML and PHP views for rendering the frontend interface.
* **`config/`**: Contains the configuration files, such as the database connection settings (`config.php`).
* **`core/`**: Includes core files for handling the application's controller logic and database interactions (`Controller.php`, `Database.php`).
* **`public/`**: Publicly accessible files, including the front-end assets (CSS, JavaScript), and the main entry point (`index.php`).
* **`uploads/`**: Stores user-uploaded files (e.g., images, documents).

## 🔒 Security Considerations

* **Session-based Authentication:** Users must log in before they can report damage or access sensitive information.
* **Input Validation:** All inputs are sanitized and validated to protect against SQL injection and other security vulnerabilities.
* **Error Handling:** The application gracefully handles errors and provides meaningful feedback to users.

## 🤝 Contributing

We welcome contributions! If you'd like to improve BD_Quake, please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature-name`).
3. Commit your changes (`git commit -am 'Add your feature'`).
4. Push to your branch (`git push origin feature/your-feature-name`).
5. Open a pull request to the main repository.

## 🧑‍💻 What I Learned

Through this project, I learned how to:

* Integrate user authentication and session management.
* Work with MySQL databases for storing and retrieving application data.
* Create dynamic, map-based data visualizations using Leaflet.js.
* Apply full-stack development principles in a real-world application.

## 📞 Contact

For inquiries or questions, feel free to reach out to zisan330@gmail.com

---


