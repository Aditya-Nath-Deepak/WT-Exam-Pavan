📦 Product Inventory Management System (Spring Boot + MongoDB)
🧾 Question

 Develop a Spring Boot-based Product Inventory Management System 
 that stores and manages product details using MongoDB as the 
 database. 
 Tasks: 1. Configure MongoDB connection. 
 2. Create document class. 
 3. Create MongoRepository interface. 
 4.Add Spring Security Dependency 
 5. Implement Basic Authentication 
 6. Perform basic CRUD operations.(implement REST APIs for CRUD ) 
 7. Test the Application(Use Postman) 

🧰 Prerequisites

Make sure the following are installed:

Java (JDK 17 or 21)
Maven
MongoDB
VS Code
Install VS Code Extensions:
Java Extension Pack
Spring Boot Extension Pack
⚙️ Project Setup (Spring Initializr)

If project is not already created:

Press CTRL + SHIFT + P
Select: Spring Initializr: Create a Maven Project
Choose:
Spring Boot version: 3.x
Language: Java
Enter:
Group: com.example
Artifact: myapp
Packaging: Jar
Java Version: 17 or 21
Dependencies:
Spring Web
Spring Data MongoDB
Spring Security
Lombok (optional)
Click Generate


🗄️ Install & Run MongoDB

Start MongoDB server:

mongod

You should see:

Waiting for connections on port 27017


🔧 Configure MongoDB Connection

Edit src/main/resources/application.properties:

spring.data.mongodb.uri=mongodb://localhost:27017/productdb

server.port=8080

# Security credentials
spring.security.user.name=admin
spring.security.user.password=admin123

# Optional logging
logging.level.org.springframework=INFO

📁 Project Structure
src/main/java/com/example/myapp/
│
├── config/        → Security configuration
├── controller/    → REST APIs
├── model/         → Product document
├── repository/    → MongoRepository interface
├── service/       → Business logic
└── MyappApplication.java
🧩 Product Model
@Document(collection = "products")
public class Product {

    @Id
    private String id;
    private String name;
    private String description;
    private double price;
    private int quantity;

    // getters & setters OR Lombok
}
🗃️ Repository Layer
public interface ProductRepository extends MongoRepository<Product, String> {
}
🧠 Service Layer

Handles business logic and interacts with the repository for CRUD operations.

🌐 REST API Endpoints
Method	Endpoint	Description
POST	/products	Create product
GET	/products	Get all products
GET	/products/{id}	Get product by ID
PUT	/products/{id}	Update product
DELETE	/products/{id}	Delete product
🔐 Spring Security Configuration
@Bean
public SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {
    http
        .csrf(csrf -> csrf.disable())
        .authorizeHttpRequests(auth -> auth.anyRequest().authenticated())
        .httpBasic(Customizer.withDefaults());

    return http.build();
}
▶️ Build & Run Application
Build:
mvn clean install
Run:
mvn spring-boot:run

OR run MyappApplication.java directly.

🌍 Application URL
http://localhost:8080
🔑 Authentication

All APIs require Basic Authentication:

Username: admin
Password: admin123
🧪 API Testing (Postman)

Use Postman to test APIs.

🔹 Authorization
Type: Basic Auth
Username: admin
Password: admin123
🔹 Create Product

POST /products

Body → raw → JSON:

{
  "name": "Laptop",
  "description": "Gaming Laptop",
  "price": 80000,
  "quantity": 10
}
🔹 Get All Products

GET /products

🔹 Get Product by ID

GET /products/{id}

🔹 Update Product

PUT /products/{id}

{
  "name": "Updated Laptop",
  "description": "High-end Gaming Laptop",
  "price": 90000,
  "quantity": 8
}
🔹 Delete Product

DELETE /products/{id}

⚠️ Common Issues & Fixes
❌ 415 Unsupported Media Type

✔ Use raw JSON instead of form-data

❌ 401 Unauthorized

✔ Check username/password
✔ Ensure Basic Auth is set in Postman

❌ MongoDB Connection Failed

✔ Run mongod before starting application

❌ Port Already in Use

Change port:

server.port=8081

🎯 Key Concepts
@Document → Maps class to MongoDB collection
MongoRepository → Provides CRUD operations
@RestController → Creates REST APIs
@RequestBody → Converts JSON to Java object
Basic Authentication → Secures endpoints