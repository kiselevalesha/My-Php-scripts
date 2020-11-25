<?
//$idCalendar = 1;
?>

<div class = "row card-panel" style="padding:5px; margin:0px;">
    
<div id="divBlockYearMonth<? echo $idCalendar; ?>">
<table width=100%>
    <tr>
        <td width=5%></td>
        <td width=15%><a href="javascript:void(0);" onclick="OnClickPrevMonth(<? echo $idCalendar; ?>)"><img align="left" src="/images/arrow-left.png" alt="left" style="width:23px;"></a></td>
        <td width=60%>
            <a style="color:black;" href="javascript:void(0);" onclick="OnClickMonth(<? echo $idCalendar; ?>)">
                <div align="center">
                    <h4  id="divCalendarMonth<? echo $idCalendar; ?>"></h4>
                    <b><div id="divCalendarYear<? echo $idCalendar; ?>"></div></b>
                </div>
            </a>
        </td>
        <td width=15%><a href="javascript:void(0);" onclick="OnClickNextMonth(<? echo $idCalendar; ?>)"><img align="right" src="/images/arrow-right.png" alt="right" style="width:23px;"></a></td>
        <td width=5%></td>
    </tr>
</table>
</div>

<div align="center" style="display:block; height:100%;" id="divWaitCalendar<? echo $idCalendar; ?>"><br><br><br><br><br><img src="/images/progress1.gif" width=50px;><br><br><br><br><br></div>

<div id="divBlockDays<? echo $idCalendar; ?>">
<table width=100% cellspacing="0" cellpadding="0" style="margin: 0px; padding:0px;">
    <tr style="margin: 0px; padding:0px;">
        <td width=14%><div align="center">ПН</div></td>
        <td width=14%><div align="center">ВТ</div></td>
        <td width=14%><div align="center">СР</div></td>
        <td width=14%><div align="center">ЧТ</div></td>
        <td width=14%><div align="center">ПТ</div></td>
        <td width=14%><div align="center" style="color:red;">СБ</div></td>
        <td width=14%><div align="center" style="color:red;">ВС</div></td>
    </tr>
    
    
</table>
</div>

</div>



<br>
<div align="right" id="divBlockSwitchCalendar<? echo $idCalendar; ?>">
    <a href="javascript:void(0);" onclick="OnClickOpenFullCalendar(<? echo $idCalendar; ?>)">
        <div style="padding:0px; margin: 0px;">
            <div style=" padding: 3px 15px 3px 15px; margin: 0px;"><img src="/images/arrow-down.png" width=20px;></div>
        </div> 
    </a>
</div>   
