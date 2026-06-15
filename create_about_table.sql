-- Tell the server which database to use (replace with your actual DB name)
USE web_assgn2;

-- Create the table
CREATE TABLE about (
    abtld INT AUTO_INCREMENT PRIMARY KEY,
    name VAHCAR(50) NOT NULL,
    student_id VACHAR(20) NOT NULL,
    contribution_1 TEXT NOT NULL,
    contrinution_2 TEXT NOT NULL,
    quote TEXT NOT NULL,
    f_language VARCHAR(200) NOT NULL,
    image_path VACHAR(255) NOT NULL
);