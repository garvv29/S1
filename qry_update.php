<?php

	require_once("include/config.php");
	require_once("include/connection.php");
	
	$sql_up1=mysql_query("update tblissue set yearcode='09-10' where issue_date<='2010-03-31'");
	$sql_up2=mysql_query("update tblissue set yearcode='10-11' where issue_date>'2010-03-31'");
	
	$sql_arrsub=mysql_query("select * from tblissue where issue_type='eindent' and issue_date<='2010-03-31' and issuetrflag=1  order by issue_id asc") or die(mysql_error());
	$count=1;
	while($row_arrsub=mysql_fetch_array($sql_arrsub))
	{
	$sql_upd=mysql_query("update tblissue set iss_code='$count' where issue_id='".$row_arrsub['issue_id']."'");
	$count++;
	}
	
	$sql_arrsub=mysql_query("select * from tblissue where issue_type='eindent' and issue_date>'2010-03-31' and issuetrflag=1 order by issue_id asc") or die(mysql_error());
	$count=1;
	while($row_arrsub=mysql_fetch_array($sql_arrsub))
	{
	$sql_upd=mysql_query("update tblissue set iss_code='$count', issue_code='$count'  where issue_id='".$row_arrsub['issue_id']."'");
	$count++;
	}
	
	$sql_arrsub=mysql_query("select * from tbl_ieindent where tdate>'2010-03-31' order by tid asc") or die(mysql_error());
	$count=1;
	while($row_arrsub=mysql_fetch_array($sql_arrsub))
	{
	$sql_upd=mysql_query("update tbl_ieindent set code1='$count' where tid='".$row_arrsub['tid']."'");
	$count++;
	}
?>