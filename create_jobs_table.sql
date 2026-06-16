USE web_assgn2;

CREATE TABLE jobs (
    jobs_id INT AUTO_INCREMENT PRIMARY KEY,
    jobs_ref_num CHAR(5) NOT NULL,
    jobs_position VARCHAR(40) NOT NULL,
    jobs_salary VARCHAR(40) NOT NULL,
    jobs_reporting_line VARCHAR(40) NOT NULL,
    jobs_requirements VARCHAR(200),
    other_requirements TEXT
);