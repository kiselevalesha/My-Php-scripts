<?    require_once '../php-scripts/ui/Calendar/MonthYear/javascript.php'; ?>
<?    require_once '../php-scripts/ui/Calendar/Days/javascript.php'; ?>
<script type = "text/javascript">

    var strJsonShedule = "";
    var iSelectedYear = 0, iSelectedMonth = 0, iSelectedDay = 0, iSelectedHour = 0, iSelectedMinute = 0;
    var iCurrentYear = 0, iCurrentMonth = 0, iCurrentDay = 0, iWeekDay = 0;
    var isShowFullCalendar = false, defaulTypeDay = TypeDayWork;
    
    var isAccessOnlyFuture = false;

    function CalendarInitialization(_isAccessOnlyFuture, _defaulTypeDay) {
        isAccessOnlyFuture = _isAccessOnlyFuture;
        defaulTypeDay = _defaulTypeDay;
        DateInitialization();
        //iDay = 31;
        //iCurrentDay = 31;
        UpdateCalendar();
    }
    
    function UpdateCalendar() {
        //LOG("UpdateCalendar")
        ShowMonth();
        ShowYear();
        if (isShowFullCalendar) {
            CreateArrayDaysForFullMonthDays();
            if (IsItJson(strJsonShedule))   ParseJsonShedule(JSON.parse(strJsonShedule));
            ShowArrayDays();
        }
        else {
            CreateArrayDaysForShortMonthDays(iCurrentDay);
            ShowArrayDays();
        }
        UpdateDay(GetIdCell(iSelectedDay, iSelectedMonth)-1);
    }
    function UpdateDay(index) {
        if (index < 0)  return;
        currentCell = index + 1;
        if (IsCurrentMonth())   ShowCurrentCell(currentCell, iCurrentDay);
        if (iSelectedDay > 0)   ShowSelectedCell(currentCell);
    }
    
    

    function OnClickCell(event) {
        var div = event.target;
        var cell = div.id;
        var index = cell.substring(4);
        index--;
        
        var day = arrayDays[index];
        var month = arrayMonthDays[index];
        var year = arrayYearDays[index];
        
        //LOG("day="+day+" month="+month+" index="+index)
        
        var isOk = true;
        if (! IsWorkDay(index))   isOk = false;     //  Проверяем, что это рабочий день
        else {
            if (isAccessOnlyFuture > 0)     //  Проверяем, что дата не меньше сегодня
                if ((year * 10000 + month * 100 + day * 1) < (iCurrentYear * 10000 + iCurrentMonth * 100 + iCurrentDay * 1))
                    isOk = false;
        }

        if (isOk) {
            if (iSelectedDay > 0)   ClearCell(currentCell, iSelectedDay);
            UpdateDay(index);
            iSelectedDay = day;
            iSelectedMonth = month;
            iSelectedYear = year;
            OnClickDay(iSelectedYear, iSelectedMonth, iSelectedDay);
        }
    }

    function OnClickPrevMonth() {
        var flag = true;
        
        if (isAccessOnlyFuture)
            if ((iCurrentYear * 100 + iCurrentMonth) >= (iCalendarYear * 100 + iCalendarMonth))    flag = false;

        if (flag) {
            PrevMonth();
            iDay = 0;
            SetFirstDayWeekOfMonth(iCalendarMonth);
            UpdateCalendar();
            DoWorkOnPrevMonth();
        }
    }

    function OnClickNextMonth() {
        NextMonth();
        iDay = 0;
        SetFirstDayWeekOfMonth(iCalendarMonth);
        UpdateCalendar();
        DoWorkOnNextMonth();
    }

    function OnClickOpenFullCalendar() {
        HideDiv("divBlockSwitchCalendar");
        isShowFullCalendar = true;
        DisplayDiv("tr3");
        DisplayDiv("tr4");
        DisplayDiv("tr5");
        UpdateCalendar();
    }

</script>