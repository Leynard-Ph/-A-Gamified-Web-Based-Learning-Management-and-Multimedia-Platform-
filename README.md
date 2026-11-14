# Net? Interactive?: A Gamified Web-Based Learning Management and Multimedia Platform for Network Simulation and Infrastructure Fundamentals

Author: Leynard Ayala Members:Miranda, Reñevo, De Mesa, Chavez, 

# Net Learn PHP system

A new computer-networking learning system built with plain PHP, PDO, MySQL/MariaDB, HTML, CSS, and JavaScript. It does not use Laravel or another framework.

## Features

- Student registration, sign-in, and saved learning progress
- Lessons on networking foundations, OSI, IPv4 subnetting, VLANs, and routing
- Guided practice labs and interactive LAN connection visual
- Learning resources, including Packet Tracer and Wireshark links, YouTube embeds, and direct video playback
- Quizzes with answer feedback, explanations, and saved results
- Student dashboard for lesson completion, labs, and quiz scores
- Admin dashboard with student role management, lesson/resource/activity/quiz/question management, quiz results, and printable or CSV reports

## Run with XAMPP

1. Copy this folder into `C:\\xampp\\htdocs\\net-learn`.
2. Start Apache and MySQL in XAMPP.
3. Import `setup.sql` using phpMyAdmin.
4. Open `http://localhost/net-learn/` and register a student account.

The default local database is `net_learn`, user `root`, blank password. Edit `config/database.php` to change credentials.

## Run with Nginx and PHP-FPM

Set the Nginx document root to this folder and pass PHP requests to PHP-FPM. Configure the database credentials in `config/database.php` or provide `DB_HOST`, `DB_NAME`, `DB_USER`, and `DB_PASSWORD` to the PHP-FPM pool. Example Nginx server block:

```nginx
server {
    listen 80;
    server_name localhost;
    root /path/to/net-learn-php-system;
    index index.php;
    location / { try_files $uri $uri/ =404; }
    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_pass 127.0.0.1:9000;
    }
    location ~ /\. { deny all; }
}
```

Use the socket or address for your PHP-FPM installation. Import the same `setup.sql` into MySQL/MariaDB before opening the site.

## Create the first administrator

Register an account, then run this query in the `net_learn` database, replacing the email:

```sql
UPDATE users SET role='admin' WHERE email='your-email@example.com';
```

Sign out and back in to open the administrator dashboard.



