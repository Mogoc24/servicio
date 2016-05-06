CREATE DATABASE grupoit;

USE grupoit;

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `changes`
--

LOCK TABLES `changes` WRITE;
/*!40000 ALTER TABLE `changes` DISABLE KEYS */;
INSERT INTO `changes` VALUES (1,'Guardar usuario','Luis','2016-04-29 17:26:29',1),(2,'Guardar usuario','Luisifer','2016-04-29 17:28:10',1),(3,'Guardar usuario','Gracy','2016-04-29 17:35:42',1),(4,'Guardar usuario','Memo','2016-04-30 12:07:39',1),(5,'Guardar usuario','Juan','2016-04-30 13:02:58',1),(11,'Guardar usuario','Guille','2016-05-02 18:02:36',1),(12,'Guardar usuario','Fer','2016-05-02 18:05:08',1),(15,'Cambio de contraseña','Crypt Pass','2016-05-03 11:35:02',12),(16,'Cambio de contraseña','Crypt Pass','2016-05-03 12:09:14',12),(17,'Cambio de contraseña','Crypt Pass','2016-05-03 12:16:48',12),(18,'Cambio de contraseña','Crypt Pass','2016-05-03 12:18:16',12),(19,'Cambio de contraseña','Crypt Pass','2016-05-03 12:24:40',12),(20,'Cambio de contraseña','Crypt Pass','2016-05-03 12:26:35',12),(21,'Cambio de contraseña','Crypt Pass','2016-05-03 12:28:45',12),(22,'Cambio de contraseña','Crypt Pass','2016-05-03 12:29:53',12),(23,'Cambio de contraseña','Crypt Pass','2016-05-03 12:32:42',12),(24,'Cambio de contraseña','Crypt Pass','2016-05-03 12:34:14',12),(25,'Cambio de contraseña','Crypt Pass','2016-05-03 12:52:48',12);
/*!40000 ALTER TABLE `changes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_platform`
--

DROP TABLE IF EXISTS `customer_platform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_platform` (
  `customers_idcustomers` int(10) unsigned NOT NULL,
  `platforms_idplatforms` int(10) unsigned NOT NULL,
  PRIMARY KEY (`customers_idcustomers`,`platforms_idplatforms`),
  KEY `fk_customers_has_platforms_platforms1_idx` (`platforms_idplatforms`),
  KEY `fk_customers_has_platforms_customers1_idx` (`customers_idcustomers`),
  CONSTRAINT `fk_customers_has_platforms_customers1` FOREIGN KEY (`customers_idcustomers`) REFERENCES `customers` (`idcustomers`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_customers_has_platforms_platforms1` FOREIGN KEY (`platforms_idplatforms`) REFERENCES `platforms` (`idplatforms`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_platform`
--

LOCK TABLES `customer_platform` WRITE;
/*!40000 ALTER TABLE `customer_platform` DISABLE KEYS */;
INSERT INTO `customer_platform` VALUES (1,1),(1,3);
/*!40000 ALTER TABLE `customer_platform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `idcustomers` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_customer` varchar(45) DEFAULT NULL,
  `number` char(10) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcustomers`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Empresa1','1254657','calle central poniente #45 colonia centro','empresa@gmail.com'),(2,'Empresa2','6121654','Caller central oriente #54, colonia centro','empresa2@gmail.com');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
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
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `idservices` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_service` varchar(45) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idservices`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Instalación',1),(2,'Revisión',1),(3,'Reinstalación',1),(4,'Deinstalación',1);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
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
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idusers`),
  UNIQUE KEY `name_user_UNIQUE` (`user`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','Guillermo','Rodríguez','$2y$10$7kJXFiEbwq1lLvzXQf/naeEpckUUSfNjddUmoTkcwVA25QjoIagmu','gjrodriguez91@gmail.com',1,'i!TIfHW2N','2016-04-25 18:07:07',1),(2,'Luis','Luis','Tipacamu','$2y$10$dBj2JFVOTbE7nzXwq08UOOG7ILNm/C5LJ3QmCTKb9N7/sblWDeDXe','luis@gmail.com',4,'i!TIfHW2N','2016-04-29 17:26:29',0),(4,'Gracy','Graciela','Vargas','$2y$10$IzOySbsYU5z0taKUmjLNveWcJ7p/tK8dFfP5Jfa1up/wGm.ki2Z.G','gracy@gmail.com',5,'i!TIfHW2N','2016-04-29 17:35:42',0),(5,'Memo','Guillermo de Jesús','Rodríguez Morales','$2y$10$rfe2kN9Vv4C/V7z0Daci0eT2ZAEv8.5urHtEg3CqWDmKQnl3BGTue','nemesis_rmgj@hotmail.com',2,'i!TIfHW2N','2016-04-30 12:07:39',0),(6,'Juan','Juan','Escutia','$2y$10$5nEmPW7LxBYwTAhWV9R/Y.71iSTOOlC6K4EY4bpkJA807G/ejuGFq','juan@gmail.com',2,'i!TIfHW2N','2016-04-30 13:02:58',0),(12,'Guille','Guillermo','Rodríguez','$2y$10$J/T/i1EbnciL4Cq3exKJHOLt8y9ZwMTy/YwUKLIzHGMS/PDm4ZN2a','g_rodriguez@outlook.es',2,'i!TIfHW2N','2016-05-02 18:02:36',1),(13,'Fer','Luis Fernando','Ordoñez Ruíz','$2y$10$jOOa5cf1UuKtkBj0V5uG1OHvTBzcuKmleeT99PFi8hJKpmwGZvH4S','fernandoordoezruiz@gmail.com',2,'i!TIfHW2N','2016-05-02 18:05:08',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;