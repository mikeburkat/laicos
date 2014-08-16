CREATE DATABASE `ebdb` /*!40100 DEFAULT CHARACTER SET latin1 */;

CREATE TABLE `city` (
  `cityID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `countryID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`cityID`),
  KEY `FK_city_country_idx` (`countryID`),
  CONSTRAINT `FK_city_country` FOREIGN KEY (`countryID`) REFERENCES `country` (`countryID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `club` (
  `clubID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`clubID`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `comment` (
  `commentID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `postID` int(10) unsigned NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `contentID` int(10) unsigned NOT NULL,
  `commentHeartCount` int(10) unsigned NOT NULL DEFAULT '0',
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`commentID`),
  KEY `FK_comment_user_idx` (`userID`),
  KEY `FK_comment_content_idx` (`contentID`),
  KEY `FK_comment_post_idx` (`postID`),
  CONSTRAINT `FK_comment_user` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_comment_content` FOREIGN KEY (`contentID`) REFERENCES `content` (`contentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_comment_post` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `content` (
  `contentID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `description` varchar(140) DEFAULT NULL,
  PRIMARY KEY (`contentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `convoMap` (
  `conversationID` int(10) unsigned NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  KEY `FK_convoMap_user_idx` (`userID`),
  KEY `convo_idx` (`conversationID`),
  CONSTRAINT `FK_convoMap_user` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `country` (
  `countryID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`countryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `membership` (
  `clubID` int(10) unsigned NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `role` varchar(20) NOT NULL,
  KEY `FK_membership_user_idx` (`userID`),
  KEY `FK_membership_club_idx` (`clubID`),
  CONSTRAINT `FK_membership_club` FOREIGN KEY (`clubID`) REFERENCES `club` (`clubID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_membership_user` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `message` (
  `messageID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contentID` int(10) unsigned NOT NULL,
  `timeCreated` datetime NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `conversationID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`messageID`),
  KEY `FK_message_user_idx` (`userID`),
  KEY `FK_message_conversation_idx` (`conversationID`),
  KEY `FK_message_content_idx` (`contentID`),
  CONSTRAINT `FK_message_content` FOREIGN KEY (`contentID`) REFERENCES `content` (`contentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_message_conversation` FOREIGN KEY (`conversationID`) REFERENCES `convoMap` (`conversationID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_message_user` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `photo` (
  `contentID` int(10) unsigned NOT NULL,
  `image` blob NOT NULL,
  KEY `FK_photo_content_idx` (`contentID`),
  CONSTRAINT `FK_photo_content` FOREIGN KEY (`contentID`) REFERENCES `content` (`contentID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `post` (
  `postID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `contentID` int(10) unsigned NOT NULL,
  `postHeartCount` int(10) unsigned NOT NULL,
  `timeCreated` datetime NOT NULL,
  PRIMARY KEY (`postID`),
  KEY `FK_post_user_idx` (`userID`),
  KEY `FK_post_content_idx` (`contentID`),
  CONSTRAINT `FK_post_content` FOREIGN KEY (`contentID`) REFERENCES `content` (`contentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_post_user` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `postMap` (
  `postID` int(10) unsigned NOT NULL,
  `clubID` int(10) unsigned NOT NULL,
  KEY `FK_postMap_club_idx` (`clubID`),
  KEY `FK_postMap_post_idx` (`postID`),
  CONSTRAINT `FK_postMap_club` FOREIGN KEY (`clubID`) REFERENCES `club` (`clubID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_postMap_post` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `relationship` (
  `userID1` int(10) unsigned NOT NULL,
  `userID2` int(10) unsigned NOT NULL,
  `status` varchar(20) NOT NULL,
  KEY `FK_userID1_user_idx` (`userID1`),
  KEY `FK_userID2_user_idx` (`userID2`),
  CONSTRAINT `FK_userID1_user` FOREIGN KEY (`userID1`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_userID2_user` FOREIGN KEY (`userID2`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `text` (
  `contentID` int(10) unsigned NOT NULL,
  `string` text NOT NULL,
  KEY `FK_text_content_idx` (`contentID`),
  CONSTRAINT `FK_text_content` FOREIGN KEY (`contentID`) REFERENCES `content` (`contentID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user` (
  `userID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `tagline` varchar(140) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cityID` varchar(45) NOT NULL,
  `countryID` varchar(45) NOT NULL,
  `availableHearts` int(10) unsigned NOT NULL,
  `totalHeartsEarned` int(10) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  `lastLogin` datetime NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
