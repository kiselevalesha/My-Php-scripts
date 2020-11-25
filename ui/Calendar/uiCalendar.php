<?    require_once '../js-scripts/colors.php'; ?>
<div class = "row card-panel" style="padding:5px; margin:0px;">
<?    require_once '../php-scripts/ui/Calendar/MonthYear/uiCalendarMonthYear.php'; ?>
<?    require_once '../php-scripts/ui/Calendar/Days/uiCalendarDays.php'; ?>
</div>
<br>
<div align="right" id="divBlockSwitchCalendar">
    <a href="javascript:void(0);" onclick="OnClickOpenFullCalendar()">
        <div style="padding:0px; margin: 0px;">
            <div style=" padding: 3px 15px 3px 15px; margin: 0px;"><img src="/images/arrow-down.png" width=20px;></div>
        </div> 
    </a>
</div>   
