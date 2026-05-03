# Order Management System

A minimalistic Spring Boot-based Order Management System providing REST APIs to manage customer orders. This project is created for a lab exam.

## Technologies Used
- Java 17
- Spring Boot (Web, Data JPA)
- H2 In-Memory Database
- Maven

## Setup and Run

1. **Build the project**
   ```bash
   mvn clean install
   ```

2. **Run the application**
   ```bash
   mvn spring-boot:run
   ```
   The application will start on `http://localhost:8081`.

## REST APIs

| HTTP Method | Endpoint | Description |
|---|---|---|
| POST | `/api/orders` | Create a new order |
| GET | `/api/orders` | Retrieve all orders |
| GET | `/api/orders/{id}` | Retrieve a specific order by ID |
| PUT | `/api/orders/{id}` | Update a specific order by ID |
| DELETE | `/api/orders/{id}` | Delete a specific order by ID |

## Example Payloads (JSON)

**Create Order (POST `/api/orders`)**
```json
{
  "customerName": "John Doe",
  "productName": "Laptop",
  "quantity": 1,
  "price": 1200.50
}
```

**Update Order (PUT `/api/orders/{id}`)**
```json
{
  "customerName": "John Doe",
  "productName": "Gaming Laptop",
  "quantity": 2,
  "price": 2400.00
}
```

## Database
An in-memory H2 database is used. You can access the H2 console at `http://localhost:8080/h2-console` with the following credentials:
- **JDBC URL:** `jdbc:h2:mem:orderdb`
- **Username:** `sa`
- **Password:** `password`
