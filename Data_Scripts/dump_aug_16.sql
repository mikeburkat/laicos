-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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
(40,	'Empire of Fallen Blood Tippers',	38,	'molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper,',	1),
(42,	'Alts Vudu',	8,	'Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris id',	1),
(47,	'The Women of Steel Army',	44,	'aliquet. Proin velit. Sed malesuada augue ut lacus. Nulla tincidunt,',	1),
(49,	'The Starfox Alliance',	38,	'nisl',	1),
(53,	'Knights of Black Tooth Viscious',	45,	'dictum sapien. Aenean massa. Integer vitae nibh. Donec est mauris, rhoncus id, mollis',	1),
(62,	'The Knights of Boneyard Kaos',	12,	'et, rutrum non, hendrerit id, ante.',	1),
(64,	'Keep of Team Action Templar',	10,	'id nunc interdum feugiat. Sed nec metus',	0),
(94,	'first create',	12,	'asdfsadf sd fsd fa sd fsad asfdasdf asd sad asdf asdf sad ',	0),
(95,	'new group',	12,	'asfasljdkhfasdf asd kfjasdkl; sadjfasjd; fksdaj asdfk lsadk;l fsak ldfas;',	1),
(96,	'trying to redirect',	12,	'i\'m not sure this will work',	1),
(97,	'membership test',	12,	'testing the membership and ownership of groups',	1),
(98,	'test1',	7,	'test2',	1),
(99,	'mike\'s group',	66,	'a special group',	1),
(101,	'test create from admin',	66,	'bla bla bla',	1),
(102,	'a new group',	66,	'asdlkfj',	1),
(103,	'testgroup',	66,	'asdfkjlasdf',	1),
(105,	'grouptest',	66,	'asdfasdfas',	1),
(106,	'ASD',	66,	'asdfasdfsad',	1),
(107,	'asdfs ad',	66,	'asdfas df',	1),
(108,	'test group',	98,	'',	1);

