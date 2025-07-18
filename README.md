# Database Schema: Leads CRM

## Table: `users`

| Column   | Type      | Description          |
|----------|-----------|----------------------|
| id       | INT       | Primary key (auto-increment) |
| login    | VARCHAR(255)   | Unique user login    |
| password | VARCHAR(255)   | Hashed password      |

## Table: `leads`

| Column        | Type      | Description                                 |
|---------------|-----------|---------------------------------------------|
| id            | INT       | Primary key (auto-increment)                |
| name          | VARCHAR(255)   | Lead's full name                            |
| email         | VARCHAR(255)   | Lead's email address                        |
| phone         | VARCHAR(255)   | Lead's phone number                         |
| status        | VARCHAR(255)     | Lead status    |
| date_created  | DATE  | Date when the lead was created         |
| date_updated  | DATE  | Date when the lead was last updated    |



