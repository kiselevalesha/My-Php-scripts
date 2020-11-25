<script type = "text/javascript">

    function CreateCompactTableBlock(isShowFooter) {
        CreateArrayOf5Days();
        CreateGlobalArrayTimePeriods();
        
        for (var i = 0; i < array5Days.length; i++) {
            var indexYear = GetIndexYear(array5Days[i].year);
            var indexMonth = GetIndexMonth(indexYear, array5Days[i].month);
            array5Days[i].periods = CreatePeriodsForDay(indexYear, indexMonth, array5Days[i].day - 1, duration, beforeHoldMinutes);
        }
    }

    function CreateAndShowCompactTableBlock(isShowFooter) {
        CreateCompactTableBlock(isShowFooter);
        SetValue("divCompactTable", CreateCardCompactTable(isShowFooter));
    }
    
    function CreateCardCompactTable(isShowFooter) {
        return '<div class = "row card-panel" style="padding:0px; margin:0px;">' + CreateCompactTable(isShowFooter) + '</div>';
    }

    function CreateCompactTable(isShowFooter) {
        strDivCompactTable = GetBlockNavigate()
            + '<table>' 
            + CreateHeaderCompactTable(array5Days) 
            + CreateBodyCompactTable(array5Days);
            
        if (isShowFooter)
            strDivCompactTable = strDivCompactTable + CreateFooterCompactTable(array5Days);
            
        strDivCompactTable = strDivCompactTable + '</table>';
        return strDivCompactTable;
    }
    
    function GetBlockNavigate() {
        return '<table width=100%>'+
            '<tr>'+
                '<td width=25%><a href="javascript:void(0);" onclick="OnClickShiftLeftOn1Day()"><img align="left" src="/images/arrow-left.png" alt="left" style="width:23px;"></a></td>'+
                '<td width=25%><a href="javascript:void(0);" onclick="OnClickShiftLeftOn5Days()"><img align="left" src="/images/arrow-left.png" alt="left" style="width:23px;"><img align="left" src="/images/arrow-left.png" alt="left" style="width:23px;"></a></td>'+
                '<td width=25%><a href="javascript:void(0);" onclick="OnClickShiftRightOn5Days()"><img align="right" src="/images/arrow-right.png" alt="right" style="width:23px;"><img align="right" src="/images/arrow-right.png" alt="right" style="width:23px;"></a></td>'+
                '<td width=25%><a href="javascript:void(0);" onclick="OnClickShiftRightOn1Day()"><img align="right" src="/images/arrow-right.png" alt="right" style="width:23px;"></a></td>'+
            '</tr>'+
        '</table>';
    }
    
    function CreateHeaderCompactTable(arrayDaysPeriods) {
        var str = '<tr style="background-color:#EEE;">';
        
        str = str + '<td style="border-collapse: collapse; border-left: 0px solid black; border-right: 1px solid black;" width=20%>';
        str = str + '<div align="center"></div></td>';
        
        for (var i = 0; i < 5; i++) {
            str = str + '<td style="border-collapse: collapse; border-left: 1px solid black; border-right: 1px solid black;" width=15%>';
            str = str + '<div align="center">';
            str = str + '<a class="linkBlack" href="javascript:void(0);" onclick="OnClickPeriod('+arrayDaysPeriods[i].day+', '+arrayDaysPeriods[i].month+', '+arrayDaysPeriods[i].year+')">'+arrayDaysPeriods[i].day+'<br><b style="font-size:66%">'+arrayDaysPeriods[i].weekday+'</b></a>';
            str = str + '</div></td>';
        }
        str = str + '</tr>';
        return str;
    }
    
    function CreateFooterCompactTable(arrayDaysPeriods) {
        var str = '<tr>';
        
        str = str + '<td style="border-collapse: collapse; border-right: 1px solid black;" width=20%>';
        str = str + '<div align="center"></div></td>';
        
        for (var i = 0; i < 5; i++) {
            str = str + '<td style="border-collapse: collapse; border-left: 1px solid black; border-right: 1px solid black;" width=15%>';
            str = str + '<div align="center">';
            str = str + '<a class="linkBlack" href="javascript:void(0);" onclick="OnClickPeriod('+arrayDaysPeriods[i].day+', '+arrayDaysPeriods[i].month+', '+arrayDaysPeriods[i].year+')"><div><img src="/images/arrow-down.png" width=20px;></div></a>';
            str = str + '</div></td>';
        }
        str = str + '</tr>';
        return str;
    }
    
    function CreateBodyCompactTable(arrayDaysPeriods) {
        var str = '';
        for (var i = 0; i < arrayDaysPeriods[0].periods.length; i++) {
            var strTR = "";
            if (isOdd(i))   strTR = '<tr style="background-color:#EEE">';
            else            strTR = '<tr>';
            str = str + strTR + CreateColumnTime(+arrayTimePeriods[i].s) + CreateBodyCompactTableRow(arrayDaysPeriods, i) + '</tr>';
        }
        return str;
    }
    
    function CreateBodyCompactTableRow(arrayDaysPeriods, i) {
        //LOG("CreateBodyCompactTableRow")
        //LOG(arrayDaysPeriods)
        var str = '';
        for (var j = 0; j < arrayDaysPeriods.length; j++) {
            var period;
            if (arrayDaysPeriods[j].periods.length > i)
                period = arrayDaysPeriods[j].periods[i];
            else
                period = {w:TypeNotWork};
            var strBackClass = '';
            var strInnerDiv = '';
            if (period.w == TypeNotWork)    strBackClass = 'class="hatching-red"';
            else {
                var strCancelClass = '';
                <? // Если в period.x > 10, то это указание, что это отменённая Запись и её нужно соответственно показать ?>
                if (period.x >= TypeStatusCanceledAppointment) {
                    strCancelClass = 'hatching-cancel';
                }
                        
                switch (period.t) {
                    case TypePeriodAppointment:
                        var strBackColor = 'grey';
                        var p = period.p;
                        <? // Если в p > 10, то это указание, что это новая Запись и её нужно соответственно показать ?>
                        if (p > 10) {
                            p = p - 10;
                            strBackColor = 'black';
                        }
                        switch (p) {
                            case TypePartStart:
                                strInnerDiv = GetDivStartBuzy(strBackColor, period.s, period.x, strCancelClass);
                                break;
                            case TypePartMiddle:
                                strInnerDiv = GetDivMiddleBuzy(strBackColor, period.s, strCancelClass);
                                break;
                            case TypePartEnd:
                                strInnerDiv = GetDivEndBuzy(strBackColor, period.s, strCancelClass);
                                break;
                            case TypePartNone:
                            default:
                                break;
                        }
                        break;
                    case TypePeriodCurrentAppointment:
                        switch (period.p) {
                            case TypePartStart:
                                strInnerDiv = GetDivStartBuzy('black', period.s, period.x, strCancelClass);
                                break;
                            case TypePartMiddle:
                                strInnerDiv = GetDivMiddleBuzy('black', period.s, strCancelClass);
                                break;
                            case TypePartEnd:
                                strInnerDiv = GetDivEndBuzy('black', period.s, strCancelClass);
                                break;
                            case TypePartNone:
                            default:
                                break;
                        }
                        break;
                    case TypePeriodReservation:
                        strBackClass = 'class="hatching-green"';
                        break;
                    case TypePeriodNotSchedule:
                        strBackClass = 'class="hatching-red"';
                        break;
                    case TypePeriodNotAccess:
                        strBackClass = 'class="hatching-grey"';
                        break;
                    case TypePeriodFree:
                    default:
                        break;
                }
            }
                str = str + '<td '+strBackClass+' style="border-collapse:collapse; border-left:1px solid black; border-right:1px solid black; padding:0px;">';
                str = str + '<div>'

                if (strInnerDiv.length > 0) {
                    var strId = "'" +period.i+"'";
                    str = str + '<a class="linkBlack" href="javascript:void(0);" onclick="OnClickAppointment('+strId+')">' + strInnerDiv + '</a>'
                }
                else 
                    if (strBackClass.length == 0)
                        str = str + '<a class="linkBlack" href="javascript:void(0);" onclick="OnClickNew('+arrayDaysPeriods[j].year+','+arrayDaysPeriods[j].month+','+arrayDaysPeriods[j].day+','+arrayTimePeriods[i].s+')"><div>&nbsp;</div></a>'

                str = str + '</div>'
                str = str + '</td>';
        }
        return str;
    }
    
    function CreateColumnTime(time) {
        var hours = Math.floor(time / 100);
        var strTime = '';
        if ((hours * 100) == time)  strTime = '<b>' + GetFormatTime(time) + '</b>';
        else                        strTime = GetFormatTime(time);
        var str = '';
        str = str + '<td style="border-collapse:collapse; border-left:0px solid black; border-right:1px solid black; padding-top:10px; padding-bottom:10px;">';
        str = str + '<div align="center">' + strTime + '</div>';
        str = str + '</td>';
        return str;
    }
    
    
    //  функции создания заполненной ячейки (под записью)
    function GetDivStartBuzy(strColor, time, idOverlapping, strCancelClass) {
        if (idOverlapping >= 10)    idOverlapping = idOverlapping - 10;
        if (idOverlapping)
            return GetDivBuzyBase(null, 'red', strColor, time, strCancelClass);
        else
            return GetDivBuzyBase(null, strColor, strColor, time, strCancelClass);
    }
    function GetDivMiddleBuzy(strColor, time, strCancelClass) {
        return GetDivBuzyBase(strColor, strColor, strColor, time, strCancelClass);
    }
    function GetDivEndBuzy(strColor, time, strCancelClass) {
        return GetDivBuzyBase(strColor, strColor, null, time, strCancelClass);
    }
    function GetDivBuzyBase(strColor1, strColor2, strColor3, time, strCancelClass) {
        var bgColor1 = '';
        var clsBack1 = '';
        var strTextColor = "white";
        var strClass1 = '';
        if (strColor1 != null) {
            bgColor1 = 'background-color:'+strColor1+';';
            strClass1 = strCancelClass;
        }

        var bgColor2 = '';
        var clsBack2 = '';
        var strClass2 = '';
        if (strColor2 != null) {
            bgColor2 = 'background-color:'+strColor2+';';
            strClass2 = strCancelClass;
        }

        var bgColor3 = '';
        var clsBack3 = '';
        var strClass3 = '';
        if (strColor3 != null) {
            bgColor3 = 'background-color:'+strColor3+';';
            strClass3 = strCancelClass;
        }

        var strTime = '';
        if (+time > 0)    strTime = GetFormatTime(time);

        var str = '<div style="padding-left:5px;padding-right:5px;">';
            str = str + '<div class="'+strClass1+'" style="height:5px;'+bgColor1+';opacity: 0.85;"></div>';
            str = str + '<div align="center" class="'+strClass2+'" style="height:32px;'+bgColor2+' color:'+strTextColor+'; font-size:75%;opacity: 0.85;">'+strTime+'</div>';
            str = str + '<div class="'+strClass3+'" style="height:5px;'+bgColor3+';opacity: 0.85;"></div>';
        str = str + '</div>';
        return str;
    }

    function CreateBuzyBlockExample() {
        var str = '<br><table><tr style="border-collapse: collapse; border: 0px solid darkgrey;">'+
            '<td style="border-collapse: collapse; border: 1px solid darkgrey;" width="20%" class="hatching-red"></td>'+
            '<td>&nbsp; - Недоступное время</td>'+
            '</tr></table>'
        return str;
    }

</script>