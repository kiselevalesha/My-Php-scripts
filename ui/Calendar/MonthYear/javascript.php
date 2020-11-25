<script type = "text/javascript">

    var iCalendarMonth = 0, iCalendarYear = 0;

    function DateInitialization() {
        SetCurrentTics();
        
        if (iCalendarYear == 0)     iCalendarYear = iCurrentYear;
        iSelectedYear = iCalendarYear;
        if (iCalendarMonth == 0)    iCalendarMonth = iCurrentMonth;
        iSelectedMonth = iCalendarMonth;
        if (iSelectedDay == 0)   iSelectedDay = iCurrentDay;

        SetFirstDayWeekOfMonth(iCalendarMonth);
    }
    
    function SetFirstDayWeekOfMonth(month) {
        var date = new Date(iCalendarYear, month-1, 1, 1, 1, 1, 1);
        iWeekDay = ConvertWeekDay(date.getDay());
    }
    function ConvertWeekDay(dayWeek) {
        switch(+dayWeek) {
            case 0: return 6;
            case 1: return 0;
            case 2: return 1;
            case 3: return 2;
            case 4: return 3;
            case 5: return 4;
            case 6: return 5;
        }
    }
    function GetWeekDay(year, month, day) {
        var date = new Date(year, month-1, day, 1, 1, 1, 1);
        return ConvertWeekDay(date.getDay());
    }

    function GetCountDays(month, year) {
        return GetCountDaysInMonth(month, year);
    }
    function GetCountDaysInMonth(month, year) {
        switch(+month) {
            case 1: return 31;
            case 2:
                switch (year) {
                    case 2016:
                    case 2020:
                    case 2024:
                    case 2028:
                    case 2032:
                    case 2036:
                        return 29;
                    default:
                        return 28;
                }
            case 3: return 31;
            case 4: return 30;
            case 5: return 31;
            case 6: return 30;
            case 7: return 31;
            case 8: return 31;
            case 9: return 30;
            case 10: return 31;
            case 11: return 30;
            case 12: return 31;
        }
        return 0;
    }

    function GetPreviousDay(year, month, day) {
        day--;
        if (day < 1) {
            month--;
            if (month < 1) {
                year--;
                month = 12;
            }
            day = GetCountDaysInMonth(month, year);
        }
        return (year * 10000 + month * 100 + day * 1);
    }

    function ShowYear() {
        SetValue("year", iCalendarYear);
    }

    function ShowMonth() {
        var strNameMonth = GetNameMonth(iCalendarMonth);
        if (IsSet(strNameMonth))    SetValue("month", strNameMonth.toUpperCase());
    }

    function PrevMonth() {
        iCalendarMonth--;
        if (iCalendarMonth < 1) {
            iCalendarMonth = 12;
            iCalendarYear--;
        }
        OnClickOpenFullCalendar();
    }

    function NextMonth() {
        iCalendarMonth++;
        if (iCalendarMonth > 12) {
            iCalendarMonth = 1;
            iCalendarYear++;
        }
        OnClickOpenFullCalendar();
    }
    
    
    function IsCurrentMonth() {
        if (iCurrentMonth == iCalendarMonth)
            if (iCurrentYear == iCalendarYear)    return true;
        return false;
    }

    
    function GetNameMonth(month) {
        switch(+month) {
            case 1: return "Январь";
            case 2: return "Февраль";
            case 3: return "Март";
            case 4: return "Апрель";
            case 5: return "Май";
            case 6: return "Июнь";
            case 7: return "Июль";
            case 8: return "Август";
            case 9: return "Сентябрь";
            case 10: return "Октябрь";
            case 11: return "Ноябрь";
            case 12: return "Декабрь";
        }
        return "";
    }
    function GetNameMonthR(month) {
        switch(+month) {
            case 1: return "Января";
            case 2: return "Февраля";
            case 3: return "Марта";
            case 4: return "Апреля";
            case 5: return "Мая";
            case 6: return "Июня";
            case 7: return "Июля";
            case 8: return "Августа";
            case 9: return "Сентября";
            case 10: return "Октября";
            case 11: return "Ноября";
            case 12: return "Декабря";
        }
        return "";
    }

</script>