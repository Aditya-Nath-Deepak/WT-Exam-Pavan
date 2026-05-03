# How to Run — Spring Boot Product Inventory (MongoDB)

## Requirements
- Java 17+ — download from https://adoptium.net
- Maven 3.6+ — usually bundled with IDE
- MongoDB — install from https://www.mongodb.com/try/download/community
- IDE: IntelliJ IDEA / Eclipse / VS Code with Java extension

## Steps

### 1. Start MongoDB
```bash
# On Linux/Mac
mongod

# On Windows — start MongoDB service from Services or run:
"C:\Program Files\MongoDB\Server\6.0\bin\mongod.exe"
```

### 2. Run the Spring Boot App

**Using Maven:**
```bash
cd 09-springboot-product-inventory
mvn spring-boot:run
```

**Using IDE:**
- Open the project folder in IntelliJ IDEA
- Run `ProductInventoryApplication.java`

App starts at: `http://localhost:8080`

## Test with Postman
| Method | URL | Description |
|--------|-----|-------------|
| GET    | `http://localhost:8080/api/products` | Get all products |
| POST   | `http://localhost:8080/api/products` | Add new product |
| PUT    | `http://localhost:8080/api/products/{id}` | Update product |
| DELETE | `http://localhost:8080/api/products/{id}` | Delete product |

## Basic Auth Credentials
- Username: `admin`
- Password: `admin123`
- Add these in Postman under **Authorization → Basic Auth**

## Project Structure
```
09-springboot-product-inventory/
├── src/main/java/com/example/inventory/
│   ├── ProductInventoryApplication.java
│   ├── model/Product.java
│   ├── repository/ProductRepository.java
│   ├── controller/ProductController.java
│   └── config/SecurityConfig.java
├── src/main/resources/
│   └── application.properties
└── pom.xml
```


Mock Data (JSON)
[
  {
    "id": "P101",
    "name": "iPhone 14",
    "category": "Electronics",
    "price": 79999.0,
    "quantity": 10
  },
  {
    "id": "P102",
    "name": "Samsung Galaxy S23",
    "category": "Electronics",
    "price": 74999.0,
    "quantity": 8
  },
  {
    "id": "P103",
    "name": "HP Pavilion Laptop",
    "category": "Computers",
    "price": 65000.0,
    "quantity": 5
  },
  {
    "id": "P104",
    "name": "Dell Inspiron Laptop",
    "category": "Computers",
    "price": 62000.0,
    "quantity": 6
  },
  {
    "id": "P105",
    "name": "Sony Headphones",
    "category": "Accessories",
    "price": 4999.0,
    "quantity": 15
  },
  {
    "id": "P106",
    "name": "Logitech Mouse",
    "category": "Accessories",
    "price": 999.0,
    "quantity": 25
  },
  {
    "id": "P107",
    "name": "Nike Running Shoes",
    "category": "Footwear",
    "price": 3999.0,
    "quantity": 12
  },
  {
    "id": "P108",
    "name": "Adidas T-Shirt",
    "category": "Clothing",
    "price": 1499.0,
    "quantity": 20
  }
]