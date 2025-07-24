
  DELIMITER //
CREATE TRIGGER PID_insert
BEFORE INSERT ON getserver
FOR EACH ROW
BEGIN
    DECLARE last_pid INT;
    SET last_pid = (SELECT IFNULL(MAX(pid), 0) FROM getserver);
    SET NEW.pid = last_pid + 1;
END;
//
DELIMITER ;

  DELIMITER //
CREATE TRIGGER PID_shop
BEFORE INSERT ON shop
FOR EACH ROW
BEGIN
    DECLARE last_pid INT;
    SET last_pid = (SELECT IFNULL(MAX(pid), 0) FROM shop);
    SET NEW.pid = last_pid + 1;
END;
//
DELIMITER ;

