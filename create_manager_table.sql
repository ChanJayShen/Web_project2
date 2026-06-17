USE web_assgn2;

CREATE TABLE if NOT EXISTS manager (
    manager_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO managers (username, password) 
VALUES ('Admin', ''); 

INSERT INTO managers (username, password) 
VALUES ('Admin', 'Admin');  //marker access//