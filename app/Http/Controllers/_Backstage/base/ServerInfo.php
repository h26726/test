<?php
function ServerInfo()
    {
        //--HR----------------------------------------------------------
		$hr = array();
		$hr[] = array('Logout','安全離開',1);
		$menu[] = array($hr,"HR","HR");

        //--系統設定-----------------------------------------------------
		$subSystem = array();
		$subSystem[] = array("AccountManage","帳號管理",1);
		$subSystem[] = array("AuthorizationConfig","權限設定",1);
		$subSystem[] = array("AccountRenewAjax","帳號更新",0);
		$subSystem[] = array("CardIdManage","卡號管理",0);
		$subSystem[] = array("OnlineManage","線上人員",1);
		$subSystem[] = array("SignProcess","簽呈人員設定",1);
		$subSystem[] = array("Help","AJAX",0);
		$menu[] = array($subSystem,"系統設定",'System');

        //--請假-----------------------------------------------------
		$subLeave = array();
		$subLeave[] = array("LeaveApplication","假卡申請",1);
		$subLeave[] = array("LeaveApplicationSearch","假卡查詢",1);
		$subLeave[] = array("LeaveApplicationReport","月統計",1);
		$subLeave[] = array("LeaveApplicationReportYear","年統計",1);
		$subLeave[] = array("LeaveApplicationSettinSavegAjax","假卡設定儲存",0);
		$subLeave[] = array("LeaveApplicationConfirmAjax","假卡授權儲存",0);
		$menu[] = array($subLeave,"請假","LeaveApplication");

        //--外出-----------------------------------------------------
		$subOutGoing = array();
		$subOutGoing[] = array("OutGoingApplication","外出單申請",1);
		$subOutGoing[] = array("OutGoingApplicationSearch","外出單查詢",1);
		$subOutGoing[] = array("OutGoingApplicationReport","外出單統計",1);
		$menu[] = array($subOutGoing,"外出","OutGoingApplication");

        //--加班-----------------------------------------------------
		$subOverTime = array();
		$subOverTime[] = array("OverTimeApplication","加班單申請",1);
		$subOverTime[] = array("OverTimeApplicationSearch","加班單查詢",1);
		$subOverTime[] = array("OverTimeApplicationReport","加班單統計",1);
		$menu[] = array($subOverTime,"加班","OverTimeApplication");

        //--調班-----------------------------------------------------
		$subChangeClass = array();
		$subChangeClass[] = array("ChangeClassApplication","調班單申請",1);
		$subChangeClass[] = array("ChangeClassApplicationSearch","調班單查詢",1);
		$menu[] = array($subChangeClass,"調班","ChangeClassApplication");

        //--審核-----------------------------------------------------
		$submenu = array();
		$submenu[] = array("AllApplicationAuthorization","申請單審核",1);
		$menu[] = array($submenu,"審核",'Authorization');

        //--審核-----------------------------------------------------
		$subChart = array();
		$subChart[] = array("ChartLA","月請假資訊",1);
		$subChart[] = array("ChartOG","月外出資訊",1);
		$subChart[] = array("ChartOT","月加班資訊",1);
		$subChart[] = array("ChartPunch","月刷卡資訊(個人)",1);
		$subChart[] = array("ChartDepPunch","月刷卡資訊(部門)",1);
		$menu[] = array($subChart,"圖表","Charts");

        //--審核-----------------------------------------------------
		$submenu = array();
		$submenu[] = array("PunchSearch","打卡查詢",1);
		$submenu[] = array("Punch","補打卡",0);
		$submenu[] = array("PunchSearchRecord","刷卡記錄(個人)",1);
		$submenu[] = array("PunchSearchRecordOffice","刷卡記錄(辦公室)",1);
		$menu[] = array($submenu,"打卡",'Punch');

        //--薪資-----------------------------------------------------
		$submenu = array();
		$submenu[] = array("PaySearch","薪資查詢",1);
		$submenu[] = array("PayInsert","薪資資料匯入",1);
		$menu[] = array($submenu,"薪資",'Salary');

        //--班表-----------------------------------------------------
		$submenu = array();
		$submenu[] = array("ClassSchedule","班表設定",1);
		$submenu[] = array("ClassScheduleSearch","班表查詢",1);
		$menu[] = array($submenu,"班表",'ClassSchedule');

        //--TEST-----------------------------------------------------
		$submenu = array();
		$submenu[] = array("TEST","TEST",1);
		$submenu[] = array("TEST_Excel_input","匯入申請單",1);
		$menu[] = array($submenu,"TEST",'Test');

        return $menu;
    }
