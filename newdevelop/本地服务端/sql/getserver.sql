CREATE TABLE IF NOT EXISTS `getserver` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updata_time TEXT NULL,
    server_name TEXT NULL,
    server_ip TEXT NULL,
    server_data TEXT NULL,
    server_cpu TEXT NULL,
    server_memory TEXT NULL,
    server_network TEXT NULL,
    server_disk TEXT NULL,
    server_order TEXT NULL,
    server_task_list TEXT NULL,




    status TEXT NULL,
        pid INT NULL,
        uid TEXT NULL,
        name TEXT NULL,
    hide INT NULL,
    level INT NULL
)
