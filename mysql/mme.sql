CREATE TABLE article
(
  id INT(11) PRIMARY KEY NOT NULL,
  room_id INT(11) NOT NULL,
  category_id INT(11) NOT NULL,
  name VARCHAR(255) NOT NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  img VARCHAR(255) NOT NULL,
  shop_name VARCHAR(255) NOT NULL,
  webpage VARCHAR(255) NOT NULL,
  updated_on TIMESTAMP DEFAULT 'CURRENT_TIMESTAMP' NOT NULL,
  created_on TIMESTAMP DEFAULT '0000-00-00 00:00:00' NOT NULL,
  CONSTRAINT article_ibfk_1 FOREIGN KEY (room_id) REFERENCES room (id),
  CONSTRAINT article_ibfk_4 FOREIGN KEY (category_id) REFERENCES category (id)
);
CREATE INDEX category_id ON article (category_id);
CREATE INDEX room_id ON article (room_id);
CREATE TABLE category
(
  id INT(11) PRIMARY KEY NOT NULL,
  name VARCHAR(255) NOT NULL,
  updated_at TIMESTAMP DEFAULT '0000-00-00 00:00:00' NOT NULL,
  created_at TIMESTAMP DEFAULT '0000-00-00 00:00:00' NOT NULL
);
CREATE UNIQUE INDEX name ON category (name);
CREATE TABLE client
(
  id INT(11) PRIMARY KEY NOT NULL,
  name VARCHAR(255) NOT NULL,
  lastname VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  updated_at TIMESTAMP DEFAULT '0000-00-00 00:00:00' NOT NULL,
  created_at TIMESTAMP DEFAULT '0000-00-00 00:00:00' NOT NULL
);
CREATE UNIQUE INDEX email ON client (email);
CREATE TABLE department
(
  id INT(11) PRIMARY KEY NOT NULL,
  name VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT '0000-00-00 00:00:00' NOT NULL,
  updated_at TIMESTAMP DEFAULT '0000-00-00 00:00:00' NOT NULL
);
CREATE UNIQUE INDEX name ON department (name);
CREATE TABLE room
(
  id INT(11) PRIMARY KEY NOT NULL,
  department_id INT(11) NOT NULL,
  client_id INT(11) NOT NULL,
  name VARCHAR(255) NOT NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  image VARCHAR(255) NOT NULL,
  updated_at TIMESTAMP DEFAULT 'CURRENT_TIMESTAMP' NOT NULL,
  created_at TIMESTAMP DEFAULT 'CURRENT_TIMESTAMP' NOT NULL,
  CONSTRAINT room_ibfk_1 FOREIGN KEY (department_id) REFERENCES department (id),
  CONSTRAINT room_ibfk_2 FOREIGN KEY (client_id) REFERENCES client (id)
);
CREATE INDEX client_id ON room (client_id);
CREATE INDEX department_id ON room (department_id);