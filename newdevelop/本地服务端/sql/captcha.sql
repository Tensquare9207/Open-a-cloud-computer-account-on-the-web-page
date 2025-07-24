CREATE TABLE captcha (    
    id INT AUTO_INCREMENT PRIMARY KEY,    
    user VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,    
    status VARCHAR(255) NOT NULL DEFAULT '0',  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(255) NULL,
    type VARCHAR(255) NULL,    
    code VARCHAR(255) NULL  
);  
