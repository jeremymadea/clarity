
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id`        INTEGER PRIMARY KEY AUTO_INCREMENT, 
    `username` 	VARCHAR(20), 
    `password`  CHAR(48), 
    `email`     VARCHAR(200)
);
