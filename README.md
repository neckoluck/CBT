Computer-Based Testing (CBT) System for Polytechnic Admission

Description
This project presents a web-based Computer-Based Testing (CBT) system designed to support admission examinations at State Polytechnics in Indonesia (c.q. State Polytechnic of Kupang).
The system adopts a modular three-layered architecture (frontend, backend, database) optimized for scalability, reliability, and user experience.
The platform integrates role-based access for Examinees, Proctors, and Administrators, streamlining the entire examination workflow from question management and session control to real-time answer submission and result reporting.

Key Features
Examinee
- Secure login using registration token
- Randomized question order (Computerized Fixed Test model)
- Interactive answer submission and immediate scoring
- Instant access to individual results
Proctor
- Session and room monitoring dashboard (25–30 examinees per session)
- Attendance tracking and incident logging
- Session reporting and anomaly detection
Administrator
- Question bank management with multimedia support (text, images, formulas)
- Room and session configuration
- Proctor assignment
- Comprehensive results management and analytics

Architecture
- Frontend: HTML5, CSS3, JavaScript (Bootstrap)
- Backend: PHP (CodeIgniter MVC framework)
- Database: MySQL/MariaDB (relational schema for examinees, test items, sessions, administration)
- Webserver: Apache HTTP Server

Security & Integrity
- Role-based access control
- Randomized question sequencing (CFT model)
- Data integrity measures to prevent manipulation
- Audit logs for administrative and proctor actions

Future Enhancements
- Adaptive testing mechanisms
- Remote proctoring and integration with national educational data platforms
- Enhanced reporting and analytics dashboards

Installation
1. Install Apache, PHP (>=7.4), and MySQL/MariaDB.
2. Clone or download this repository.
3. Import the provided SQL schema into your MySQL/MariaDB server.
4. Configure database connection settings in application/config/database.php.
5. Start Apache and navigate to http://localhost/cbt in your browser.

License
- Restricted Access (Proprietary): The code is not publicly available; access granted upon request under NDA.

Contact
For access requests, support, or collaboration:
Nicodemus Mardanus Setiohardjo
State Polytechnic of Kupang, Indonesia
Email: nicoluck81@gmail.com 
