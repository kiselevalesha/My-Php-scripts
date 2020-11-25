<script type = "text/javascript">

    var currentCell = 0;
    var maxCountCellsInMonth = 0;
    
    var arrayDays = [];
    var arrayColors = [];
    var arrayTypeDays = [];
    var arrayMonthDays = [];
    var arrayYearDays = [];
    
    const TypeDayWork = 1;
    const TypeDayVacancy = 2;
    

    function ShowArrayDays() {
        ClearDays();
        for (var i = 0; i < arrayDays.length; i++) {
            var day = arrayDays[i];
            if (arrayTypeDays[i] == TypeDayWork)    SetCell((i + 1), day, GetDayColor(arrayColors[i]), "black");
            else                                    SetCell((i + 1), day, GetDayColor(arrayColors[i]), "lightgrey");
        }
        if ((arrayDays.length) < 36)    HideDiv("tr6");
        else                            DisplayDiv("tr6");
    }
    
    function CreateArrayDaysForFullMonthDays() {
        CreateArrayDays(1, GetCountDays(iCalendarMonth, iCalendarYear));
        
        <? // Удаляем добавленные лишние дни следующего месяца. ?>
        var minusDays = 0;
        for (var i = arrayDays.length; i > 30; i--)
            if (arrayDays[i] < 20)
                minusDays++;

        var length = arrayDays.length;
        <? // Удаляем одну или две недели следующего месяца. ?>
        if (minusDays > 13)  length = length - 14;
        else if (minusDays > 6)  length = length - 7;

        var arrayDaysTemp = arrayDays;
        arrayDays = [];
        for (var i = 0; i < length; i++)
            arrayDays.push(arrayDaysTemp[i]);
        
        return arrayDays;
    }
    
    function CreateArrayDaysForShortMonthDays(iCurDay) {
        CreateArrayDays(1, GetCountDays(iCalendarMonth, iCalendarYear));

        <? //  Теперь надо сжать весь массив до 14 дней, найдя текущую неделю. ?>
        <? //  Найдём текущий день в массиве. ?>
        var indexStart = 0;
        for (var i = 0; i < arrayDays.length; i++)
            if (iCurDay == arrayDays[i])
                if (iCalendarMonth == arrayMonthDays[i]) {
                    indexStart = i;
                    break;
                }
                
        <? //  Рассчитаем от начала недели ?>
        var indexa = Math.floor(indexStart / 7);
        var nachalo = indexa * 7;

        arrayTempDays = [];
        arrayTempColors = [];
        arrayTempTypeDays = [];
        arrayTempMonthDays = [];
        arrayTempYearDays = [];
        
        for (var i = 0; i < 14; i++) {
            arrayTempDays.push(arrayDays[nachalo + i]);
            arrayTempColors.push(arrayColors[nachalo + i]);
            arrayTempTypeDays.push(arrayTypeDays[nachalo + i]);
            arrayTempMonthDays.push(arrayMonthDays[nachalo + i]);
            arrayTempYearDays.push(arrayYearDays[nachalo + i]);
        }

        arrayDays = arrayTempDays;
        arrayColors = arrayTempColors;
        arrayTypeDays = arrayTempTypeDays;
        arrayMonthDays = arrayTempMonthDays;
        arrayYearDays = arrayTempYearDays;

        return arrayDays;
    }
    
    function CreateArrayDays(startDay, countDays) {
        arrayDays = [];
        arrayColors = [];
        arrayTypeDays = [];
        arrayMonthDays = [];
        arrayYearDays = [];
        
        <? //  Загрузим дни предыдущего месяца, попадающие в первую неделю месяца. ?>
        if ((iWeekDay + startDay) < 8) {
            var iPrevYear = iCalendarYear;
            var iPrevMonth = (+iCalendarMonth-1);
            if (iPrevMonth < 1) {
                iPrevMonth = 12;
                iPrevYear--;
            }
            
            var iPrevDay = GetCountDays(iPrevMonth, iPrevYear) - iWeekDay + 1;
            for (var i=0; i < iWeekDay; i++) {
                arrayDays.push(i + iPrevDay);
                arrayColors.push(0);
                arrayTypeDays.push(defaulTypeDay);
                arrayMonthDays.push(iPrevMonth);
                arrayYearDays.push(iPrevYear);
            }
        }


        var count = countDays;
        if (countDays > 14) count = countDays;
        else {
            if (startDay < 15)  count = countDays - iWeekDay;
            else                count = countDays - (GetCountDays(iCalendarMonth, iCalendarYear) - startDay + 1);
        }

        for (var i=0; i < count; i++) {
            arrayDays.push(i + startDay);
            arrayColors.push(0);
            arrayTypeDays.push(defaulTypeDay);
            arrayMonthDays.push(iCalendarMonth);
            arrayYearDays.push(iCalendarYear);
        }
        
        
        <? //  Загрузим дни следующего месяца, попадающие в последнюю неделю месяца. ?>
        var iNextYear = iCalendarYear;
        var iNextMonth = (+iCalendarMonth+1);
        if (iNextMonth > 12) {
            iNextMonth = 1;
            iNextYear++;
        }

        var iTotalDays = iWeekDay + countDays;
        maxCountCellsInMonth = 49;

        if (iTotalDays <= maxCountCellsInMonth) {
            for (var i=0; i < (maxCountCellsInMonth - iTotalDays); i++) {
                arrayDays.push(i + 1);
                arrayColors.push(0);
                arrayTypeDays.push(defaulTypeDay);
                arrayMonthDays.push(iNextMonth);
                arrayYearDays.push(iNextYear);
            }
        }
        
        //LOG(arrayDays)
        return arrayDays;
    }
    
    function IsWorkDay(index) {
        var isShowAsWorkDay = true;
        if (arrayTypeDays.length > index)
                if (arrayTypeDays[index] != TypeDayWork)  isShowAsWorkDay = false;
        return isShowAsWorkDay;
    }
    function ClearDays() {
        for (var i = 1; i <= maxCountCellsInMonth; i++) {
            SetCell(i, "", "white", "black");
        }
    }
    
    function ShowDay(day, value) {
        var divDay = document.getElementById('cell' + day);
        if (divDay != null)    divDay.innerHTML = value;
    }

    function ShowColorCell(cell, colorBack, colorText) {
        var divCell = document.getElementById('cell' + cell);
        if (divCell != null)    divCell.style = "background-color:" + colorBack + "; color:" + colorText + "; padding: 6px; margin: 0px;";
    }
    function ShowCurrentCell(cell, day) {
        if (IsWorkDay(day))     ShowColorCell(cell, "lightgrey", "black");
        else                    ShowColorCell(cell, "lightgrey", "grey");
    }
    function ShowSelectedCell(cell) {
        ShowColorCell(cell, "black", "white");
    }
    function ClearCell(cell, day) {
        if (IsWorkDay(cell))     ShowColorCell(cell, "white", "black");
        else                    ShowColorCell(cell, "white", "lightgrey");
    }
    
    function GetIdCell(day, month) {
        for (var i = 0; i <= arrayDays.length; i++)
            if (arrayDays[i] == day)
                if (arrayMonthDays[i] == month) {
                    return i + 1;
                }
        return 0;
    }

    function SetCell(cell, day, colorBack, colorText) {
        var divCell = document.getElementById('cell' + cell);
        if (divCell != null) {
            divCell.innerHTML = day;
            divCell.style = "background-color:" + colorBack + "; color:" + colorText + "; padding: 6px; margin: 0px;";
        }
    }
    
    
    function GetNameWeekDayRussian(iWeekDay) {
        var str = "";
        switch (iWeekDay+1) {
            case 1: str = 'ПН'; break;
            case 2: str = 'ВТ'; break;
            case 3: str = 'СР'; break;
            case 4: str = 'ЧТ'; break;
            case 5: str = 'ПТ'; break;
            case 6: str = 'СБ'; break;
            case 7: str = 'ВС'; break;
        }
        return str;
    }

</script>