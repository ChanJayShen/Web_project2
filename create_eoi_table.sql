-- Tell the server which database to use (replace with your actual DB name)
USE web_assgn2;

-- Create the table
CREATE TABLE eoi (
    eoild INT AUTO_INCREMENT PRIMARY KEY,
    job_ref_num CHAR(5) NOT NULL,
    f_name VARCHAR(20) NOT NULL,
    l_name VARCHAR(20) NOT NULL,
    date_birth DATE NOT NULL,
    gender VARCHAR(10) NOT NULL,
    street_add VARCHAR(40) NOT NULL,
    suburb_town VARCHAR(40) NOT NULL,
    state CHAR(3) NOT NULL,
    postcode CHAR(4) NOT NULL,
    email VARCHAR(50) NOT NULL,
    p_num VARCHAR(12) NOT NULL,
    skills VARCHAR(200),
    other_skills TEXT,
    status ENUM('New', 'Current', 'Final') DEFAULT 'New' NOT NULL
);