DROP TABLE IF EXISTS `clubWall`;
CREATE TABLE `clubWall` (
  `postID` int(10) unsigned NOT NULL,
  `clubID` int(10) unsigned NOT NULL,
  `private` int(11) NOT NULL DEFAULT '0',
  KEY `FK_postMap_club_idx` (`clubID`),
  KEY `FK_postMap_post_idx` (`postID`),
  CONSTRAINT `clubWall_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `clubWall` (`postID`, `clubID`, `private`) VALUES
(5,	99,	0),
(17,	99,	0),
(28,	1,	0),
(47,	47,	0),
(49,	62,	0),
(55,	49,	0),
(56,	49,	0),
(57,	49,	0),
(58,	49,	0),
(59,	49,	0),
(60,	49,	0),
(61,	49,	0),
(62,	49,	0);

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
(15,	45),
(18,	24),
(18,	25),
(28,	30),
(50,	51),
(65,	66);

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
(20,	'TEXT',	0,	NULL,	'does it work in chrome?'),
(21,	'TEXT',	0,	NULL,	'this is a test'),
(22,	'TEXT',	0,	NULL,	'awesome, it works!'),
(23,	'TEXT',	0,	NULL,	'this is a private message'),
(24,	'TEXT',	0,	NULL,	'why doesn\'t it stay commited?'),
(25,	'TEXT',	0,	NULL,	'to see console'),
(26,	'TEXT',	0,	NULL,	'hey'),
(27,	'TEXT',	0,	NULL,	'heyhey'),
(28,	'TEXT',	0,	NULL,	'do group posts work in chrome?'),
(29,	'TEXT',	0,	NULL,	'this is a test'),
(30,	'TEXT',	0,	NULL,	'can i reply to stuff here?'),
(33,	'TEXT',	0,	'',	'ASD'),
(34,	'VIDEO',	0,	'https://www.youtube.com/watch?v=31Onv--r6dg',	NULL),
(40,	'IMAGE',	0,	'swimfan2.gif',	''),
(41,	'IMAGE',	0,	'swimfan3.gif',	''),
(42,	'TEXT',	0,	'',	'Allô! Ceci est un test français!'),
(43,	'TEXT',	0,	NULL,	'test'),
(45,	'TEXT',	0,	NULL,	'This is a comment'),
(47,	'IMAGE',	0,	NULL,	NULL),
(48,	'TEXT',	0,	'',	'test'),
(49,	'IMAGE',	0,	NULL,	NULL),
(50,	'TEXT',	0,	'',	'where are your post?'),
(51,	'TEXT',	0,	NULL,	'lol'),
(52,	'IMAGE',	0,	NULL,	NULL),
(53,	'IMAGE',	0,	NULL,	NULL),
(54,	'TEXT',	0,	'',	'awww'),
(55,	'IMAGE',	0,	NULL,	NULL),
(56,	'IMAGE',	0,	NULL,	NULL),
(57,	'IMAGE',	0,	NULL,	NULL),
(58,	'IMAGE',	0,	NULL,	NULL),
(59,	'TEXT',	0,	NULL,	'http://i625.photobucket.com/albums/tt339/mac-turbo/net/programmer.gif'),
(60,	'TEXT',	0,	NULL,	'http://i625.photobucket.com/albums/tt339/mac-turbo/net/programmer.gif'),
(61,	'IMAGE',	0,	NULL,	NULL),
(62,	'IMAGE',	0,	NULL,	NULL),
(63,	'IMAGE',	0,	'programmer.gif',	''),
(64,	'IMAGE',	0,	'',	''),
(65,	'VIDEO',	0,	'https://www.youtube.com/watch?v=9YnrsenzQRU',	NULL),
(66,	'TEXT',	0,	NULL,	'lol'),
(67,	'TEXT',	0,	'',	'testestestset');

DROP TABLE IF EXISTS `gifts`;
CREATE TABLE `gifts` (
  `giftID` int(11) NOT NULL AUTO_INCREMENT,
  `senderID` int(10) unsigned NOT NULL,
  `receiverID` int(10) unsigned NOT NULL,
  `giftGiven` double NOT NULL,
  PRIMARY KEY (`giftID`),
  KEY `receiverID` (`receiverID`),
  KEY `senderID` (`senderID`),
  CONSTRAINT `gifts_ibfk_6` FOREIGN KEY (`senderID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gifts_ibfk_5` FOREIGN KEY (`receiverID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `gifts` (`giftID`, `senderID`, `receiverID`, `giftGiven`) VALUES
(5,	85,	68,	4),
(6,	85,	97,	3),
(7,	85,	97,	3),
(8,	97,	85,	3),
(9,	97,	85,	1),
(10,	68,	85,	2),
(11,	7,	85,	2),
(12,	39,	85,	2),
(13,	85,	97,	1),
(14,	97,	68,	2),
(15,	97,	66,	2),
(16,	97,	98,	2),
(17,	97,	68,	3),
(18,	97,	66,	4),
(19,	97,	98,	3),
(20,	97,	68,	4),
(21,	97,	99,	2),
(22,	100,	97,	2),
(23,	97,	98,	4),
(24,	97,	100,	4),
(25,	97,	98,	2),
(26,	100,	97,	0),
(27,	97,	100,	1),
(28,	97,	100,	2),
(29,	97,	10,	2),
(30,	97,	98,	2);

DROP VIEW IF EXISTS `group_newsfeed`;
CREATE TABLE `group_newsfeed` (`postID` int(10) unsigned, `timeCreated` datetime, `isComment` tinyint(1) unsigned, `type` enum('TEXT','IMAGE','VIDEO'), `text` text, `displayName` varchar(15), `userID` int(10) unsigned, `firstName` varchar(45), `lastName` varchar(45), `heartCount` bigint(21));


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
(56,	3),
(50,	62),
(35,	53),
(51,	42),
(26,	42),
(61,	62),
(8,	40),
(52,	7),
(4,	8),
(22,	7),
(39,	2),
(85,	4),
(14,	47),
(68,	49),
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
(68,	18),
(68,	27),
(68,	26),
(68,	28),
(66,	14),
(97,	34),
(100,	27),
(100,	26),
(100,	15),
(102,	60),
(102,	62),
(66,	27);

DROP VIEW IF EXISTS `heart_count`;
CREATE TABLE `heart_count` (`heartCount` bigint(21), `postID` int(10) unsigned);


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
('2014-08-15 21:22:11',	0,	'a.b@d.c',	'',	'a01fe2de2feeeddb1b65eb8977b2bb6e'),
('2014-08-15 21:23:47',	0,	'a.b@ds.c',	'',	'88b5dc62361adb04e2fed03b8ab71508'),
('2014-08-15 21:19:35',	0,	'a@b.c',	'',	'5d60d4e28066df254d5452f92c910092'),
('2014-08-14 03:07:35',	0,	'a@b.com',	'',	'357a20e8c56e69d6f9734d23ef9517e8'),
('2014-08-15 21:17:59',	0,	'a@d.d',	'',	'9c324dec396668e7a9c30ce0f5bfb12f'),
('0000-00-00 00:00:00',	0,	'a@hotmail.com',	'',	''),
('2014-08-15 21:17:28',	0,	'aa@b.c',	'',	'0e5657ccd8955cd81daeb8a787140d45'),
('2014-08-15 21:16:23',	0,	'aaaaa@bb.cc',	'',	'539ee12974b99a5b1d3c468a8fcd0dd6'),
('0000-00-00 00:00:00',	0,	'asasdas@fdsa.ca',	'',	'cf960a90c6da15c310090a56fc142a90'),
('0000-00-00 00:00:00',	0,	'asdads@dsa.dsa',	'',	'd016ba187918e7f68571b5c51e28021e'),
('2014-08-15 20:44:00',	0,	'asdfasfd@dafas.com',	'',	'b52fd36a1b76ad8c55ca7605f09a65b0'),
('0000-00-00 00:00:00',	0,	'caca@crotte.debic',	'',	'5c2005b0f97eeb8eaea22a9f1d968c9f'),
('2014-08-15 23:25:06',	0,	'dg2@gmail.com',	'',	'f9477e94c57505364cf420d4be8611b0'),
('2014-08-14 22:23:07',	0,	'dg@123email.com',	'',	'611cada59808de26405b1319bb46804a'),
('2014-07-27 19:59:40',	0,	'dg@asd.com',	'',	'f0141a5c5d7a8f8f25ef7e464a3bce91'),
('2014-08-12 02:56:24',	0,	'dmitri.grijalva@gmail.com',	'',	'98183fb04f67f9c76f68466da8c9dbc6'),
('0000-00-00 00:00:00',	0,	'douche@bag.yeah',	'',	'19a3fb0338554f65a74ca0712ed8af5b'),
('2014-08-13 01:10:10',	0,	'fearan@gmail.com',	'',	'bc29c6b02287b6475a6db4b642296dec'),
('2014-08-07 22:30:59',	0,	'geoff@geoff.com',	'',	'797371a189bc30516c212e4f33712def'),
('0000-00-00 00:00:00',	0,	'hnowrigvhw!@HGIOUDSA.GDA',	'',	'e16cde732d22b3a61aa51abe09df65bf'),
('0000-00-00 00:00:00',	0,	'Honert@buggies.net',	'',	'3d3250d6fdfb369d80a6a9b29444a76c'),
('0000-00-00 00:00:00',	0,	'Hornet@buggies.net',	'',	'202e19609fdf9ed773409daac2dc4d55'),
('0000-00-00 00:00:00',	0,	'je@suis.con',	'',	'13890b149a6b0907996fc0d2b798a24c'),
('0000-00-00 00:00:00',	0,	'je@suis.cool',	'',	'd7ddf9128dd052d0b01e65508c23d6be'),
('2014-08-16 13:03:06',	0,	'kk2@gmail.com',	'',	'ba27a0f4a788bc0d1becfba9c53d9c62'),
('2014-08-16 12:57:01',	0,	'kk@gmail.com',	'',	'089997d94e3b73aac3839d9543dd0ca2'),
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
  PRIMARY KEY (`clubID`,`userID`),
  KEY `FK_membership_user_idx` (`userID`),
  KEY `FK_membership_club_idx` (`clubID`),
  CONSTRAINT `FK_membership_club` FOREIGN KEY (`clubID`) REFERENCES `club` (`clubID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_membership_user` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `membership` (`clubID`, `userID`, `role`) VALUES
(1,	7,	'owner'),
(1,	68,	'member'),
(1,	98,	'member'),
(2,	66,	'member pending'),
(2,	68,	'member'),
(3,	66,	'member'),
(3,	98,	'member'),
(4,	97,	'member'),
(47,	98,	'member'),
(49,	98,	'member'),
(49,	102,	'member'),
(53,	98,	'member'),
(53,	102,	'member'),
(62,	98,	'member'),
(97,	12,	'owner'),
(98,	7,	'owner'),
(99,	7,	'member pending'),
(99,	66,	'owner'),
(101,	66,	'owner'),
(102,	66,	'owner'),
(103,	66,	'owner'),
(105,	66,	'owner'),
(106,	66,	'owner'),
(107,	66,	'owner'),
(108,	98,	'owner');

DROP VIEW IF EXISTS `newsfeed`;
CREATE TABLE `newsfeed` (`postID` int(11) unsigned, `timeCreated` datetime, `isComment` tinyint(4) unsigned, `type` varchar(5), `text` text, `displayName` varchar(15), `userID` int(11) unsigned, `firstName` varchar(45), `lastName` varchar(45), `heartCount` bigint(21));


DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `postID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `timeCreated` datetime NOT NULL,
  `isComment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allowsComments` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`postID`),
  KEY `FK_post_user_idx` (`userID`),
  CONSTRAINT `post_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION
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
(20,	68,	'2014-08-11 04:08:15',	0,	1),
(21,	68,	'2014-08-11 16:08:46',	1,	1),
(22,	68,	'2014-08-11 16:08:55',	1,	1),
(23,	68,	'2014-08-11 16:08:23',	1,	1),
(24,	68,	'2014-08-11 16:08:01',	1,	1),
(25,	68,	'2014-08-11 16:08:23',	1,	1),
(26,	66,	'2014-08-11 23:08:24',	0,	1),
(27,	66,	'2014-08-11 23:08:13',	0,	1),
(28,	68,	'2014-08-12 05:08:53',	0,	1),
(29,	68,	'2014-08-12 06:08:36',	0,	1),
(30,	68,	'2014-08-13 00:08:05',	1,	1),
(33,	97,	'2014-08-14 03:08:00',	0,	1),
(34,	97,	'2014-08-16 01:08:46',	0,	1),
(40,	98,	'2014-08-15 19:08:57',	0,	1),
(41,	98,	'2014-08-15 19:08:39',	0,	1),
(42,	98,	'2014-08-16 03:08:28',	0,	1),
(43,	98,	'2014-08-16 03:08:43',	0,	1),
(45,	100,	'2014-08-16 05:08:44',	1,	1),
(47,	98,	'2014-08-16 12:08:57',	0,	1),
(48,	98,	'2014-08-16 14:08:45',	0,	1),
(49,	98,	'2014-08-16 15:08:44',	0,	1),
(50,	102,	'2014-08-16 15:08:55',	0,	1),
(51,	98,	'2014-08-16 15:08:40',	1,	1),
(52,	102,	'2014-08-16 15:08:09',	0,	1),
(53,	102,	'2014-08-16 15:08:17',	0,	1),
(54,	98,	'2014-08-16 15:08:36',	0,	1),
(55,	102,	'2014-08-16 15:08:18',	0,	1),
(56,	102,	'2014-08-16 15:08:30',	0,	1),
(57,	102,	'2014-08-16 15:08:21',	0,	1),
(58,	102,	'2014-08-16 15:08:09',	0,	1),
(59,	102,	'2014-08-16 15:08:24',	0,	1),
(60,	102,	'2014-08-16 15:08:31',	0,	1),
(61,	102,	'2014-08-16 15:08:50',	0,	1),
(62,	102,	'2014-08-16 15:08:12',	0,	1),
(63,	102,	'2014-08-16 15:08:36',	0,	1),
(64,	98,	'2014-08-16 07:08:36',	0,	1),
(65,	102,	'2014-08-16 16:08:58',	0,	1),
(66,	102,	'2014-08-16 16:08:23',	1,	1),
(67,	90,	'2014-08-16 16:08:37',	0,	1);

DROP VIEW IF EXISTS `post_heart_count`;
CREATE TABLE `post_heart_count` (`postID` int(10) unsigned, `heartCount` bigint(21));


DROP TABLE IF EXISTS `privateMessages`;
CREATE TABLE `privateMessages` (
  `messageID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `postID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`messageID`),
  KEY `FK_convoMap_user_idx` (`userID`),
  KEY `convo_idx` (`messageID`),
  KEY `FK_privateMsg_post_idx` (`postID`),
  CONSTRAINT `FK_convoMap_user` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_privateMsg_post` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE CASCADE ON UPDATE NO ACTION
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
(11,	97,	33),
(12,	98,	33),
(13,	66,	33),
(14,	68,	33),
(15,	90,	33),
(16,	98,	48),
(17,	66,	48),
(18,	11,	48),
(19,	102,	50),
(20,	98,	50),
(21,	98,	54),
(22,	102,	54);

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
(66,	39,	'friends'),
(66,	39,	'friends'),
(66,	39,	'friends'),
(66,	9,	'friends'),
(68,	7,	'friends'),
(68,	10,	'friends'),
(68,	66,	'collegues'),
(11,	66,	'collegues'),
(66,	11,	'friends'),
(66,	7,	'friends'),
(66,	7,	'friends'),
(66,	7,	'friends'),
(7,	66,	'collegues'),
(7,	66,	'collegues'),
(66,	7,	'collegues'),
(98,	66,	'collegues'),
(98,	66,	'collegues'),
(98,	66,	'collegues'),
(66,	98,	'friends'),
(66,	98,	'family'),
(66,	98,	'collegues'),
(97,	98,	'collegues'),
(97,	66,	'collegues'),
(97,	68,	'friends'),
(85,	68,	'friends'),
(85,	97,	'friends'),
(85,	66,	'family'),
(97,	90,	'family pending'),
(97,	90,	'collegues pending'),
(97,	90,	'friends pending'),
(66,	10,	'friends pending'),
(66,	10,	'family pending'),
(66,	10,	'collegues pending'),
(66,	85,	'family'),
(97,	99,	'friends pending'),
(97,	100,	'friends'),
(100,	97,	'friends'),
(98,	11,	'friends pending'),
(102,	7,	'friends pending'),
(102,	7,	'family pending'),
(102,	98,	'friends'),
(102,	98,	'family'),
(98,	102,	'friends'),
(98,	102,	'family'),
(38,	66,	'friends pending'),
(97,	10,	'family pending');

DROP TABLE IF EXISTS `roleChangeRequests`;
CREATE TABLE `roleChangeRequests` (
  `userID` int(10) unsigned NOT NULL,
  `requested_role` enum('senior','administrator') NOT NULL,
  `answer` enum('pending','accepted','denied') NOT NULL DEFAULT 'pending',
  KEY `userID` (`userID`),
  CONSTRAINT `roleChangeRequests_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `roleChangeRequests` (`userID`, `requested_role`, `answer`) VALUES
(66,	'senior',	'accepted'),
(8,	'senior',	'denied'),
(9,	'senior',	'accepted'),
(10,	'senior',	'pending'),
(11,	'senior',	'pending'),
(39,	'administrator',	'pending'),
(64,	'administrator',	'pending'),
(66,	'administrator',	'accepted'),
(97,	'senior',	'pending'),
(68,	'senior',	'pending');

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
  `profilePhoto` varchar(300) DEFAULT 'profile.png',
  `usercol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `displayName_UNIQUE` (`displayName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`userID`, `role`, `status`, `displayName`, `firstName`, `lastName`, `tagline`, `email`, `password`, `address`, `cityName`, `province`, `country`, `availableHearts`, `totalHeartsEarned`, `dateCreated`, `dateModified`, `lastLogin`, `currentLogin`, `dateOfBirth`, `privacy`, `lastStream`, `profilePhoto`, `usercol`) VALUES
(7,	'administrator',	'active',	'marcb',	'Marc',	'B',	'Some guy',	'belley.marc@gmail.com',	'202cb962ac59075b964b07152d234b70',	'4321 rue st-jacques apt 204',	'Montreal',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	'',	'profile.png',	NULL),
(8,	'junior',	'active',	'8',	'Bob',	'Joy',	'',	'bob@jay.com',	'827ccb0eea8a706c4c34a16891f84e7b',	'',	'NYC',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	'',	'profile.png',	NULL),
(9,	'senior',	'active',	'9',	'Chuck',	'Norris',	'who needs one?',	'justplainawesome@internets.com',	'e10adc3949ba59abbe56e057f20f883e',	'1337',	'Texas',	'texas',	'0',	9001,	0,	'2014-06-26 22:00:21',	'2014-06-26 22:00:21',	'2014-06-26 22:00:21',	'0000-00-00 00:00:00',	'2014-06-26',	'public',	'',	'profile.png',	NULL),
(10,	'junior',	'active',	'10',	'Prof',	'Bipin',	'real life',	'bipin@concordia.ca',	'e10adc3949ba59abbe56e057f20f883e',	'lame',	'Montreal',	'Quebec',	'0',	0,	0,	'2014-06-26 22:02:02',	'2014-06-26 22:02:02',	'2014-06-26 22:02:02',	'0000-00-00 00:00:00',	'2014-06-26',	'public',	'',	'profile.png',	NULL),
(11,	'junior',	'active',	'11',	'Smartass',	'Student',	'school sux',	'student@concordia.ca',	'e10adc3949ba59abbe56e057f20f883e',	'111 de la blah',	'Montreal',	'Quebec',	'0',	0,	0,	'2014-06-26 22:02:51',	'2014-06-26 22:02:51',	'2014-06-26 22:02:51',	'0000-00-00 00:00:00',	'2014-06-26',	'public',	'',	'profile.png',	NULL),
(12,	'senior',	'active',	'12',	'Johnny',	'Doo',	'',	'johnywoppy@hotmail.com',	'd79096188b670c2f81b7001f73801117',	'',	'',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	'',	'profile.png',	NULL),
(38,	'junior',	'active',	'38',	'Sandra',	'Buttocks',	'',	'sandritasexy1234@sexyemail.com',	'81dc9bdb52d04dc20036dbd8313ed055',	'',	'',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	'',	'profile.png',	NULL),
(39,	'administrator',	'inactive',	'39',	'Andrea',	'Gan',	'',	'andypandy@hotmail.com',	'1e626dd31cdb460d8b46f12cca396d26',	'',	'',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'2014-08-15 19:11:12',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	'',	'profile.png',	NULL),
(44,	'junior',	'active',	'44',	'Diego',	'Sanchez',	'',	'sanchy@shooo.com',	'827ccb0eea8a706c4c34a16891f84e7b',	'',	'',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	'',	'profile.png',	NULL),
(45,	'junior',	'active',	'45',	'Woopie',	'Yaya',	'',	'woopie1234@asd.com',	'81dc9bdb52d04dc20036dbd8313ed055',	'',	'',	NULL,	'0',	0,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	'',	'profile.png',	NULL),
(64,	'senior',	'inactive',	'asd',	'Nelson',	'Mondonla',	'zxc',	'asd@asd.com',	'827ccb0eea8a706c4c34a16891f84e7b',	'asd',	'asd',	'asd',	'0',	0,	0,	'2014-07-06 06:11:47',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2014-07-09',	'public',	'',	'profile.png',	NULL),
(66,	'administrator',	'active',	'mikeb',	'Michael',	'Burkat',	'yo',	'mike.burkat@gmail.com',	'e10adc3949ba59abbe56e057f20f883e',	'11207 79th ave NW',	'Edmonton',	'Alberta',	'',	0,	0,	'2014-07-06 14:38:52',	'2014-08-15 17:11:45',	'0000-00-00 00:00:00',	'2014-08-16 08:48:35',	'1987-08-17',	'',	'',	'profile.png',	NULL),
(68,	'junior',	'active',	'geoff',	'Geoff',	'Stan',	'yup',	'geoffrey.stanley@gmail.com',	'202cb962ac59075b964b07152d234b70',	'11',	'mtl',	'qc',	'1',	1,	2,	'2014-07-07 01:10:58',	'2014-07-07 01:10:58',	'2014-07-07 01:10:58',	'0000-00-00 00:00:00',	'2014-07-07',	'public',	'',	'profile.png',	NULL),
(69,	'administrator',	'active',	'dg',	'Pepe',	'Lepoux',	'Mon amour',	'pepe@warner.com',	'e10adc3949ba59abbe56e057f20f883e',	'asdf',	'asdasd',	'asdasd',	'',	0,	0,	'2014-07-07 11:07:49',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2014-07-02',	'public',	'https://www.youtube.com/watch?v=-KKvIg9d0Kw',	'profile.png',	NULL),
(85,	'administrator',	'inactive',	'blah',	'Das',	'Lol',	'im cool',	'fa.negrete@gmail.com',	'e10adc3949ba59abbe56e057f20f883e',	'3838kdfk here',	'Montreal',	'Quebec',	'Canada',	0,	0,	'2014-07-18 17:00:25',	'2014-08-14 18:00:47',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'private',	'',	'profile.png',	NULL),
(88,	'junior',	'active',	'123',	'Chip',	'Fooz',	'Cars',	'abracadabra@fab.com',	'e10adc3949ba59abbe56e057f20f883e',	'123',	'123',	'123',	'123',	0,	0,	'2014-07-19 12:31:59',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0023-12-31',	'public',	'',	'profile.png',	NULL),
(89,	'senior',	'inactive',	'huoisegad',	'Mandy',	'More',	'Not more',	'mandy@caosnd.com',	'e10adc3949ba59abbe56e057f20f883e',	'asfdn',	'123',	'123',	'123',	0,	0,	'2014-07-19 12:32:58',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0123-12-03',	'public',	'',	'profile.png',	NULL),
(90,	'junior',	'active',	'Thomas',	'Thomas',	'Tige',	'I am awesome',	'thomastige@gmail.com',	'e10adc3949ba59abbe56e057f20f883e',	'123',	'Montreal',	'Quebec',	'Canada',	0,	0,	'2014-07-19 15:26:42',	'0000-00-00 00:00:00',	'2014-08-16 10:39:43',	'2014-08-16 10:40:14',	'1990-06-25',	'public',	'',	'profile.png',	NULL),
(93,	'senior',	'active',	'jkbhb',	'Hans',	'Alone',	'Im very solo',	'alone@starwars.com',	'e10adc3949ba59abbe56e057f20f883e',	'1234',	'1234',	'1234',	'1234',	0,	0,	'2014-07-27 11:20:56',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00',	'public',	'',	'profile.png',	NULL),
(97,	'administrator',	'active',	'Dmitri',	'Dmitri',	'Grijalva',	'Tagline',	'dmitri.grijalva@gmail.com',	'e10adc3949ba59abbe56e057f20f883e',	'ggggg',	'aa',	'aa',	'ggg',	0,	0,	'2014-08-11 23:00:15',	'2014-08-16 13:45:31',	'2014-08-16 13:47:03',	'2014-08-16 13:47:48',	'2014-07-15',	'private',	'',	'uploads/4041.jpg',	NULL),
(98,	'administrator',	'active',	'SpaceSteak',	'M',	'B',	'yo',	'fearan@gmail.com',	'e10adc3949ba59abbe56e057f20f883e',	'4321 rue st-jacques apt 204',	'Montreal',	'QC - Quebec',	'Canada',	0,	0,	'2014-08-12 21:11:20',	'2014-08-15 17:16:11',	'2014-08-16 12:27:42',	'2014-08-16 13:19:12',	'2014-08-07',	'',	'',	'profile.png',	NULL),
(99,	'junior',	'active',	'Display',	'D',	'G',	'Tagline',	'a@b.com',	'e10adc3949ba59abbe56e057f20f883e',	'ASD',	'City',	'QC',	'Canada',	0,	0,	'2014-08-13 23:09:20',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2014-08-21',	'public',	'',	'profile.png',	NULL),
(100,	'junior',	'active',	'MyOtherAccount',	'DG',	'DG',	'Hi',	'dg2@gmail.com',	'81dc9bdb52d04dc20036dbd8313ed055',	'123',	'123',	'123',	'123',	0,	0,	'2014-08-15 19:25:57',	'2014-08-16 00:18:09',	'0000-00-00 00:00:00',	'2014-08-16 00:55:29',	'2014-08-11',	'public',	'',	'uploads/beer2.png',	NULL),
(101,	'junior',	'active',	'kk123',	'k',	'k',	'testing invites',	'kk1@gmail.com',	'e10adc3949ba59abbe56e057f20f883e',	'kk',	'kk',	'kk',	'kk',	0,	0,	'2014-08-16 09:02:02',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'0020-01-01',	'public',	'',	'profile.png',	NULL),
(102,	'junior',	'active',	'kk2',	'kk2',	'kk2',	'kk',	'kk2@gmail.com',	'e10adc3949ba59abbe56e057f20f883e',	'kk',	'kk',	'kk',	'kk',	0,	0,	'2014-08-16 09:03:29',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'2014-08-16 09:05:04',	'0001-01-01',	'public',	'',	'profile.png',	NULL);

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
(66,	27,	0),
(7,	29,	0),
(97,	34,	0),
(98,	40,	0),
(98,	41,	0),
(98,	42,	0),
(98,	43,	0),
(102,	52,	0),
(102,	53,	0),
(98,	63,	0),
(98,	64,	0),
(102,	65,	0),
(90,	67,	0);

DROP VIEW IF EXISTS `userwall_newsfeed`;
CREATE TABLE `userwall_newsfeed` (`postID` int(10) unsigned, `timeCreated` datetime, `isComment` tinyint(1) unsigned, `type` enum('TEXT','IMAGE','VIDEO'), `text` text, `displayName` varchar(15), `userID` int(10) unsigned, `firstName` varchar(45), `LastName` varchar(45), `heartCount` bigint(21));


DROP TABLE IF EXISTS `group_newsfeed`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `group_newsfeed` AS select `post`.`postID` AS `postID`,`post`.`timeCreated` AS `timeCreated`,`post`.`isComment` AS `isComment`,`content`.`type` AS `type`,`content`.`text` AS `text`,`user`.`displayName` AS `displayName`,`user`.`userID` AS `userID`,`user`.`firstName` AS `firstName`,`user`.`lastName` AS `lastName`,`hearts`.`heartCount` AS `heartCount` from (((((`post` join `membership`) join `clubWall`) join `content`) join `user`) join `post_heart_count` `hearts`) where ((`post`.`userID` = `membership`.`userID`) and (`post`.`postID` = `clubWall`.`postID`) and (`membership`.`clubID` = `clubWall`.`clubID`) and (`post`.`postID` = `content`.`postID`) and (`post`.`userID` = `user`.`userID`) and (`post`.`postID` = `hearts`.`postID`)) order by `hearts`.`heartCount` desc;

DROP TABLE IF EXISTS `heart_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `heart_count` AS select count(`hearts`.`postID`) AS `heartCount`,`hearts`.`postID` AS `postID` from `hearts` group by `hearts`.`postID`;

DROP TABLE IF EXISTS `newsfeed`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `newsfeed` AS select `group_newsfeed`.`postID` AS `postID`,`group_newsfeed`.`timeCreated` AS `timeCreated`,`group_newsfeed`.`isComment` AS `isComment`,`group_newsfeed`.`type` AS `type`,`group_newsfeed`.`text` AS `text`,`group_newsfeed`.`displayName` AS `displayName`,`group_newsfeed`.`userID` AS `userID`,`group_newsfeed`.`firstName` AS `firstName`,`group_newsfeed`.`lastName` AS `lastName`,`group_newsfeed`.`heartCount` AS `heartCount` from `group_newsfeed` union select `userwall_newsfeed`.`postID` AS `postID`,`userwall_newsfeed`.`timeCreated` AS `timeCreated`,`userwall_newsfeed`.`isComment` AS `isComment`,`userwall_newsfeed`.`type` AS `type`,`userwall_newsfeed`.`text` AS `text`,`userwall_newsfeed`.`displayName` AS `displayName`,`userwall_newsfeed`.`userID` AS `userID`,`userwall_newsfeed`.`firstName` AS `firstName`,`userwall_newsfeed`.`LastName` AS `LastName`,`userwall_newsfeed`.`heartCount` AS `heartCount` from `userwall_newsfeed` order by `heartCount` desc;

DROP TABLE IF EXISTS `post_heart_count`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `post_heart_count` AS select `post`.`postID` AS `postID`,coalesce(`h`.`heartCount`,0) AS `heartCount` from (`post` left join `heart_count` `h` on((`post`.`postID` = `h`.`postID`)));

DROP TABLE IF EXISTS `userwall_newsfeed`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `userwall_newsfeed` AS select `post`.`postID` AS `postID`,`post`.`timeCreated` AS `timeCreated`,`post`.`isComment` AS `isComment`,`content`.`type` AS `type`,`content`.`text` AS `text`,`user`.`displayName` AS `displayName`,`user`.`userID` AS `userID`,`user`.`firstName` AS `firstName`,`user`.`lastName` AS `LastName`,`hearts`.`heartCount` AS `heartCount` from ((((`post` join `userWall`) join `user`) join `content`) join `post_heart_count` `hearts`) where ((`post`.`postID` = `userWall`.`postID`) and (`post`.`postID` = `content`.`postID`) and (`post`.`userID` = `user`.`userID`) and (`post`.`postID` = `hearts`.`postID`)) order by `hearts`.`heartCount` desc;

-- 2014-08-16 17:53:42
