# Rafiq API & Security Assessment 

Presenting my role in our Graduation Project as i was responsible for creating the Backend API & Secure it 

---

**Tech used**: Laravel 12 - Php - PostgreSQL

Relying on Laravel Structure as the best for our project to divide it into controllers & models to help simulate the Database structure 

PostgreSQL for Safe & Secure network connection with the Database schema 

---

Security depends on OWASP API top 10 Vulnerabilities 

Strong Authentication & Authorization used 

JWT token created for each user to link him with his columns in the Database 

Bcrypt password hash function to avoid store the password as a plain text 

preventing bugs like:
IDOR - SQLI - CORS - CSRF - XSS

Sanitized all the endpoints that contains a parameter to prevent from bugs like xss

---

## Postman Workspace 

Created full postman environment for all teammates to test their work through the api 

Dividing each Database schema into a file contain endpoints coming from Laravel api routing table 
