SELECT * FROM users;	* = All fields

SELECT username, password FROM users;

INSERT INTO users (username, password, email, status) VALUES ('admin', 'admin', 'admin@admin.com', 1);

INSERT INTO users SET username='demo', password='demo', email='demo@demo.com', status=1;

UPDATE users SET username='demo1', password='demo1', email='demo1@demo.com', status=0 WHERE user_id=4 AND status='1';

DELETE FROM users WHERE user_id=3 OR user_id=4;

DROP TABLE users;

TRUNCATE users;



SELECT * FROM users WHERE username='admin' AND password='admin';

SELECT * FROM users WHERE username LIKE '%adm%';

SELECT * FROM users WHERE username LIKE 'a%';

SELECT * FROM users WHERE username LIKE '%a';

task

school database


