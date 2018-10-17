-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.19 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de données de la table stillcesf.meeting : ~0 rows (environ)
/*!40000 ALTER TABLE `meeting` DISABLE KEYS */;
/*!40000 ALTER TABLE `meeting` ENABLE KEYS */;

-- Export de données de la table stillcesf.migration_versions : ~2 rows (environ)
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` (`version`) VALUES
	('20181010142257'),
	('20181010151033');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;

-- Export de données de la table stillcesf.photo : ~0 rows (environ)
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` (`id`, `description`, `date`, `project_id`, `user_id`) VALUES
	(1, 'image_1', '2018-10-17', 1, 1),
	(2, 'image_2', '2018-10-17', 1, 1),
	(3, 'image_3', '2018-10-17', 1, 1),
	(4, 'image_4', '2018-10-17', 1, 1),
	(5, 'image_5', '2018-10-17', 1, 1),
	(6, 'image_6', '2018-10-17', 1, 1),
	(7, 'image_7', '2018-10-17', 1, 1),
	(8, 'image_8', '2018-10-17', 1, 1),
	(9, 'image_9', '2018-10-17', 1, 1),
	(10, 'image_10', '2018-10-17', 1, 1),
	(11, 'image_11', '2018-10-17', 1, 1),
	(12, 'image_12', '2018-10-17', 1, 1),
	(13, 'image_13', '2018-10-17', 1, 1);
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;

-- Export de données de la table stillcesf.project : ~0 rows (environ)
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` (`id`, `client`, `region`, `phases`, `statuts`, `progress`, `contract_file`, `user_id`) VALUES
	(1, 'project_1', 'rabat', 'A', 'Conflict', 10, NULL, 1),
	(2, 'project_2', 'rabat', 'B', 'Conflict', 40, NULL, 2),
	(3, 'project_3', 'rabat', 'A', 'Fast track', 50, NULL, 2),
	(4, 'project_4', 'rabat', 'C', 'Robus', 65, NULL, 3),
	(5, 'project_5', 'rabat', 'D', 'Robus', 15, NULL, 1);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;

-- Export de données de la table stillcesf.task : ~0 rows (environ)
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` (`id`, `description`, `date`, `ord`, `project_id`, `creator`, `attached_to`) VALUES
	(1, 'task_1', '2018-10-17', 0, 1, 1, 1),
	(2, 'task_2', '2018-10-17', 1, 3, 2, 3),
	(3, 'task_3', '2018-10-17', 2, 1, 1, 1),
	(4, 'task_4', '2018-10-17', 3, 3, 2, 3),
	(5, 'task_5', '2018-10-17', 4, 1, 1, 2);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;

-- Export de données de la table stillcesf.user : ~0 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `full_name`, `role`, `password`, `statuts`) VALUES
	(1, 'mouhcine', 'admin', '123456', 1),
	(2, 'khalid', 'admin', '12356', 1),
	(3, 'samira', 'admin', '123456', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
