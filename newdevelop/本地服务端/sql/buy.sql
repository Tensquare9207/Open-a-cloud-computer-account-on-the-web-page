CREATE TABLE IF NOT EXISTS `buy` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    name TEXT NULL,
    yuan TEXT NULL,
    password TEXT NULL,

    pid INT NULL,

  
    hide INT NULL
)
