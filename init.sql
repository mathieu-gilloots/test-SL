CREATE DATABASE `test_smartloc`;
CREATE USER 'smartloc'@'%' IDENTIFIED BY 'smartloc';
GRANT ALL PRIVILEGES ON `test\_smartloc`.* TO 'smartloc'@'%';

USE `test_smartloc`;

CREATE TABLE `tickets` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `data` json NOT NULL
) COLLATE 'utf8mb4_general_ci';

INSERT INTO `tickets` (`data`)
VALUES ('{\"title\":\"Premier ticket\", \"content\":\"Bug sur la page d\'accueil\", \"category\":\"Bug\", \"created_date\":\"2024-01-10 00:00:00\", \"status\":\"done\"}');

INSERT INTO `tickets` (`data`)
VALUES ('{\"title\":\"Deuxieme ticket\", \"content\":\"Bug sur la page de contact\", \"category\":\"Bug\", \"created_date\":\"2024-01-11 00:00:00\", \"status\":\"todo\"}\r\n');

INSERT INTO `tickets` (`data`)
VALUES ('{\"title\":\"3ème ticket\", \"content\":\"Email automatique de contact\", \"category\":\"Nouvelle fonctionnalité\", \"created_date\":\"2024-01-12 00:00:00\", \"status\":\"todo\"}');