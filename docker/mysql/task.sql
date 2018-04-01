DROP DATABASE IF EXISTS tm;
CREATE DATABASE IF NOT EXISTS tm;
USE tm;

SELECT 'CREATING DATABASE STRUCTURE' as 'INFO';

DROP TABLE IF EXISTS task;

CREATE TABLE task
(
  id VARCHAR(45) NOT NULL PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  status VARCHAR(25) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  priority VARCHAR(25) NOT NULL
);

INSERT INTO tm.task (id, name, status, created_at, updated_at, priority) VALUES ('190eb08e-2f5f-4cc3-901c-00407bf6a87d', 'Add button', 'TODO', '2018-01-01 20:18:13', '2018-04-01 20:18:24', 'Minor');
INSERT INTO tm.task (id, name, status, created_at, updated_at, priority) VALUES ('4df9e772-c6be-4a0a-acd8-b3a53198e9c7', 'Check validation', 'TODO', '2017-04-01 20:19:08', '2018-03-03 20:19:11', 'Major');