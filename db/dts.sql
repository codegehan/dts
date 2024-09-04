/*
 Navicat Premium Data Transfer

 Source Server         : workbench_3308
 Source Server Type    : MySQL
 Source Server Version : 80035 (8.0.35)
 Source Host           : localhost:3308
 Source Schema         : dts

 Target Server Type    : MySQL
 Target Server Version : 80035 (8.0.35)
 File Encoding         : 65001

 Date: 04/09/2024 10:59:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for campus
-- ----------------------------
DROP TABLE IF EXISTS `campus`;
CREATE TABLE `campus`  (
  `campusdes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `campuscode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `campusno` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`campusno`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of campus
-- ----------------------------
INSERT INTO `campus` VALUES ('dapitan campus - main', 'dap', 1);
INSERT INTO `campus` VALUES ('dipolog campus', 'dip', 2);
INSERT INTO `campus` VALUES ('katipunan campus', 'katp', 3);
INSERT INTO `campus` VALUES ('tampilisan campus', 'tamp', 4);
INSERT INTO `campus` VALUES ('siocon campus', 'sioc', 5);
INSERT INTO `campus` VALUES ('sibuco-ext campus', 'sibc', 6);

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department`  (
  `idno` int NOT NULL AUTO_INCREMENT,
  `desc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `code` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idno`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 85 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES (43, 'CAS', 'CAS');
INSERT INTO `department` VALUES (44, 'CBA', 'CBA');
INSERT INTO `department` VALUES (45, 'CNAHS', 'CNAHS');
INSERT INTO `department` VALUES (46, 'COE', 'COE');
INSERT INTO `department` VALUES (47, 'CME', 'CME');
INSERT INTO `department` VALUES (48, 'GRADUATE STUDIES', 'GRAD');
INSERT INTO `department` VALUES (49, 'CJD', 'CJD');
INSERT INTO `department` VALUES (50, 'CCJE', 'CCJE');
INSERT INTO `department` VALUES (51, 'ADMINISTRATION', 'ADMI');
INSERT INTO `department` VALUES (52, 'RESEARCH', 'RESE');
INSERT INTO `department` VALUES (53, 'EXTENSION', 'EXTE');
INSERT INTO `department` VALUES (54, 'SECURITY', 'SECU');
INSERT INTO `department` VALUES (55, 'GSO', 'GSO');
INSERT INTO `department` VALUES (56, 'UDRRMO', 'UDRR');
INSERT INTO `department` VALUES (57, 'MISO', 'MISO');
INSERT INTO `department` VALUES (58, 'QAC', 'QAC');
INSERT INTO `department` VALUES (59, 'IMD', 'IMD');
INSERT INTO `department` VALUES (60, 'COMPUTER LABORATORY', 'COMP');
INSERT INTO `department` VALUES (61, 'FAB LABORATORY', 'FAB');
INSERT INTO `department` VALUES (62, 'NATSCI LABORATORY', 'NATS');
INSERT INTO `department` VALUES (63, 'GENSCI LABORATORY', 'GENS');
INSERT INTO `department` VALUES (64, 'CME LABORATORY', 'CME');
INSERT INTO `department` VALUES (65, 'UNIVERSITY LIBRARY', 'ULIB');
INSERT INTO `department` VALUES (66, 'CNAHS LABORATORY', 'CNLAB');
INSERT INTO `department` VALUES (67, 'JUNIOR HIGH SCHOOL', 'JUNI');
INSERT INTO `department` VALUES (68, 'GUIDANCE', 'GDS');
INSERT INTO `department` VALUES (69, 'FLS', 'FLS');
INSERT INTO `department` VALUES (70, 'i18N', 'i18N');
INSERT INTO `department` VALUES (71, 'RECORD OFFICE', 'RECO');
INSERT INTO `department` VALUES (72, 'DSAS', 'DSAS');
INSERT INTO `department` VALUES (73, 'KTTO', 'KTTO');
INSERT INTO `department` VALUES (74, 'LMS', 'LMS');
INSERT INTO `department` VALUES (75, 'PESA', 'PESA');
INSERT INTO `department` VALUES (76, 'GAD', 'GAD');
INSERT INTO `department` VALUES (77, 'TESDA', 'TESD');
INSERT INTO `department` VALUES (78, 'CAO', 'CAO');
INSERT INTO `department` VALUES (79, 'CCS', 'CCS');
INSERT INTO `department` VALUES (80, 'CBA-SSG-SMM', 'CBASGSM');
INSERT INTO `department` VALUES (81, 'LUNDAYAN', 'LUN');
INSERT INTO `department` VALUES (82, 'University Registrar', 'UREG');
INSERT INTO `department` VALUES (83, 'OFFICE OF THE PRESIDENT', 'OOTP');
INSERT INTO `department` VALUES (84, 'CULTURAL AND SPORTS', 'CULT');

-- ----------------------------
-- Table structure for documentitem
-- ----------------------------
DROP TABLE IF EXISTS `documentitem`;
CREATE TABLE `documentitem`  (
  `doc_no` int NOT NULL AUTO_INCREMENT,
  `transactioncode` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `officer` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `docdescription` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `docpurpose` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `officeinvolved` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `urgencylevel` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` tinyint NULL DEFAULT 5,
  `approveddate` datetime NULL DEFAULT NULL,
  `approvedby` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dateadded` datetime NULL DEFAULT NULL,
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`doc_no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of documentitem
-- ----------------------------

-- ----------------------------
-- Table structure for documentitemdetails
-- ----------------------------
DROP TABLE IF EXISTS `documentitemdetails`;
CREATE TABLE `documentitemdetails`  (
  `no` int NOT NULL AUTO_INCREMENT,
  `forwardedto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` tinyint NULL DEFAULT 5,
  `note` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'RECEIVED',
  `enteredby` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `office_validated` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `entereddate` datetime NULL DEFAULT NULL,
  `trans_code` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `islatest` tinyint NULL DEFAULT 1,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of documentitemdetails
-- ----------------------------

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee`  (
  `userno` int NOT NULL AUTO_INCREMENT,
  `usercode` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fullname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `office` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phonenumber` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dateadded` datetime NULL DEFAULT NULL,
  `addedby` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dateupdated` datetime NULL DEFAULT NULL,
  `updatedby` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `authorizationdetails` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `apikeyexpiration` date NULL DEFAULT NULL,
  `password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `issecured` tinyint NULL DEFAULT 0,
  `campus` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `otp` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `verified` tinyint NULL DEFAULT NULL,
  `verifieddate` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`userno`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES (1, 'CAS-0871-01', 'admininstrator', 'administrator', 'admin@admin.com', '09876543212', '2024-04-10 09:39:44', 'admin', NULL, NULL, NULL, NULL, '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, 'dapitan campus - main', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for signrecord
-- ----------------------------
DROP TABLE IF EXISTS `signrecord`;
CREATE TABLE `signrecord`  (
  `no` int NOT NULL AUTO_INCREMENT,
  `sign_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dateadded` datetime NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of signrecord
-- ----------------------------
INSERT INTO `signrecord` VALUES (1, '090324052026', NULL);
INSERT INTO `signrecord` VALUES (2, '090324052958', NULL);
INSERT INTO `signrecord` VALUES (3, '090324053006', '2024-09-03 11:30:47');

-- ----------------------------
-- Table structure for statusdefinition
-- ----------------------------
DROP TABLE IF EXISTS `statusdefinition`;
CREATE TABLE `statusdefinition`  (
  `description` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `code` tinyint NOT NULL,
  PRIMARY KEY (`code`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of statusdefinition
-- ----------------------------
INSERT INTO `statusdefinition` VALUES ('declined', 0);
INSERT INTO `statusdefinition` VALUES ('approved', 1);
INSERT INTO `statusdefinition` VALUES ('in-progress', 2);
INSERT INTO `statusdefinition` VALUES ('on-hold', 3);
INSERT INTO `statusdefinition` VALUES ('waiting', 4);
INSERT INTO `statusdefinition` VALUES ('pending', 5);
INSERT INTO `statusdefinition` VALUES ('returned', 6);
INSERT INTO `statusdefinition` VALUES ('complete', 10);

-- ----------------------------
-- Table structure for urgencydefinition
-- ----------------------------
DROP TABLE IF EXISTS `urgencydefinition`;
CREATE TABLE `urgencydefinition`  (
  `code` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of urgencydefinition
-- ----------------------------
INSERT INTO `urgencydefinition` VALUES (1, 'urgent-important');
INSERT INTO `urgencydefinition` VALUES (2, 'urgent - not important');
INSERT INTO `urgencydefinition` VALUES (3, 'not urgent - important');
INSERT INTO `urgencydefinition` VALUES (4, 'not urgent - not important');

-- ----------------------------
-- Procedure structure for accountinfo
-- ----------------------------
DROP PROCEDURE IF EXISTS `accountinfo`;
delimiter ;;
CREATE PROCEDURE `accountinfo`(IN jsonData LONGTEXT)
BEGIN
	DECLARE _statusmsg LONGTEXT;
	DECLARE _statusno TINYINT;
	DECLARE _userCode VARCHAR(30) DEFAULT JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.userCode'));
	DECLARE _accountInfo LONGTEXT;
	SELECT JSON_OBJECT(
			'usercode', usercode,
			'fullname', fullname,
			'office', office,
			'campus', campus,
			'email', email,
			'authorizationdetails', authorizationdetails,
			'apikeyexpiration', apikeyexpiration,
			'campus', campus,
			'verified', verified,
			'issecured', issecured
		) INTO _accountInfo
		FROM `employee`
		WHERE usercode = _userCode;
	SET _statusmsg = _accountInfo;
	SET _statusno = 1;
	SELECT _statusmsg as `result`, _statusno as statuscode;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for changepassword
-- ----------------------------
DROP PROCEDURE IF EXISTS `changepassword`;
delimiter ;;
CREATE PROCEDURE `changepassword`(IN jsonData LONGTEXT)
BEGIN
	DECLARE _statusmsg VARCHAR(100);
	DECLARE _statusno TINYINT;
	
	DECLARE _user VARCHAR(20) DEFAULT TRIM(getvalue(jsonData, '$.userCode'));
	DECLARE _oldP VARCHAR(10) DEFAULT TRIM(JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.oldPassword')));
	DECLARE _newP VARCHAR(10) DEFAULT TRIM(JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.newPassword')));
	DECLARE _confirmP VARCHAR(10) DEFAULT TRIM(JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.confirmPassword')));
	
-- 	select _user,_oldP,_newP,_confirmP;
	IF EXISTS (SELECT 1 FROM employee WHERE usercode = _user AND `password` = SHA2(_oldP, 256)) THEN
		UPDATE employee SET `password` = SHA2(_newP, 256), issecured = 1 WHERE usercode = _user;
		SET _statusmsg = "Password changed!";
		SET _statusno = 1;
	ELSE
		SET _statusmsg = "Old password not matched!";
		SET _statusno = 0;
	END IF;
	SELECT _statusmsg AS result, _statusno AS statuscode;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for document_incoming_validate
-- ----------------------------
DROP PROCEDURE IF EXISTS `document_incoming_validate`;
delimiter ;;
CREATE PROCEDURE `document_incoming_validate`(IN jsonData LONGTEXT)
BEGIN
    -- Declare
    DECLARE _statusmsg LONGTEXT DEFAULT "Not Found";
    DECLARE _statusno SMALLINT DEFAULT 0;
    
    DECLARE _transactioncode CHAR(30);
    DECLARE _approvedstatus TINYINT;
    DECLARE _approvedby CHAR(30);
    DECLARE _approvingoffice CHAR(30);
    DECLARE _approveddate DATETIME DEFAULT CURRENT_TIMESTAMP();
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SET _statusmsg = "Database Error: Error transaction.";
        SET _statusno = 0;
        SELECT _statusmsg AS result, _statusno AS statuscode;
    END;
    
    SET _transactioncode = getvalue(jsonData, '$.transactioncode');
    SET _approvedstatus = getvalue(jsonData, '$.approvedstatus');
    SET _approvedby = getvalue(jsonData, '$.user');
    SET _approvingoffice = getvalue(jsonData, '$.office');
    
    SET @jsonSchema = '{
        "type": "object",
        "properties": {
            "transactioncode": { "type": "string" },
            "approvedstatus": { "type": "number" }
        },
        "required": ["transactioncode", "approvedstatus"]
    }';
    
    START TRANSACTION;
    IF JSON_SCHEMA_VALID(@jsonSchema, jsonData) = 0 THEN
        SET _statusmsg = "DB Error: Entries not valid";
        SET _statusno = 0;
    END IF;
    
    IF EXISTS(SELECT 1 FROM documentitem WHERE transactioncode = _transactioncode) THEN
        SET @sql = CONCAT('UPDATE documentitem 
            SET status = ', _approvedstatus, ', 
                approvedby = ''', _approvedby, ''', 
                approveddate = ''', _approveddate, ''' 
            WHERE transactioncode = ''', _transactioncode, '''');
        PREPARE stmt FROM @sql;
        EXECUTE stmt;
        DEALLOCATE PREPARE stmt;
				
				SET @sql = CONCAT('UPDATE documentitemdetails SET islatest = 0 
														WHERE trans_code = ''',_transactioncode,'''');
				PREPARE stmt FROM @sql;
				EXECUTE stmt;
				DEALLOCATE PREPARE stmt;									
				
				SET @sql = CONCAT('INSERT INTO documentitemdetails (forwardedto, status,
														enteredby,entereddate, trans_code, islatest) 
													 VALUES (''',_approvingoffice,''',',_approvedstatus,',
													 ''',_approvedby,''',''',_approveddate,''',
													 ''',_transactioncode,''',1)');
				PREPARE stmt FROM @sql;
				EXECUTE stmt;
				DEALLOCATE PREPARE stmt;
													 
				SET _statusmsg = "Document validated!";
				SET _statusno = 1;
    END IF;
    
    COMMIT;
    SELECT _statusmsg AS result, _statusno AS statuscode;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getcampus
-- ----------------------------
DROP PROCEDURE IF EXISTS `getcampus`;
delimiter ;;
CREATE PROCEDURE `getcampus`()
BEGIN
	SELECT campusno,`campusdes`,`campuscode` FROM campus;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getdashboarddetails
-- ----------------------------
DROP PROCEDURE IF EXISTS `getdashboarddetails`;
delimiter ;;
CREATE PROCEDURE `getdashboarddetails`(IN jsonData LONGTEXT)
BEGIN
	

	DECLARE _officer VARCHAR(50);
	DECLARE _officeAssign VARCHAR(100);
	SET _officer = getvalue(jsonData, '$.officer');
	SET _officeAssign = getvalue(jsonData, '$.officeAssign');

	SELECT COUNT(*) INTO @pending 
	FROM documentitem 
	WHERE `status` = 5 
	AND officer = _officer;
	
	SELECT COUNT(*) INTO @incoming 
	FROM documentitemdetails 
	LEFT JOIN documentitem ON documentitemdetails.trans_code = documentitem.transactioncode
	WHERE forwardedto = _officeAssign
	AND documentitem.`status` = 5 AND documentitemdetails.islatest = 1;
	
	SELECT COUNT(*) INTO @received
	FROM documentitemdetails
	JOIN documentitem ON documentitemdetails.trans_code = documentitem.transactioncode
	WHERE documentitem.`status` < 5 AND documentitem.`status` > 1 
	AND documentitemdetails.forwardedto = _officeAssign
	AND documentitemdetails.islatest = 1;
	
	SELECT COUNT(*) INTO @outgoing
	FROM documentitem
	WHERE `status` = 2  OR `status` = 3 OR `status` = 4 AND officer = _officer;
	
	
	SELECT JSON_OBJECT(
		'pending', @pending,
		'incoming', @incoming,
		'received', @received,
		'outgoing', @outgoing
	) INTO @dashboard;
	
	SET @statusno = 1;
	SET @statusmsg = @dashboard;
	SELECT @statusmsg as `result`, @statusno as statuscode;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getdocumentdetails
-- ----------------------------
DROP PROCEDURE IF EXISTS `getdocumentdetails`;
delimiter ;;
CREATE PROCEDURE `getdocumentdetails`(IN _tcode VARCHAR(50))
BEGIN
	SET @sql = CONCAT('
							SELECT
								di.transactioncode,
								UPPER(emp.fullname) as action_officer,
								UPPER(emp.email) as officer_email,
								di.docdescription,
								di.docpurpose,
								di.officeinvolved,
								di.urgencylevel,
								UPPER(sd.description) as status,
								di.approvedby,
								di.approveddate,
								di.filename
							FROM documentitem di
							LEFT JOIN employee emp ON di.officer = emp.usercode
							LEFT JOIN statusdefinition sd ON di.`status` = sd.code
							WHERE di.transactioncode = ''',_tcode,'''');
	PREPARE stmt FROM @sql;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getdocumentprogress
-- ----------------------------
DROP PROCEDURE IF EXISTS `getdocumentprogress`;
delimiter ;;
CREATE PROCEDURE `getdocumentprogress`(IN _tcode VARCHAR(50))
BEGIN
	SET @sql = CONCAT('
										SELECT
											dp.desc as forwarded_to,
											UPPER(sd.description) as description,
											UPPER(did.note) as note,
											did.entereddate
										FROM documentitemdetails did
										LEFT JOIN department dp ON did.forwardedto = dp.code
										LEFT JOIN statusdefinition sd ON did.status = sd.code
										WHERE trans_code = ''',_tcode,'''
										ORDER BY did.entereddate DESC');
	PREPARE stmt FROM @sql;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getdocument_completed
-- ----------------------------
DROP PROCEDURE IF EXISTS `getdocument_completed`;
delimiter ;;
CREATE PROCEDURE `getdocument_completed`(IN _actionOfficer VARCHAR(30))
BEGIN
	SELECT 
		di.doc_no,
		di.transactioncode,
		UPPER(emp.fullname) AS officer,
		di.docdescription,
		di.docpurpose,
		di.officeinvolved,
		di.urgencylevel,
		UPPER(stat.`description`) AS `status`,
		di.dateadded
	FROM documentitem di
	LEFT JOIN employee emp ON di.officer = emp.usercode
	LEFT JOIN statusdefinition stat ON di.`status` = stat.`code`
	WHERE di.`status` = 6 OR di.`status` = 10 AND di.officer = _actionOfficer
	ORDER BY di.doc_no;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getdocument_incoming
-- ----------------------------
DROP PROCEDURE IF EXISTS `getdocument_incoming`;
delimiter ;;
CREATE PROCEDURE `getdocument_incoming`(IN _office VARCHAR(50))
BEGIN
	SELECT 
		di.transactioncode,
		UPPER(emp.fullname) AS officer,
		di.docdescription,
		di.docpurpose,
		di.officeinvolved,
		dd.forwardedto,
		di.urgencylevel,
		UPPER(stat.`description`) AS `status`,
		di.dateadded
	FROM documentitemdetails dd
	LEFT JOIN documentitem di ON dd.`trans_code` = di.`transactioncode`
	LEFT JOIN employee emp ON di.officer = emp.usercode
	LEFT JOIN statusdefinition stat ON di.`status` = stat.`code`
	WHERE di.`status` = 5 AND dd.forwardedto = _office AND dd.islatest = 1
	ORDER BY di.doc_no;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getdocument_outgoing
-- ----------------------------
DROP PROCEDURE IF EXISTS `getdocument_outgoing`;
delimiter ;;
CREATE PROCEDURE `getdocument_outgoing`(IN _actionOfficer VARCHAR(30))
BEGIN
	SELECT 
		di.doc_no,
		di.transactioncode,
		UPPER(emp.fullname) AS officer,
		di.docdescription,
		di.docpurpose,
		di.officeinvolved,
		di.urgencylevel,
		UPPER(stat.`description`) AS `status`,
		di.dateadded
	FROM documentitem di
	LEFT JOIN employee emp ON di.officer = emp.usercode
	LEFT JOIN statusdefinition stat ON di.`status` = stat.`code`
	WHERE di.`status` = 2  OR di.`status` = 3 OR di.`status` = 4 AND di.officer = _actionOfficer
	ORDER BY di.doc_no;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getdocument_processed
-- ----------------------------
DROP PROCEDURE IF EXISTS `getdocument_processed`;
delimiter ;;
CREATE PROCEDURE `getdocument_processed`(IN _officeCode VARCHAR(50))
BEGIN
	SET @sql = CONCAT('
							SELECT
								di.transactioncode,
								UPPER(emp.fullname) as action_officer,
								UPPER(emp.email) as officer_email,
								di.docdescription,
								di.docpurpose,
								di.officeinvolved,
								di.urgencylevel,
								UPPER(sd.description) as status,
								di.approvedby,
								di.approveddate,
								di.filename
							FROM documentitem di
							LEFT JOIN employee emp ON di.officer = emp.usercode
							LEFT JOIN statusdefinition sd ON di.`status` = sd.code
							LEFT JOIN documentitemdetails dd ON di.transactioncode = dd.trans_code
							WHERE dd.enteredby = ''',_officeCode,'''
							GROUP BY 
								di.transactioncode,
								emp.fullname,
								emp.email,
								di.docdescription,
								di.docpurpose,
								di.officeinvolved,
								di.urgencylevel,
								sd.description,
								di.approvedby,
								di.approveddate,
								di.filename');
	PREPARE stmt FROM @sql;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getdocument_received
-- ----------------------------
DROP PROCEDURE IF EXISTS `getdocument_received`;
delimiter ;;
CREATE PROCEDURE `getdocument_received`(IN _office VARCHAR(50))
BEGIN
	SELECT 
		di.transactioncode,
		UPPER(emp.fullname) AS officer,
		di.docdescription,
		di.docpurpose,
		di.officeinvolved,
		dd.forwardedto,
		di.urgencylevel,
		UPPER(stat.`description`) AS `status`,
		di.dateadded
	FROM documentitemdetails dd
	LEFT JOIN documentitem di ON dd.`trans_code` = di.`transactioncode`
	LEFT JOIN employee emp ON di.officer = emp.usercode
	LEFT JOIN statusdefinition stat ON di.`status` = stat.`code`
	WHERE di.`status` < 5 AND di.`status` > 1 AND dd.forwardedto = _office AND dd.islatest = 1
	ORDER BY di.doc_no;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getdocument_request
-- ----------------------------
DROP PROCEDURE IF EXISTS `getdocument_request`;
delimiter ;;
CREATE PROCEDURE `getdocument_request`(IN _actionOfficer VARCHAR(50))
BEGIN
	SELECT 
		di.transactioncode,
		UPPER(emp.fullname) AS officer,
		di.docdescription,
		di.docpurpose,
		di.officeinvolved,
		di.urgencylevel,
		UPPER(stat.`description`) AS `status`,
		di.filename
	FROM documentitem di
	LEFT JOIN employee emp ON di.officer = emp.usercode
	LEFT JOIN statusdefinition stat ON di.`status` = stat.`code`
	WHERE officer = _actionOfficer AND di.`status` = 5;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getemployee
-- ----------------------------
DROP PROCEDURE IF EXISTS `getemployee`;
delimiter ;;
CREATE PROCEDURE `getemployee`(IN id CHAR(3))
BEGIN
	IF id = 123 THEN
		SELECT usercode,fullname,office,email,phonenumber FROM employee WHERE office != "administrator";
	END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getoffice
-- ----------------------------
DROP PROCEDURE IF EXISTS `getoffice`;
delimiter ;;
CREATE PROCEDURE `getoffice`()
BEGIN
	SELECT idno,`desc`,`code` FROM department;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getofficer
-- ----------------------------
DROP PROCEDURE IF EXISTS `getofficer`;
delimiter ;;
CREATE PROCEDURE `getofficer`()
BEGIN
	SELECT 
		usercode,
		CONCAT(fullname,' - ',office) AS fullname,
		office 
	FROM employee;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for geturgency
-- ----------------------------
DROP PROCEDURE IF EXISTS `geturgency`;
delimiter ;;
CREATE PROCEDURE `geturgency`()
BEGIN
	SELECT description FROM urgencydefinition;
END
;;
delimiter ;

-- ----------------------------
-- Function structure for getvalue
-- ----------------------------
DROP FUNCTION IF EXISTS `getvalue`;
delimiter ;;
CREATE FUNCTION `getvalue`(object LONGTEXT, field VARCHAR(255))
 RETURNS varchar(255) CHARSET utf8mb4
  DETERMINISTIC
BEGIN
	DECLARE result VARCHAR(255);
	SET result = UPPER(JSON_UNQUOTE(JSON_EXTRACT(object, field)));
	RETURN result;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for login
-- ----------------------------
DROP PROCEDURE IF EXISTS `login`;
delimiter ;;
CREATE PROCEDURE `login`(IN jsonData JSON)
BEGIN
	DECLARE _statusmsg LONGTEXT;
	DECLARE _statusno TINYINT;
	DECLARE _employeeinfo LONGTEXT;
	DECLARE _email VARCHAR(50);
	DECLARE _password VARCHAR(300);
	DECLARE _hashPassword LONGTEXT;
	
	SET _email = lower(JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.email')));
	SET _password = JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.password'));
	SET _hashPassword = SHA2(_password, 256);
-- 	SET @defaultPassword = SHA2("password", 256);
	
	IF NOT EXISTS(SELECT 1 FROM `employee` WHERE email = _email) THEN
		SET _statusno = 0;
		SET _statusmsg = 'Email not found';
-- 	ELSEIF(SELECT `password` FROM `employee` WHERE `email` = _email) = @defaultPassword THEN
-- 		SET _statusno = 2;
-- 		SET _statusmsg = 'Account must update the password';
-- 		SELECT JSON_OBJECT(
-- 				'email', email,
-- 				'level', `employeelevel`,
-- 				'privilege', privilege
-- 			) INTO _employeeinfo
-- 			FROM `access`
-- 			WHERE email = _email;									
-- 			SET @result = JSON_OBJECT(
-- 											'status',_statusno,
-- 											'result', _statusmsg,
-- 											'employeeinfo', _employeeinfo
-- 										);
-- 	ELSEIF (SELECT invalidcount FROM `employee` WHERE `email` = _email) >= 3 THEN
-- 		SET _statusno = 0;
-- 		SET _statusmsg = 'Max attempt reached. Please contact administrator.';
-- 		SET @result = JSON_OBJECT(
-- 											'status',_statusno,
-- 											'result', _statusmsg
-- 										);
	
	ELSEIF NOT EXISTS(SELECT 1 FROM `employee` WHERE `email` = _email AND `password` = _hashPassword) THEN
-- 		UPDATE `employee` SET invalidcount = invalidcount + 1 WHERE `email` = _email;
		SET _statusno = 0;
		SET _statusmsg = 'Incorrect Password';
-- 	ELSEIF EXISTS(SELECT 1 FROM `sessionlogs` WHERE `email` = _email) THEN
-- 		SET _statusno = 0;
-- 		SET _statusmsg = 'Session is active. Account already login';
-- 		SET @result = JSON_OBJECT(
-- 											'status',_statusno,
-- 											'result', _statusmsg
-- 										);	
	ELSE
		IF (SELECT 1 FROM `employee` WHERE email = _email AND `password` = _hashPassword AND verified = 0) = 1 THEN
			SET _statusno = 0;
			SET _statusmsg = "Employee not validated";
		ELSE
			SELECT JSON_OBJECT(
				'usercode', usercode,
				'fullname', fullname,
				'office', office,
				'campus', campus,
				'email', email,
				'authorizationdetails', authorizationdetails,
				'apikeyexpiration', apikeyexpiration,
				'campus', campus,
				'verified', verified,
				'issecured', issecured
			) INTO _employeeinfo
			FROM `employee`
			WHERE email = _email;	
			
			SET _statusno = 1;
			SET _statusmsg = _employeeinfo;
		END IF;
	END IF;
	SELECT _statusmsg as `result`, _statusno as statuscode;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for newdocument
-- ----------------------------
DROP PROCEDURE IF EXISTS `newdocument`;
delimiter ;;
CREATE PROCEDURE `newdocument`(IN jsonData LONGTEXT)
BEGIN
	DECLARE _statusmsg VARCHAR(100);
	DECLARE _statusno TINYINT;
	
	DECLARE _transactioncode VARCHAR(500) DEFAULT JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.transactionCode'));
	DECLARE _officer CHAR(30) DEFAULT getvalue(jsonData, '$.actionOfficer');
	DECLARE _docdesc LONGTEXT DEFAULT getvalue(jsonData, '$.documentDescription');
	DECLARE _docpurpose LONGTEXT DEFAULT getvalue(jsonData, '$.documentPurpose');
	DECLARE _officeinvolved VARCHAR(50) DEFAULT getvalue(jsonData, '$.officeInvolved');
	DECLARE _forwardedto VARCHAR(50) DEFAULT getvalue(jsonData, '$.forwardedTo');
	DECLARE _urgency VARCHAR(100) DEFAULT getvalue(jsonData, '$.urgencyLevel');
	DECLARE _dateadded DATETIME DEFAULT CURRENT_TIMESTAMP();
	
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		ROLLBACK;
		SET _statusmsg = "Database Error: Error inserting transaction.";
		SET _statusno = 0;
		SELECT _statusmsg AS result, _statusno AS statuscode;
	END;
	
	START TRANSACTION;
	SET @sql = CONCAT('INSERT INTO documentitem (transactioncode,officer,docdescription,docpurpose,officeinvolved,urgencylevel,dateadded)
											VALUES (''',_transactioncode,''',''',_officer,''',''',_docdesc,''',''',_docpurpose,''',
											''',_officeinvolved,''',''',_urgency,''',''',_dateadded,''')');
	PREPARE stmt FROM @sql;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	
	SET @sql = CONCAT('INSERT INTO documentitemdetails(trans_code,forwardedto,note,enteredby,entereddate) 
											VALUES (''',_transactioncode,''',''',_forwardedto,''',''-'',''',_officer,''',''',_dateadded,''')');
	PREPARE stmt FROM @sql;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	
	SET _statusmsg = "New document submitted";
	SET _statusno = 1;
	SELECT _statusmsg AS result, _statusno AS statuscode;
	COMMIT;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for newemployee
-- ----------------------------
DROP PROCEDURE IF EXISTS `newemployee`;
delimiter ;;
CREATE PROCEDURE `newemployee`(IN jsonData LONGTEXT)
BEGIN
	DECLARE _statusmsg VARCHAR(100);
	DECLARE _statusno TINYINT;
	
	DECLARE _usercode CHAR(30);
	DECLARE _fullname VARCHAR(100);
	DECLARE _office VARCHAR(100);
	DECLARE _email VARCHAR(50);
	DECLARE _phoneno VARCHAR(15);
	DECLARE _campus VARCHAR(100);
	DECLARE _adminLogin VARCHAR(30);
	
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		ROLLBACK;
		SET _statusmsg = "Database Error: Error inserting transaction.";
		SET _statusno = 0;
		SELECT _statusmsg AS result, _statusno AS statuscode;
	END;
	
	SET _adminLogin = "admin";
	SELECT JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.username')) INTO _usercode;
	SELECT LOWER(JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.fullname'))) INTO _fullname;
	SELECT LOWER(JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.office'))) INTO _office;
	SELECT LOWER(JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.contactEmail'))) INTO _email;
	SELECT JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.contactNo')) INTO _phoneno;
	SELECT JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.campus')) INTO _campus;
	
	SET @password = SHA2("password", 256);
	
	START TRANSACTION;
	IF EXISTS(SELECT 1 FROM employee WHERE usercode = _usercode) THEN
		SET @sql = CONCAT('UPDATE employee 
												SET fullname = ''',_fullname,''',
												office = ''',_office,''',
												email = ''',_email,''',
												phonenumber = ''',_phoneno,''',
												dateupdated = ''',CURRENT_TIMESTAMP(),''',
												updatedby = ''',_adminLogin,''',
												campus = ''',_campus,'''
											WHERE usercode = ''',_usercode,'''');
		PREPARE stmt FROM @sql;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
		SET _statusmsg = "Employee updated";
		SET _statusno = 1;
	ELSE
		SET @sql = CONCAT('INSERT INTO employee (usercode,fullname,office,email,phonenumber,
												password,campus,dateadded,addedby)VALUES (''',_usercode,''',''',_fullname,''',
												''',_office,''',''',_email,''',''',_phoneno,''',''',@password,''',''',_campus,''',
												''',CURRENT_TIMESTAMP(),''',''',_adminLogin,''')');
		PREPARE stmt FROM @sql;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
		SET _statusmsg = "Employee added";
		SET _statusno = 1;
	END IF;
	SELECT _statusmsg AS result, _statusno AS statuscode;
	COMMIT;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for resetpassword
-- ----------------------------
DROP PROCEDURE IF EXISTS `resetpassword`;
delimiter ;;
CREATE PROCEDURE `resetpassword`(IN jsonData LONGTEXT)
BEGIN
	DECLARE _statusmsg VARCHAR(100);
	DECLARE _statusno TINYINT;
	DECLARE _userCode VARCHAR(30) DEFAULT JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.actionofficer'));
	DECLARE _oldPass VARCHAR(10) DEFAULT JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.oldPassword'));
	DECLARE _newPass VARCHAR(10) DEFAULT JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.newPassword'));
	DECLARE _confirmPass VARCHAR(10) DEFAULT JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.confirmPassword'));
	DECLARE _hashPassword LONGTEXT DEFAULT SHA2(_oldPass, 256);
	
	IF EXISTS (SELECT 1 FROM employee WHERE usercode = _userCode AND `password` = _hashPassword) THEN
		UPDATE employee SET `password` = SHA2(_newPass, 256) WHERE usercode = _userCode;
		SET _statusmsg = "Password updated successfully";
		SET _statusno = 1;
	ELSE
		SET _statusmsg = "Old password incorrect";
		SET _statusno = 0;
	END IF;
	SELECT _statusmsg AS result, _statusno AS statuscode;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for setfilename
-- ----------------------------
DROP PROCEDURE IF EXISTS `setfilename`;
delimiter ;;
CREATE PROCEDURE `setfilename`(IN jsonData LONGTEXT)
BEGIN
	DECLARE _filename VARCHAR(500);
	DECLARE _transactioncode VARCHAR(30);
	
	SET _transactioncode = getvalue(jsonData, '$.transactioncode');
	SET _filename = JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.filename'));
	
	SET @sql = CONCAT('UPDATE documentitem SET filename = ''',_filename,''' 
											WHERE transactioncode = ''',_transactioncode,'''');
	PREPARE stmt FROM @sql;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for settransctioncomplete
-- ----------------------------
DROP PROCEDURE IF EXISTS `settransctioncomplete`;
delimiter ;;
CREATE PROCEDURE `settransctioncomplete`(IN jsonData LONGTEXT)
BEGIN
	DECLARE _statusmsg VARCHAR(100) DEFAULT 'Transaction not found';
	DECLARE _statusno TINYINT;
	
	DECLARE _transactionCode VARCHAR(50);
	DECLARE _validatingOfficer VARCHAR(50);
	DECLARE _transactionNote LONGTEXT;
	
	SET _transactionCode = getvalue(jsonData, '$.transactionCode');
	SET _validatingOfficer = getvalue(jsonData, '$.validatingOfficer');
	SET _transactionNote = getvalue(jsonData, '$.transactionNote');
	
	IF EXISTS(SELECT 1 FROM documentitem WHERE transactioncode = _transactionCode) THEN
		SET @sql = CONCAT('UPDATE documentitem SET `status` = 10 , 
												approvedby = ''',_validatingOfficer,''', 
												approveddate = CURRENT_TIMESTAMP()
												WHERE transactioncode = ''',_transactionCode,'''');
		PREPARE stmt FROM @sql;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
		
		SET @sql = CONCAT('INSERT INTO documentitemdetails (forwardedto, status, note, enteredby, 
												entereddate, trans_code) VALUES (''-'',10,''',_transactionNote,''',
												''',_validatingOfficer,''',CURRENT_TIMESTAMP(),''',_transactionCode,''')');
		PREPARE stmt FROM @sql;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
		SET _statusmsg = "Transaction validated successfully";
		SET _statusno = 1;
	END IF;
	SELECT _statusmsg AS result, _statusno AS statuscode;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for settransctionforward
-- ----------------------------
DROP PROCEDURE IF EXISTS `settransctionforward`;
delimiter ;;
CREATE PROCEDURE `settransctionforward`(IN jsonData LONGTEXT)
BEGIN
	DECLARE _statusmsg VARCHAR(100) DEFAULT 'Transaction not found';
	DECLARE _statusno TINYINT;
	
	DECLARE _transactionCode VARCHAR(50);
	DECLARE _validatingOfficer VARCHAR(50);
	DECLARE _transactionNote LONGTEXT;
	DECLARE _officeToForward LONGTEXT;
	
	SET _transactionCode = getvalue(jsonData, '$.transactionCode');
	SET _validatingOfficer = getvalue(jsonData, '$.validatingOfficer');
	SET _transactionNote = getvalue(jsonData, '$.transactionNote');
	SET _officeToForward = getvalue(jsonData, '$.officeToForward');
	
	IF EXISTS(SELECT 1 FROM documentitem WHERE transactioncode = _transactionCode) THEN
		SET @sql = CONCAT('UPDATE documentitem SET `status` = 5 , 
												approvedby = ''',_validatingOfficer,''', 
												approveddate = CURRENT_TIMESTAMP()
												WHERE transactioncode = ''',_transactionCode,'''');
		PREPARE stmt FROM @sql;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
		
		SET @sql = CONCAT('UPDATE documentitemdetails SET islatest = 0 
												WHERE trans_code = ''',_transactionCode,'''');
		PREPARE stmt FROM @sql;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
		
		SET @sql = CONCAT('INSERT INTO documentitemdetails (forwardedto, status, note, enteredby, 
												entereddate, trans_code) VALUES (''',_officeToForward,''',5,''',_transactionNote,''',
												''',_validatingOfficer,''',CURRENT_TIMESTAMP(),''',_transactionCode,''')');
		PREPARE stmt FROM @sql;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
		
		SET _statusmsg = "Transaction forwarded successfully";
		SET _statusno = 1;
	END IF;
	SELECT _statusmsg AS result, _statusno AS statuscode;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for settransctionreturn
-- ----------------------------
DROP PROCEDURE IF EXISTS `settransctionreturn`;
delimiter ;;
CREATE PROCEDURE `settransctionreturn`(IN jsonData LONGTEXT)
BEGIN
	DECLARE _statusmsg VARCHAR(100) DEFAULT 'Transaction not found';
	DECLARE _statusno TINYINT;
	
	DECLARE _transactionCode VARCHAR(50);
	DECLARE _validatingOfficer VARCHAR(50);
	DECLARE _transactionNote LONGTEXT;
	
	SET _transactionCode = getvalue(jsonData, '$.transactionCode');
	SET _validatingOfficer = getvalue(jsonData, '$.validatingOfficer');
	SET _transactionNote = getvalue(jsonData, '$.transactionNote');
	
	IF EXISTS(SELECT 1 FROM documentitem WHERE transactioncode = _transactionCode) THEN
		SET @sql = CONCAT('UPDATE documentitem SET `status` = 6 , 
												approvedby = ''',_validatingOfficer,''', 
												approveddate = CURRENT_TIMESTAMP()
												WHERE transactioncode = ''',_transactionCode,'''');
		PREPARE stmt FROM @sql;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
	
	
		SET @sql = CONCAT('INSERT INTO documentitemdetails (forwardedto, status, note, enteredby, 
												entereddate, trans_code) VALUES (''-'',6,''',_transactionNote,''',
												''',_validatingOfficer,''',CURRENT_TIMESTAMP(),''',_transactionCode,''')');
		PREPARE stmt FROM @sql;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
		SET _statusmsg = "Transaction returned";
		SET _statusno = 1;
	END IF;
	SELECT _statusmsg AS result, _statusno AS statuscode;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for signcheck
-- ----------------------------
DROP PROCEDURE IF EXISTS `signcheck`;
delimiter ;;
CREATE PROCEDURE `signcheck`(IN jsonData LONGTEXT)
BEGIN
	DECLARE _statusmsg VARCHAR(100);
	DECLARE _statusno TINYINT;
	
	DECLARE _sign VARCHAR(100) DEFAULT JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.signcode'));
	
	IF EXISTS(SELECT 1 FROM signrecord WHERE sign_code = _sign) THEN
		SET _statusmsg = "Valid";
		SET _statusno = 1;
	ELSE
		SET _statusmsg = "Invalid";
		SET _statusno = 0;
	END IF;
	SELECT _statusmsg AS result, _statusno AS statuscode;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for signrecord
-- ----------------------------
DROP PROCEDURE IF EXISTS `signrecord`;
delimiter ;;
CREATE PROCEDURE `signrecord`(IN jsonData LONGTEXT)
BEGIN
	DECLARE _statusmsg VARCHAR(100);
	DECLARE _statusno TINYINT;
	
	DECLARE _sign VARCHAR(100) DEFAULT JSON_UNQUOTE(JSON_EXTRACT(jsonData, '$.signcode'));
	
	INSERT INTO signrecord(sign_code) VALUES (_sign);
	SET _statusmsg = "Success";
	SET _statusno = 1;
	SELECT _statusmsg AS result, _statusno AS statuscode;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for track_document
-- ----------------------------
DROP PROCEDURE IF EXISTS `track_document`;
delimiter ;;
CREATE PROCEDURE `track_document`(IN jsonData LONGTEXT)
BEGIN
		-- Declare
    DECLARE _statusmsg LONGTEXT DEFAULT "Not Found";
    DECLARE _statusno SMALLINT DEFAULT 0;
		
		DECLARE _transactioncode VARCHAR(50);
		DECLARE _user VARCHAR(30);
		DECLARE _office VARCHAR(30);
		DECLARE _datetracked DATETIME DEFAULT CURRENT_TIMESTAMP();
		
		SET _transactioncode = getvalue(jsonData, '$.transactioncode');
		
		IF EXISTS(SELECT 1 FROM documentitem WHERE transactioncode = _transactioncode) THEN
		
-- 			SET @sql = CONCAT('SELECT * FROM documentitem WHERE transactioncode = ''',_transactioncode,'''');
-- 			PREPARE stmt FROM @sql;
-- 			EXECUTE stmt;
-- 			DEALLOCATE PREPARE stmt;
			SET @documentitem = (SELECT JSON_OBJECT(
															'transactioncode', transactioncode,
															'description', docdescription,
															'purpose', docpurpose,
															'officer', officer,
															'officeinvolved', officeinvolved,
															'urgencylevel', urgencylevel,
															'status', UPPER(description),
															'approveddate', approveddate,
															'approvedby', UPPER(fullname),
															'dateadded', documentitem.dateadded,
															'filename', filename
													) FROM documentitem
													LEFT JOIN statusdefinition ON documentitem.`status` = statusdefinition.`code`
													LEFT JOIN employee ON documentitem.officer = employee.usercode
													WHERE transactioncode = _transactioncode);
													
			SET @documentitemdetails = (SELECT JSON_OBJECT(
																			'details', JSON_ARRAYAGG(
																					JSON_OBJECT(
																							'forwardedto', UPPER(`desc`),
																							'status', UPPER(description),
																							'note', UPPER(note),
																							'enteredby', UPPER(fullname),
																							'entereddate', DATE_FORMAT(entereddate, '%Y-%m-%d %H:%i:%s') 
																					)
																			)
																	) FROM documentitemdetails 
																	LEFT JOIN statusdefinition ON documentitemdetails.`status` = statusdefinition.`code`
																	LEFT JOIN department ON documentitemdetails.forwardedto = department.`code`
																	LEFT JOIN employee ON documentitemdetails.enteredby = employee.usercode
																	WHERE trans_code = _transactioncode);
			
			SET _statusmsg = (SELECT JSON_OBJECT(
													'item', @documentitem,
													'details', @documentitemdetails
												));
			SET _statusno = 1;
-- 		ELSE
-- 			SELECT _statusmsg AS result, _statusno AS statuscode;
		END IF;
		SELECT _statusmsg AS result, _statusno AS statuscode;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table documentitem
-- ----------------------------
DROP TRIGGER IF EXISTS `deletedocument`;
delimiter ;;
CREATE TRIGGER `deletedocument` BEFORE DELETE ON `documentitem` FOR EACH ROW BEGIN
	DELETE FROM documentitemdetails WHERE `no` = OLD.`doc_no`;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table employee
-- ----------------------------
DROP TRIGGER IF EXISTS `newofficer`;
delimiter ;;
CREATE TRIGGER `newofficer` BEFORE INSERT ON `employee` FOR EACH ROW BEGIN
    SET NEW.usercode = CONCAT(NEW.usercode,'-', LPAD((SELECT COUNT(userno) FROM employee) + 1, 2, '0'));
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
