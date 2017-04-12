INSERT INTO `emergency_server`.`tbl_emergency_call`
(`user_id`,`nfc_type`,`nfc_type_id`,`lattitude`,`longitude`,`report_datetime`,`reported_by`,`duplicate_id`,`status`) VALUES
(2,1,4,19.13376037,72.91187569,CURRENT_TIMESTAMP,4,0,1)

19.13387947,72.91120246
19.13427985,72.91014835

19.13444456,72.9096441
19.13501725,72.908075
19.13539228,72.90631548
19.13609927, 72.91055068
19.13589908,72.91343138#
19.13602578, 72.91467324
19.13744482, 72.91501388 ##
19.13834438, 72.91567639
19.13758925, 72.91728839

'SELECT TIMESTAMP('2017-03-30 14:53:27')-INTERVAL RAND()*365*1 DAY'

INSERT INTO `emergency_server`.`tbl_emergency_call`
(`user_id`,`nfc_type`,`nfc_type_id`,`lattitude`,`longitude`,`report_datetime`,`reported_by`,`duplicate_id`,`status`) VALUES
(3,1,2,19.13387947,72.91120246, ( Select TIMESTAMP('2017-03-30 14:53:27')-INTERVAL RAND()*365*1 Day) ,4,0,1);

INSERT INTO `emergency_server`.`tbl_emergency_call`
(`user_id`,`nfc_type`,`nfc_type_id`,`lattitude`,`longitude`,`report_datetime`,`reported_by`,`duplicate_id`,`status`) VALUES
(2,1,4,19.13427985,72.91014835, ( Select TIMESTAMP('2017-03-30 14:53:27')-INTERVAL RAND()*365*1 Day) ,4,0,1);

INSERT INTO `emergency_server`.`tbl_emergency_call`
(`user_id`,`nfc_type`,`nfc_type_id`,`lattitude`,`longitude`,`report_datetime`,`reported_by`,`duplicate_id`,`status`) VALUES
(1,1,6,19.13539228,72.90631548, ( Select TIMESTAMP('2017-03-30 14:53:27')-INTERVAL RAND()*365*1 Day) ,4,0,1);


INSERT INTO `emergency_server`.`tbl_emergency_call`
(`user_id`,`nfc_type`,`nfc_type_id`,`lattitude`,`longitude`,`report_datetime`,`reported_by`,`duplicate_id`,`status`) VALUES
(1,1,5,19.13609927, 72.91055068, ( Select TIMESTAMP('2017-03-30 14:53:27')-INTERVAL RAND()*365*1 Day) ,2,0,1);
INSERT INTO `emergency_server`.`tbl_emergency_call`
(`user_id`,`nfc_type`,`nfc_type_id`,`lattitude`,`longitude`,`report_datetime`,`reported_by`,`duplicate_id`,`status`) VALUES
(2,1,5,19.13589908,72.91343138, ( Select TIMESTAMP('2017-03-30 14:53:27')-INTERVAL RAND()*365*1 Day) ,3,0,1);
INSERT INTO `emergency_server`.`tbl_emergency_call`
(`user_id`,`nfc_type`,`nfc_type_id`,`lattitude`,`longitude`,`report_datetime`,`reported_by`,`duplicate_id`,`status`) VALUES
(2,1,5,19.13602578, 72.91467324, ( Select TIMESTAMP('2017-03-30 14:53:27')-INTERVAL RAND()*365*1 Day) ,1,0,1);
INSERT INTO `emergency_server`.`tbl_emergency_call`
(`user_id`,`nfc_type`,`nfc_type_id`,`lattitude`,`longitude`,`report_datetime`,`reported_by`,`duplicate_id`,`status`) VALUES
(4,1,5,19.13744482, 72.91501388, ( Select TIMESTAMP('2017-03-30 14:53:27')-INTERVAL RAND()*365*1 Day) ,2,0,1);
INSERT INTO `emergency_server`.`tbl_emergency_call`
(`user_id`,`nfc_type`,`nfc_type_id`,`lattitude`,`longitude`,`report_datetime`,`reported_by`,`duplicate_id`,`status`) VALUES
(4,1,1,19.13744482, 72.91501388, ( Select TIMESTAMP('2017-03-30 14:53:27')-INTERVAL RAND()*365*1 Day) ,3,0,1);
INSERT INTO `emergency_server`.`tbl_emergency_call`
(`user_id`,`nfc_type`,`nfc_type_id`,`lattitude`,`longitude`,`report_datetime`,`reported_by`,`duplicate_id`,`status`) VALUES
(1,1,5,19.13744482, 72.91501388, ( Select TIMESTAMP('2017-03-30 14:53:27')-INTERVAL RAND()*365*1 Day) ,1,0,1);
INSERT INTO `emergency_server`.`tbl_emergency_call`
(`user_id`,`nfc_type`,`nfc_type_id`,`lattitude`,`longitude`,`report_datetime`,`reported_by`,`duplicate_id`,`status`) VALUES
(4,1,5,19.13744482, 72.91501388, ( Select TIMESTAMP('2017-03-30 14:53:27')-INTERVAL RAND()*365*1 Day) ,2,0,1);
INSERT INTO `emergency_server`.`tbl_emergency_call`
(`user_id`,`nfc_type`,`nfc_type_id`,`lattitude`,`longitude`,`report_datetime`,`reported_by`,`duplicate_id`,`status`) VALUES
(1,1,5,19.13834438, 72.91567639, ( Select TIMESTAMP('2017-03-30 14:53:27')-INTERVAL RAND()*365*1 Day) ,3,0,1);
INSERT INTO `emergency_server`.`tbl_emergency_call`
(`user_id`,`nfc_type`,`nfc_type_id`,`lattitude`,`longitude`,`report_datetime`,`reported_by`,`duplicate_id`,`status`) VALUES
(2,1,1,19.13758925, 72.91728839, ( Select TIMESTAMP('2017-03-30 14:53:27')-INTERVAL RAND()*365*1 Day) ,4,0,1);

