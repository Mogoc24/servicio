DROP TABLE IF EXISTS `changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `changes` (
  `idchanges` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `label` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `users_idusers` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idchanges`),
  KEY `fk_changes_users1_idx` (`users_idusers`),
  CONSTRAINT `fk_changes_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `changes`
--

LOCK TABLES `changes` WRITE;
/*!40000 ALTER TABLE `changes` DISABLE KEYS */;
INSERT INTO `changes` VALUES (1,'Guardar usuario','Luis','2016-04-29 17:26:29',1),(2,'Guardar usuario','Luisifer','2016-04-29 17:28:10',1),(3,'Guardar usuario','Gracy','2016-04-29 17:35:42',1),(4,'Guardar usuario','Memo','2016-04-30 12:07:39',1),(5,'Guardar usuario','Juan','2016-04-30 13:02:58',1);
/*!40000 ALTER TABLE `changes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platforms`
--

DROP TABLE IF EXISTS `platforms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `platforms` (
  `idplatforms` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_platform` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idplatforms`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platforms`
--

LOCK TABLES `platforms` WRITE;
/*!40000 ALTER TABLE `platforms` DISABLE KEYS */;
INSERT INTO `platforms` VALUES (1,'Pegasus'),(2,'Star Track'),(3,'Contador');
/*!40000 ALTER TABLE `platforms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idusers` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(20) DEFAULT NULL,
  `name_user` varchar(45) DEFAULT NULL,
  `ap_user` varchar(45) DEFAULT NULL,
  `pass` char(74) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `type` tinyint(3) unsigned DEFAULT NULL,
  `salt` char(10) DEFAULT NULL,
  `date_user` datetime DEFAULT NULL,
  PRIMARY KEY (`idusers`),
  UNIQUE KEY `name_user_UNIQUE` (`user`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


LOCK TABLES `users` WRITE;

INSERT INTO `users` VALUES (1,'admin','Guillermo','Rodríguez','$2y$10$7kJXFiEbwq1lLvzXQf/naeEpckUUSfNjddUmoTkcwVA25QjoIagmu','g_rodriguez@outlook.es',1,'i!TIfHW2N','2016-04-25 18:07:07'),(2,'Luis','Luis','Tipacamu','$2y$10$dBj2JFVOTbE7nzXwq08UOOG7ILNm/C5LJ3QmCTKb9N7/sblWDeDXe','luis@gmail.com',4,'i!TIfHW2N','2016-04-29 17:26:29'),(3,'Luisifer','Fernando','Ordoñez','$2y$10$jxmEeUe8dwIqUkqJc7U4Ce6gY2TrC4qLF6JUmnx7VKO6r/u38Uph6','fer@gmail.com',3,'i!TIfHW2N','2016-04-29 17:28:10'),(4,'Gracy','Graciela','Vargas','$2y$10$IzOySbsYU5z0taKUmjLNveWcJ7p/tK8dFfP5Jfa1up/wGm.ki2Z.G','gracy@gmail.com',5,'i!TIfHW2N','2016-04-29 17:35:42'),(5,'Memo','Guillermo de Jesús','Rodríguez Morales','$2y$10$rfe2kN9Vv4C/V7z0Daci0eT2ZAEv8.5urHtEg3CqWDmKQnl3BGTue','nemesis_rmgj@hotmail.com',2,'i!TIfHW2N','2016-04-30 12:07:39'),(6,'Juan','Juan','Escutia','$2y$10$5nEmPW7LxBYwTAhWV9R/Y.71iSTOOlC6K4EY4bpkJA807G/ejuGFq','juan@gmail.com',2,'i!TIfHW2N','2016-04-30 13:02:58');

UNLOCK TABLES;
