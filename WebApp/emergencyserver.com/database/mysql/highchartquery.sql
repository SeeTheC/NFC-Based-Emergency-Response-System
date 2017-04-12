SELECT nfc_type_id,count(id)
FROM emergency_server.tbl_emergency_call 
group by nfc_type_id;	

select * from tbl_emergency_call
Select count(id)
from tbl_emergency_call
GROUP BY YEAR(report_datetime), MONTH(report_datetime)


Select nfc_type_id,MONTH(report_datetime),count(id)
from tbl_emergency_call
where
YEAR(report_datetime)=2016
GROUP BY nfc_type_id,MONTH(report_datetime)


SELECT
    COUNT(id),
    DATE_FORMAT(report_datetime, '%Y-%m-%d') AS DAY,
    DATE_FORMAT(report_datetime, '%Y-%m') AS MONTH,
    DATE_FORMAT(report_datetime, '%Y') AS YEAR,

FROM
    tbl_emergency_call
GROUP BY
    DATE_FORMAT(report_datetime, '%Y-%m-%d ');