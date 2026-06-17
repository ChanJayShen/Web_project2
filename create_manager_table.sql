USE web_assgn2;

CREATE TABLE if NOT EXISTS manager (
    manager_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) 
VALUES ('Admin', '$2y$10$mCgY6eP9wH6rG1v0vEFEUeX3HhG2QvJ0lBeX1SgBlb7v7S2iKGeOW');

INSERT INTO users (username, password) 
VALUES ('student', '$2y$10$7Z2v0TfO3vD7MvR0B4e8GeZ6Hj9pXgW8YxM7N6qK5.zZ4l3r1C5Ry');