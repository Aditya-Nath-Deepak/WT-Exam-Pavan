# Online Book Store - Spring Boot Application

This is a minimalistic Spring Boot application designed for a lab exam. It features an online book store with a beautiful UI.

## Features
- **Home Page**: A welcoming landing page.
- **Registration Page**: Allows users to register an account and saves credentials to the database.
- **Login Page**: Authenticates users against the database.
- **Catalog Page**: Displays a list of books populated in the database.

## Technologies Used
- Java 17
- Spring Boot 3.2.5 (Web, Data JPA)
- Thymeleaf (Template Engine)
- MySQL Database
- HTML/CSS (Glassmorphism & Responsive Design)

## Prerequisites
- JDK 17
- Maven
- MySQL Server

## Setup and Running the Project

### 1. Clone the Repository
```bash
git clone <repository-url>
cd online-book-store-springboot
```

### 2. Configure MySQL
Ensure MySQL is running on `localhost:3306`.

Log in to MySQL and verify your credentials:
```bash
mysql -u root -p123456
```

The database `BookStores` will be created automatically on first run via `createDatabaseIfNotExist=true` in the JDBC URL.

If your credentials differ, update `src/main/resources/application.properties`:
```properties
spring.datasource.url=jdbc:mysql://localhost:3306/BookStores?createDatabaseIfNotExist=true&useSSL=false&allowPublicKeyRetrieval=true
spring.datasource.username=root
spring.datasource.password=123456
```

### 3. Build the Application
```bash
mvn clean install
```

### 4. Run the Application
```bash
mvn spring-boot:run
```

Or run the generated JAR:
```bash
java -jar target/online-book-store-0.0.1-SNAPSHOT.jar
```

### 5. Access the Application
Open your browser and navigate to:
[http://localhost:8080/](http://localhost:8080/)

## Troubleshooting

- **Build failure / exit code 1**: Usually a database connection issue. Ensure MySQL is running and credentials in `application.properties` are correct.
- **Database not found**: The JDBC URL includes `createDatabaseIfNotExist=true` which auto-creates the `BookStores` database. Make sure this parameter is present.
- **Access denied for user 'root'**: Verify your MySQL password matches the one in `application.properties`.

## Note
A few sample books are automatically populated into the database when the application starts for the first time.
