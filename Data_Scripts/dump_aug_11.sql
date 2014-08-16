-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `ebdb`;
CREATE DATABASE `ebdb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ebdb`;

DROP TABLE IF EXISTS `club`;
CREATE TABLE `club` (
  `clubID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `founderID` int(10) unsigned NOT NULL,
  `description` text NOT NULL,
  `posts_allowed_by_members` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`clubID`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `FK_club_founder_idx` (`founderID`),
  CONSTRAINT `FK_club_founder` FOREIGN KEY (`founderID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `club` (`clubID`, `name`, `founderID`, `description`, `posts_allowed_by_members`) VALUES
(1,	'Best Club',	7,	'a place for rock and roll and two other things',	NULL),
(2,	'Legion of Macabre Company',	9,	'amet metus. Aliquam erat volutpat. Nulla facilisis. Suspendisse commodo tincidunt nibh. Phasellus nulla. Integer vulputate, risus a ultricies adipiscing, enim mi tempor lorem, eget mollis',	0),
(3,	'Way of Boon Dock Vendor',	39,	'Aenean euismod mauris eu',	0),
(4,	'Sentinels of ThÃ« BlÃ¤Ã§K Bei',	39,	'ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis.',	0),
(7,	'VÃ­Rulent Thunder',	7,	'vitae dolor. Donec fringilla. Donec feugiat metus sit amet ante. Vivamus non lorem vitae odio sagittis semper. Nam tempor',	0),
(8,	'Wrath of Seventh Turning Clan',	11,	'adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing',	1),
(18,	'Forsaken Souls',	38,	'nonummy. Fusce fermentum fermentum arcu. Vestibulum ante ipsum',	0),
(27,	'Valar Anonymous',	46,	'nulla vulputate',	0),
(34,	'Eyes of Silver Dragon Inches',	46,	'nisi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin',	1),
(40,	'Empire of Fallen Blood Tippers',	38,	'molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper,',	1),
(42,	'Alts Vudu',	8,	'Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris id',	1),
(47,	'The Women of Steel Army',	44,	'aliquet. Proin velit. Sed malesuada augue ut lacus. Nulla tincidunt,',	1),
(49,	'The Starfox Alliance',	38,	'nisl',	1),
(53,	'Knights of Black Tooth Viscious',	45,	'dictum sapien. Aenean massa. Integer vitae nibh. Donec est mauris, rhoncus id, mollis',	1),
(62,	'The Knights of Boneyard Kaos',	12,	'et, rutrum non, hendrerit id, ante.',	1),
(64,	'Keep of Team Action Templar',	10,	'id nunc interdum feugiat. Sed nec metus',	0),
(71,	'Rubber Kindreds',	46,	'imperdiet ullamcorper. Duis at lacus. Quisque purus sapien, gravida non, sollicitudin a, malesuada id, erat. Etiam vestibulum massa rutrum magna. Cras convallis convallis dolor. Quisque tincidunt pede ac',	0),
(72,	'Honored Shadow',	83,	'ipsum. Curabitur consequat, lectus sit amet',	1),
(94,	'first create',	12,	'asdfsadf sd fsd fa sd fsad asfdasdf asd sad asdf asdf sad ',	0),
(95,	'new group',	12,	'asfasljdkhfasdf asd kfjasdkl; sadjfasjd; fksdaj asdfk lsadk;l fsak ldfas;',	1),
(96,	'trying to redirect',	12,	'i\'m not sure this will work',	1),
(97,	'membership test',	12,	'testing the membership and ownership of groups',	1),
(98,	'test1',	7,	'test2',	1),
(99,	'mike\'s group',	66,	'a special group',	1);

DROP TABLE IF EXISTS `clubWall`;
CREATE TABLE `clubWall` (
  `postID` int(10) unsigned NOT NULL,
  `clubID` int(10) unsigned NOT NULL,
  KEY `FK_postMap_club_idx` (`clubID`),
  KEY `FK_postMap_post_idx` (`postID`),
  CONSTRAINT `clubWall_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `clubWall` (`postID`, `clubID`) VALUES
(5,	99),
(17,	99);

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `parentID` int(10) unsigned NOT NULL,
  `childID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`parentID`,`childID`),
  KEY `FK_parent_post_idx` (`parentID`),
  KEY `FK_child_post_idx` (`childID`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`childID`) REFERENCES `post` (`postID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`parentID`) REFERENCES `post` (`postID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `comment` (`parentID`, `childID`) VALUES
(12,	21),
(12,	22),
(12,	23),
(15,	16),
(18,	24),
(18,	25);

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `postID` int(10) unsigned NOT NULL,
  `type` enum('TEXT','IMAGE','VIDEO') NOT NULL,
  `permission` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `link_url` text,
  `text` text,
  PRIMARY KEY (`postID`),
  CONSTRAINT `content_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `content` (`postID`, `type`, `permission`, `link_url`, `text`) VALUES
(5,	'IMAGE',	0,	NULL,	NULL),
(12,	'TEXT',	0,	'',	'this private message should work.'),
(13,	'TEXT',	0,	'',	'create a private message...'),
(14,	'TEXT',	0,	NULL,	'hello'),
(15,	'TEXT',	0,	NULL,	'what\'s up'),
(16,	'TEXT',	0,	NULL,	'it\'s working\n'),
(17,	'TEXT',	0,	NULL,	'group too'),
(18,	'TEXT',	0,	'',	'this is a test'),
(19,	'TEXT',	0,	'',	'asdasdasda'),
(20,	'TEXT',	0,	NULL,	'does it work in chrome?'),
(21,	'TEXT',	0,	NULL,	'this is a test'),
(22,	'TEXT',	0,	NULL,	'awesome, it works!'),
(23,	'TEXT',	0,	NULL,	'this is a private message'),
(24,	'TEXT',	0,	NULL,	'why doesn\'t it stay commited?'),
(25,	'TEXT',	0,	NULL,	'to see console'),
(26,	'TEXT',	0,	NULL,	'hey'),
(27,	'TEXT',	0,	NULL,	'heyhey');

DROP TABLE IF EXISTS `gifts`;
CREATE TABLE `gifts` (
  `giftID` int(11) NOT NULL AUTO_INCREMENT,
  `senderID` int(10) unsigned NOT NULL,
  `receiverID` int(10) unsigned NOT NULL,
  `giftURL` varchar(45) NOT NULL,
  PRIMARY KEY (`giftID`),
  KEY `senderID` (`senderID`),
  KEY `receiverID` (`receiverID`),
  CONSTRAINT `gifts_ibfk_1` FOREIGN KEY (`senderID`) REFERENCES `user` (`userID`) ON DELETE CASCADE,
  CONSTRAINT `gifts_ibfk_2` FOREIGN KEY (`receiverID`) REFERENCES `user` (`userID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `has_tag`;
CREATE TABLE `has_tag` (
  `tagID` int(10) unsigned NOT NULL,
  `clubID` int(10) unsigned NOT NULL,
  KEY `FK_has_tag_tag` (`tagID`),
  KEY `FK_has_tag_club` (`clubID`),
  CONSTRAINT `FK_has_tag_club` FOREIGN KEY (`clubID`) REFERENCES `club` (`clubID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `has_tag` (`tagID`, `clubID`) VALUES
(35,	18),
(57,	18),
(22,	71),
(56,	3),
(50,	62),
(35,	53),
(51,	42),
(26,	42),
(61,	62),
(8,	40),
(52,	7),
(4,	8),
(43,	72),
(22,	7),
(39,	2),
(85,	4),
(14,	47),
(38,	34),
(70,	72),
(68,	49),
(78,	72),
(7,	49),
(57,	49),
(94,	7),
(39,	62),
(42,	53),
(10,	62),
(13,	42),
(22,	49),
(44,	64),
(13,	49);

DROP TABLE IF EXISTS `hearts`;
CREATE TABLE `hearts` (
  `userID` int(10) unsigned NOT NULL,
  `postID` int(10) unsigned NOT NULL,
  KEY `userID` (`userID`),
  KEY `postID` (`postID`),
  CONSTRAINT `hearts_ibfk_3` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE CASCADE,
  CONSTRAINT `hearts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `hearts` (`userID`, `postID`) VALUES
(66,	5),
(68,	15),
(68,	14),
(68,	12),
(68,	18);

DROP TABLE IF EXISTS `invites`;
CREATE TABLE `invites` (
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `member` tinyint(4) NOT NULL DEFAULT '0',
  `invited` varchar(50) NOT NULL,
  `inviter` varchar(50) NOT NULL,
  `invitedurl` varchar(50) NOT NULL,
  PRIMARY KEY (`invited`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `invites` (`timestamp`, `member`, `invited`, `inviter`, `invitedurl`) VALUES
('0000-00-00 00:00:00',	0,	'',	'',	'd41d8cd98f00b204e9800998ecf8427e'),
('0000-00-00 00:00:00',	0,	'a@hotmail.com',	'',	''),
('0000-00-00 00:00:00',	0,	'asasdas@fdsa.ca',	'',	'cf960a90c6da15c310090a56fc142a90'),
('0000-00-00 00:00:00',	0,	'asdads@dsa.dsa',	'',	'd016ba187918e7f68571b5c51e28021e'),
('0000-00-00 00:00:00',	0,	'caca@crotte.debic',	'',	'5c2005b0f97eeb8eaea22a9f1d968c9f'),
('2014-07-27 19:59:40',	0,	'dg@asd.com',	'',	'f0141a5c5d7a8f8f25ef7e464a3bce91'),
('0000-00-00 00:00:00',	0,	'douche@bag.yeah',	'',	'19a3fb0338554f65a74ca0712ed8af5b'),
('2014-08-07 22:30:59',	0,	'geoff@geoff.com',	'',	'797371a189bc30516c212e4f33712def'),
('0000-00-00 00:00:00',	0,	'hnowrigvhw!@HGIOUDSA.GDA',	'',	'e16cde732d22b3a61aa51abe09df65bf'),
('0000-00-00 00:00:00',	0,	'Honert@buggies.net',	'',	'3d3250d6fdfb369d80a6a9b29444a76c'),
('0000-00-00 00:00:00',	0,	'Hornet@buggies.net',	'',	'202e19609fdf9ed773409daac2dc4d55'),
('0000-00-00 00:00:00',	0,	'je@suis.con',	'',	'13890b149a6b0907996fc0d2b798a24c'),
('0000-00-00 00:00:00',	0,	'je@suis.cool',	'',	'd7ddf9128dd052d0b01e65508c23d6be'),
('0000-00-00 00:00:00',	0,	'kpraglowski@gmail.com',	'',	'1e73c42f7248deefbfaf88112d2a0aaf'),
('0000-00-00 00:00:00',	0,	't@est.com',	'',	'8d60728671f60feff517a4179f94350d'),
('0000-00-00 00:00:00',	0,	't@t.com',	'',	'6065906a08ee2df2b20592fe34c6c166'),
('0000-00-00 00:00:00',	0,	'test@test.com',	'',	'b642b4217b34b1e8d3bd915fc65c4452'),
('0000-00-00 00:00:00',	0,	'testicule@penis.bite',	'',	'08495fa27dede25b6e90c0e2746e33fd'),
('2014-07-27 18:06:00',	0,	'testing@time.stamp',	'',	'cd915c12d4cfeabede0ecc71fb02bdc4'),
('0000-00-00 00:00:00',	0,	'tesutih@tges.cds',	'',	'014cfcba908386c9bf8a86263d95830f'),
('0000-00-00 00:00:00',	0,	'wfige@fda.dfa',	'',	'072e4b35025e83420fc4577cff32f93c');

DROP TABLE IF EXISTS `membership`;
CREATE TABLE `membership` (
  `clubID` int(10) unsigned NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `role` varchar(20) NOT NULL,
  KEY `FK_membership_user_idx` (`userID`),
  KEY `FK_membership_club_idx` (`clubID`),
  CONSTRAINT `FK_membership_club` FOREIGN KEY (`clubID`) REFERENCES `club` (`clubID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_membership_user` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `membership` (`clubID`, `userID`, `role`) VALUES
(1,	7,	'owner'),
(1,	7,	'member'),
(97,	12,	'owner'),
(97,	12,	'member'),
(98,	7,	'owner'),
(98,	7,	'member'),
(99,	66,	'owner'),
(97,	67,	'member'),
(3,	66,	'member'),
(34,	67,	'member'),
(64,	67,	'member'),
(99,	66,	'member'),
(72,	83,	'member'),
(72,	83,	'owner'),
(2,	68,	'member');

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `postID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `timeCreated` datetime NOT NULL,
  `isComment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allowsComments` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`postID`),
  KEY `FK_post_user_idx` (`userID`),
  CONSTRAINT `post_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `post` (`postID`, `userID`, `timeCreated`, `isComment`, `allowsComments`) VALUES
(1,	66,	'2014-08-09 19:08:10',	0,	1),
(5,	66,	'2014-08-09 19:08:15',	0,	1),
(12,	68,	'2014-08-10 20:08:19',	0,	1),
(13,	68,	'2014-08-10 20:08:36',	0,	1),
(14,	66,	'2014-08-11 03:08:08',	0,	1),
(15,	66,	'2014-08-11 03:08:25',	0,	1),
(16,	66,	'2014-08-11 03:08:35',	1,	1),
(17,	66,	'2014-08-11 03:08:46',	0,	1),
(18,	68,	'2014-08-11 03:08:42',	0,	1),
(19,	83,	'2014-08-11 04:08:57',	0,	1),
(20,	68,	'2014-08-11 04:08:15',	0,	1),
(21,	68,	'2014-08-11 16:08:46',	1,	1),
(22,	68,	'2014-08-11 16:08:55',	1,	1),
(23,	68,	'2014-08-11 16:08:23',	1,	1),
(24,	68,	'2014-08-11 16:08:01',	1,	1),
(25,	68,	'2014-08-11 16:08:23',	1,	1),
(26,	66,	'2014-08-11 23:08:24',	0,	1),
(27,	66,	'2014-08-11 23:08:13',	0,	1);

DROP TABLE IF EXISTS `privateMessages`;
CREATE TABLE `privateMessages` (
  `messageID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `postID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`messageID`),
  KEY `FK_convoMap_user_idx` (`userID`),
  KEY `convo_idx` (`messageID`),
  KEY `FK_privateMsg_post_idx` (`postID`),
  CONSTRAINT `FK_convoMap_user` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_privateMsg_post` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `privateMessages` (`messageID`, `userID`, `postID`) VALUES
(1,	68,	12),
(2,	10,	12),
(3,	66,	12),
(4,	68,	13),
(5,	10,	13),
(6,	66,	13),
(7,	68,	18),
(8,	66,	18),
(9,	83,	19),
(10,	70,	19);

DROP TABLE IF EXISTS `relationship`;
CREATE TABLE `relationship` (
  `userID1` int(10) unsigned NOT NULL,
  `userID2` int(10) unsigned NOT NULL,
  `status` varchar(20) NOT NULL,
  KEY `FK_userID1_user_idx` (`userID1`),
  KEY `FK_userID2_user_idx` (`userID2`),
  CONSTRAINT `FK_userID1_user` FOREIGN KEY (`userID1`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_userID2_user` FOREIGN KEY (`userID2`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `relationship` (`userID1`, `userID2`, `status`) VALUES
(7,	9,	'collegues'),
(7,	11,	'collegues'),
(7,	8,	'collegues'),
(7,	10,	'collegues'),
(67,	12,	'friends'),
(67,	12,	'family'),
(67,	12,	'collegues'),
(66,	39,	'friends'),
(66,	39,	'friends'),
(66,	39,	'friends'),
(67,	66,	'collegues'),
(67,	69,	'family'),
(67,	69,	'collegues'),
(67,	66,	'collegues'),
(83,	70,	'friends'),
(67,	11,	'friends'),
(67,	11,	'family'),
(66,	9,	'friends'),
(68,	7,	'friends'),
(68,	10,	'friends'),
(68,	83,	'friends'),
(68,	66,	'collegues'),
(11,	66,	'collegues'),
(66,	11,	'friends'),
(66,	7,	'friends'),
(66,	7,	'friends'),
(66,	7,	'friends'),
(67,	11,	'collegues'),
(7,	66,	'collegues'),
(7,	66,	'collegues'),
(66,	7,	'collegues'),
(66,	83,	'collegues'),
(7,	83,	'collegues'),
(83,	67,	'family');

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `tagID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`tagID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tag` (`tagID`, `name`) VALUES
(1,	'Rock and Roll'),
(2,	'Music'),
(3,	'Hurricanes'),
(4,	'Architecture'),
(5,	'Montreal Canadians'),
(6,	'Game Theory'),
(7,	'Crystals'),
(8,	'Aliens'),
(9,	'Cars'),
(10,	'Polygons'),
(11,	'Chocolate'),
(12,	'Pi'),
(13,	'Genetics'),
(14,	'Anthrax'),
(15,	'Bridges'),
(16,	'Cars'),
(17,	'Angles'),
(18,	'Brain'),
(19,	'War'),
(20,	'Nouns'),
(21,	'Newspaper'),
(22,	'Earth'),
(23,	'Pi'),
(24,	'Computers'),
(25,	'Binary'),
(26,	'Eclipse'),
(27,	'Brain'),
(28,	'Allergies'),
(29,	'Basketball'),
(30,	'Programming'),
(31,	'Atoms'),
(32,	'Ants'),
(33,	'Eclipse'),
(34,	'Polygons'),
(35,	'Allergies'),
(36,	'Allergies'),
(37,	'Allergies'),
(38,	'Teeth'),
(39,	'Ethics'),
(40,	'Genetics'),
(41,	'Montreal Canadians'),
(42,	'Algae'),
(43,	'Pi'),
(44,	'Angles'),
(45,	'Earth'),
(46,	'Computers'),
(47,	'Newspaper'),
(48,	'Pi'),
(49,	'Angles'),
(50,	'Soccer'),
(51,	'Ants'),
(52,	'Chocolate'),
(53,	'Montreal Canadians'),
(54,	'Dogs'),
(55,	'Bridges'),
(56,	'Montreal Canadians'),
(57,	'Aliens'),
(58,	'Polygons'),
(59,	'Genetics'),
(60,	'Research'),
(61,	'Robots'),
(62,	'Montreal Canadians'),
(63,	'Ants'),
(64,	'Hockey'),
(65,	'Game Theory'),
(66,	'Algae'),
(67,	'Cells'),
(68,	'Programming'),
(69,	'Bridges'),
(70,	'Binary'),
(71,	'Music'),
(72,	'Alcohol'),
(73,	'Basketball'),
(74,	'Problem Solving'),
(75,	'Music'),
(76,	'Newspaper'),
(77,	'Soccer'),
(78,	'Anthrax'),
(79,	'Game Theory'),
(80,	'Algae'),
(81,	'Atoms'),
(82,	'Hurricanes'),
(83,	'Algae'),
(84,	'Lasers'),
(85,	'Polygons'),
(86,	'Anthrax'),
(87,	'Atoms'),
(88,	'Architecture'),
(89,	'Polygons'),
(90,	'Programming'),
(91,	'Graphics'),
(92,	'Newspaper'),
(93,	'Earth'),
(94,	'Architecture'),
(95,	'Eclipse'),
(96,	'War'),
(97,	'Ants'),
(98,	'Pi'),
(99,	'Bacteria'),
(100,	'Ants'),
(101,	'Baseball'),
(102,	'Atoms');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `userID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` enum('junior','senior','administrator') NOT NULL,
  `status` enum('active','inactive','suspended') NOT NULL,
  `displayName` varchar(15) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `tagline` varchar(140) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `address` text NOT NULL,
  `cityName` varchar(45) NOT NULL,
  `province` varchar(45) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `availableHearts` int(10) unsigned NOT NULL,
  `totalHeartsEarned` int(10) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  `lastLogin` datetime NOT NULL,
  `currentLogin` datetime NOT NULL,
  `dateOfBirth` date NOT NULL,
  `privacy` enum('public','private') NOT NULL,
  `lastStream` varchar(300) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`userID`, `role`, `status`, `displayName`, `firstName`, `lastName`, `tagline`, `email`, `password`, `address`, `cityName`, `province`, `country`, `availableHearts`, `totalHeartsEarned`, `dateCreated`, `dateModified`, `lastLogin`, `currentLogin`, `dateOfBirth`, `privacy`, `lastStream`) VALUES
(7,	'administrator',	'active',	'marcb',	'Marc',	'B',	'Some guy',	'belley.marc@gmail.com',	'202cb962ac59075b964b07152d234b70',	'4321 rue st-jacques apt 204',	'Montreal',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	''),
(8,	'junior',	'active',	'8',	'Bob',	'Joy',	'',	'bob@jay.com',	'827ccb0eea8a706c4c34a16891f84e7b',	'',	'NYC',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	''),
(9,	'junior',	'active',	'9',	'Chuck',	'Norris',	'who needs one?',	'justplainawesome@internets.com',	'ep33n',	'1337',	'Texas',	'texas',	'0',	9001,	0,	'2014-06-26 22:00:21',	'2014-06-26 22:00:21',	'2014-06-26 22:00:21',	'0000-00-00 00:00:00',	'2014-06-26',	'public',	''),
(10,	'junior',	'active',	'10',	'Prof',	'Bipin',	'real life',	'bipin@concordia.ca',	'quiizzzzes',	'lame',	'Montreal',	'Quebec',	'0',	0,	0,	'2014-06-26 22:02:02',	'2014-06-26 22:02:02',	'2014-06-26 22:02:02',	'0000-00-00 00:00:00',	'2014-06-26',	'public',	''),
(11,	'junior',	'active',	'11',	'Smartass',	'Student',	'school sux',	'student@concordia.ca',	'ifail',	'111 de la blah',	'Montreal',	'Quebec',	'0',	0,	0,	'2014-06-26 22:02:51',	'2014-06-26 22:02:51',	'2014-06-26 22:02:51',	'0000-00-00 00:00:00',	'2014-06-26',	'public',	''),
(12,	'senior',	'active',	'12',	'Test',	'test',	'',	'test@test.test',	'd79096188b670c2f81b7001f73801117',	'',	'',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	''),
(38,	'junior',	'active',	'38',	'asdf',	'',	'',	'asdf@asdf.com',	'81dc9bdb52d04dc20036dbd8313ed055',	'',	'',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	''),
(39,	'junior',	'active',	'39',	'Andrea',	'',	'',	'anD.t@hotmail.com',	'1e626dd31cdb460d8b46f12cca396d26',	'',	'',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	''),
(44,	'junior',	'active',	'44',	'asdf',	'',	'',	'asdasdasdasd@gasd.com',	'827ccb0eea8a706c4c34a16891f84e7b',	'',	'',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	''),
(45,	'junior',	'active',	'45',	'asdf',	'',	'',	'1234@asd.com',	'81dc9bdb52d04dc20036dbd8313ed055',	'',	'',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	''),
(46,	'junior',	'active',	'46',	'asdf',	'',	'',	'asdasdasdasd@gasd.com',	'81dc9bdb52d04dc20036dbd8313ed055',	'',	'',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	''),
(64,	'junior',	'active',	'asd',	'asd',	'asd',	'zxc',	'asd@asd.com',	'827ccb0eea8a706c4c34a16891f84e7b',	'asd',	'asd',	'asd',	'0',	0,	0,	'2014-07-06 06:11:47',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2014-07-09',	'public',	''),
(66,	'senior',	'active',	'mikeb',	'Michael',	'Burkat',	'yo',	'mike.burkat@gmail.com',	'e10adc3949ba59abbe56e057f20f883e',	'11207 79th ave NW',	'Edmonton',	'Alberta',	'',	0,	0,	'2014-07-06 14:38:52',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'1987-08-17',	'public',	''),
(67,	'junior',	'active',	'test',	'M',	'B',	'yo',	'fearan@gmail.com',	'e10adc3949ba59abbe56e057f20f883e',	'11',	'11',	'qc',	'',	0,	0,	'2014-07-06 20:45:44',	'2014-08-06 18:11:43',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2013-12-03',	'public',	''),
(68,	'junior',	'active',	'geoff',	'Geoff',	'Stan',	'yup',	'geoffrey.stanley@gmail.com',	'202cb962ac59075b964b07152d234b70',	'11',	'mtl',	'qc',	'1',	1,	2,	'2014-07-07 01:10:58',	'2014-07-07 01:10:58',	'2014-07-07 01:10:58',	'0000-00-00 00:00:00',	'2014-07-07',	'public',	''),
(69,	'junior',	'active',	'dg',	'dg',	'dg',	'asdf',	'dg@dg.com',	'e10adc3949ba59abbe56e057f20f883e',	'asdf',	'asdasd',	'asdasd',	'',	0,	0,	'2014-07-07 11:07:49',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2014-07-02',	'public',	'https://www.youtube.com/watch?v=-KKvIg9d0Kw'),
(70,	'junior',	'active',	'geoff',	'geoff',	'St',	'something',	'e@mail.com',	'073f99773db12841bb1dfed469f8d750',	'123',	'Mtl',	'qc',	'',	0,	0,	'2014-07-12 18:59:44',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	''),
(83,	'senior',	'active',	'',	'Dmitri',	'Grijalva',	'asdasdasd',	'dmitri.grijalva@gmail.com',	'81dc9bdb52d04dc20036dbd8313ed055',	'',	'Montreal',	'',	'',	0,	0,	'2014-07-18 00:36:41',	'2014-08-10 22:24:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2014-07-18',	'public',	''),
(85,	'junior',	'active',	'f_negret',	'Fraklin',	'Negrete',	'im cool',	'fa.negrete@gmail.com',	'e10adc3949ba59abbe56e057f20f883e',	'3838kdfk here',	'Montreal',	'Quebec',	'Canada',	0,	0,	'2014-07-18 17:00:25',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'private',	''),
(88,	'junior',	'active',	'123',	'123',	'123',	'123',	'abc@abaca.com',	'e10adc3949ba59abbe56e057f20f883e',	'123',	'123',	'123',	'123',	0,	0,	'2014-07-19 12:31:59',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0023-12-31',	'public',	''),
(89,	'junior',	'active',	'huoisegad',	'123',	'123',	'123',	'abc@caosnd.com',	'e10adc3949ba59abbe56e057f20f883e',	'asfdn',	'123',	'123',	'123',	0,	0,	'2014-07-19 12:32:58',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0123-12-03',	'public',	''),
(90,	'junior',	'active',	'Thomas',	'Thomas',	'Tige',	'I am awesome',	'thomastige@gmail.com',	'e10adc3949ba59abbe56e057f20f883e',	'123',	'Montreal',	'Quebec',	'Canada',	0,	0,	'2014-07-19 15:26:42',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'1990-06-25',	'public',	''),
(91,	'junior',	'active',	'test',	'test',	'test',	'tester',	't@e.st',	'098f6bcd4621d373cade4e832627b4f6',	'123',	'123',	'123',	'123',	0,	0,	'2014-07-27 11:10:29',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'1564-06-25',	'public',	''),
(92,	'junior',	'active',	'test',	'test',	'test',	'haeto',	't@es.ticule',	'098f6bcd4621d373cade4e832627b4f6',	'jip',	'hio',	'ioh',	'oih',	0,	0,	'2014-07-27 11:11:32',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'private',	''),
(93,	'junior',	'active',	'jkbhb',	'bjk',	'bjkl',	'ihjo',	'randomemail@randomurl.org',	'e10adc3949ba59abbe56e057f20f883e',	'1234',	'1234',	'1234',	'1234',	0,	0,	'2014-07-27 11:20:56',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	'');

DROP TABLE IF EXISTS `userWall`;
CREATE TABLE `userWall` (
  `userID` int(10) unsigned NOT NULL,
  `postID` int(10) unsigned NOT NULL,
  `privacy` tinyint(4) NOT NULL DEFAULT '0',
  KEY `FK_userID_user_idx` (`userID`),
  KEY `FK_postID_post_idx` (`postID`),
  CONSTRAINT `userWall_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `userWall_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `userWall` (`userID`, `postID`, `privacy`) VALUES
(66,	14,	0),
(66,	15,	0),
(66,	20,	0),
(66,	26,	0),
(66,	27,	0);

-- 2014-08-12 02:02:40
