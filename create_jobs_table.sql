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

INSERT INTO `jobs` (`jobs_id`, `jobs_ref_num`, `jobs_position`, `jobs_salary`, `jobs_reporting_line`, `jobs_requirements`, `other_requirements`) 
VALUES (NULL, 'UI011', 'Junior UI/UX Designer', '$50,000 - $70,000 per year', 'Lead UI/UX Director', 'Proven experience as a UI/UX Designer or similar role\r\nPortfolio demonstrating design skills and experience\r\nExperience with Figma, Sketch, or Adobe Creative Suite', 'User-centered design principles knowledge');

INSERT INTO `jobs` (`jobs_id`, `jobs_ref_num`, `jobs_position`, `jobs_salary`, `jobs_reporting_line`, `jobs_requirements`, `other_requirements`) 
VALUES (NULL, 'JP020', 'Junior Engine Programmer', '$60,000 - $80,000 per year', 'Lead Engine Programmer', 'Bachelor\'s degree in Computer Science or related field\r\nProficiency in C++ and C#\r\nExperience with Unity or Unreal Engine', 'Experience with modern graphics APIs (Vulkan, D3D12)');

INSERT INTO `jobs` (`jobs_id`, `jobs_ref_num`, `jobs_position`, `jobs_salary`, `jobs_reporting_line`, `jobs_requirements`, `other_requirements`) 
VALUES (NULL, 'DO130', 'DevOps Engineer', '$85,000 - $110,000 per year', 'Product Manager', 'Bachelor\'s degree in Computer Science or related field\r\nExperience with AWS, Azure, or GCP\r\nProficiency in automation tools and scripting', 'Understanding of Docker and Kubernetes');