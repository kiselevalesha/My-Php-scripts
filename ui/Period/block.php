<script type = "text/javascript">

    var now = new Date();

    var iStartPeriodYear = now.getFullYear();
    var iStartPeriodMonth = now.getMonth() + 1;
    var iStartPeriodDay = now.getDate();

    var iEndPeriodYear = now.getFullYear();
    var iEndPeriodMonth = now.getMonth() + 1;
    var iEndPeriodDay = now.getDate();

    var iStartTempYear, iStartTempMonth, iStartTempDay, iEndTempYear, iEndTempMonth, iEndTempDay;


    window.addEventListener("pageshow", function(event) {
        var strJsonRet = GetReturnValue();
        //LOG("strJsonRet="+strJsonRet);
        if (IsSet(strJsonRet)) {
            var ret = JSON.parse(strJsonRet);
            switch(+ret.id) {
                case TargetSelectStartPeriod:
                    iStartPeriodYear = ret.year;
                    iStartPeriodMonth = ret.month;
                    iStartPeriodDay = ret.day;
                    SetValue("divStartDateTime", GetStrFromShortDate(GetStartPeriod()));
                    OnChangeStartPeriodFunction();
                    break;
                case TargetSelectEndPeriod:
                    iEndPeriodYear = ret.year;
                    iEndPeriodMonth = ret.month;
                    iEndPeriodDay = ret.day;
                    SetValue("divEndDateTime", GetStrFromShortDate(GetEndPeriod()));
                    OnChangeEndPeriodFunction();
                    break;
            }
        }
        ClearReturnValue();
    });

    function GetStartPeriod() {
        return (GetStartPeriodDate() * 10000) * 100;
    }
    function GetStartPeriodDate() {
        return (iStartPeriodYear * 10000 + iStartPeriodMonth * 100 + iStartPeriodDay * 1);
    }
    function GetEndPeriod() {
        return (GetEndPeriodDate() * 10000 + 2400) * 100;
    }
    function GetEndPeriodDate() {
        return (iEndPeriodYear * 10000 + iEndPeriodMonth * 100 + iEndPeriodDay * 1);
    }


    function GetStartTemp() {
        return "" + (iStartTempYear * 10000 + iStartTempMonth * 100 + iStartTempDay * 1);
    }
    function GetEndTemp() {
        return "" + (iEndTempYear * 10000 + iEndTempMonth * 100 + iEndTempDay * 1);
    }


    function OnClickStartPeriod() {
        OnSaveFunction();
        GoTo('selectDateTime.php?ret='+TargetSelectStartPeriod+'&year='+iStartPeriodYear+'&month='+ iStartPeriodMonth+'&day='+iStartPeriodDay+'&isShowTime=0');
    }
    function OnClickEndPeriod() {
        OnSaveFunction();
        GoTo('selectDateTime.php?ret='+TargetSelectEndPeriod+'&year='+iEndPeriodYear+'&month='+ iEndPeriodMonth+'&day='+iEndPeriodDay+'&isShowTime=0');
    }
    
    function SetStartEndPeriod() {
        SetValue("divStartDateTime", GetStrFromShortDate(GetStartPeriod()));
        SetValue("divEndDateTime", GetStrFromShortDate(GetEndPeriod()));
    }
    
    function OnClickOpenFullPeriod() {
        HideDiv("divBlockSwitchPeriod");
        SetValue("divListTemplates", GetDivListTemplates());
    }
    
    function GetDivItemTemplate(strTitle, start, end, id) {
        var strRange = GetStrFromShortDate(start) + " - " + GetStrFromShortDate(end);
        return '<a href="javascript:void(0);" onclick="onClickTemplateItem(' + start + ',' + end + ')" style="color:black;">'+
            '<div class=" card-panel" style="padding:15px;margin:10px;">'+
            '<h5 style="margin:0px;">' + strTitle + '</h5>'+
            '<b id="period1" style="font-size: 75%;">' + strRange + '</b>'+
        '</div></a>';
    }
    function GetDivListTemplates() {
        var str = "<hr>";
        
        iStartTempYear = now.getFullYear();
        iStartTempMonth = now.getMonth() + 1;
        iStartTempDay = now.getDate();
        iEndTempYear = now.getFullYear();
        iEndTempMonth = now.getMonth() + 1;
        iEndTempDay = now.getDate();
        str = str + GetDivItemTemplate("За сегодня", GetStartTemp(), GetEndTemp(), 1);
        
        
        iStartTempYear = now.getFullYear();
        iStartTempMonth = now.getMonth() + 1;
        iStartTempDay = now.getDate();
        
        var maxCount = 10;
        while((GetWeekDay(iStartTempYear, iStartTempMonth, iStartTempDay) != 0) && (maxCount > 0)) {
            var date = GetPreviousDay(iStartTempYear, iStartTempMonth, iStartTempDay)
            iStartTempYear = +GetYearFromLongDate(date);
            iStartTempMonth = +GetMonthFromLongDate(date);
            iStartTempDay = +GetDayFromLongDate(date);
            maxCount--;
        }

        iEndTempYear = now.getFullYear();
        iEndTempMonth = now.getMonth() + 1;
        iEndTempDay = now.getDate();
        str = str + GetDivItemTemplate("С начала недели", GetStartTemp(), GetEndTemp(), 2);

        iStartTempYear = now.getFullYear();
        iStartTempMonth = now.getMonth() + 1;
        iStartTempDay = now.getDate() - 7;
        if (iStartTempDay <= 0) {
            iStartTempMonth--;
            if (iStartTempMonth <= 0) {
                iStartTempMonth = iStartTempMonth + 12;
                iStartTempYear--;
            }
            iStartTempDay = GetCountDaysInMonth(iStartTempMonth, iStartTempYear);
        }
        iEndTempYear = now.getFullYear();
        iEndTempMonth = now.getMonth() + 1;
        iEndTempDay = now.getDate();
        str = str + GetDivItemTemplate("За 7 дней", GetStartTemp(), GetEndTemp(), 3);

        iStartTempYear = now.getFullYear();
        iStartTempMonth = now.getMonth() + 1;
        iStartTempDay = 1;
        iEndTempYear = now.getFullYear();
        iEndTempMonth = now.getMonth() + 1;
        iEndTempDay = now.getDate();
        str = str + GetDivItemTemplate("С начала месяца", GetStartTemp(), GetEndTemp(), 4);

        iStartTempYear = now.getFullYear();
        iStartTempMonth = now.getMonth();
        if (iStartTempMonth == 0) {
            iStartTempMonth = 12;
            iStartTempYear--;
        }
        iStartTempDay = now.getDate();
        iEndTempYear = now.getFullYear();
        iEndTempMonth = now.getMonth() + 1;
        iEndTempDay = now.getDate();
        str = str + GetDivItemTemplate("За месяц", GetStartTemp(), GetEndTemp(), 5);

        iStartTempYear = now.getFullYear();
        iStartTempMonth = now.getMonth() + 1;
        iStartTempDay = 1;
        iEndTempYear = now.getFullYear();
        iEndTempMonth = now.getMonth() + 1;
        iEndTempDay = now.getDate();
        str = str + GetDivItemTemplate("С начала квартала", GetStartTemp(), GetEndTemp(), 6);


        iStartTempYear = now.getFullYear();
        iStartTempMonth = now.getMonth() - 2;
        if (iStartTempMonth <= 0) {
            iStartTempMonth = iStartTempMonth + 12;
            iStartTempYear--;
        }
        iStartTempDay = now.getDate();
        iEndTempYear = now.getFullYear();
        iEndTempMonth = now.getMonth() + 1;
        iStartTempDay = now.getDate();
        str = str + GetDivItemTemplate("За 3 месяца", GetStartTemp(), GetEndTemp(), 7);

        iStartTempYear = now.getFullYear();
        iStartTempMonth = 1;
        iStartTempDay = 1;
        iEndTempYear = now.getFullYear();
        iEndTempMonth = 6;
        iEndTempDay = 30;
        str = str + GetDivItemTemplate("За 1-е полугодие", GetStartTemp(), GetEndTemp(), 8);

        iStartTempYear = now.getFullYear();
        iStartTempMonth = now.getMonth() - 5;
        if (iStartTempMonth <= 0) {
            iStartTempMonth = iStartTempMonth + 12;
            iStartTempYear--;
        }
        iStartTempDay = now.getDate();
        iEndTempYear = now.getFullYear();
        iEndTempMonth = now.getMonth() + 1;
        iStartTempDay = now.getDate();
        str = str + GetDivItemTemplate("За 6 месяцев", GetStartTemp(), GetEndTemp(), 9);
        
        iStartTempYear = now.getFullYear();
        iStartTempMonth = 7;
        iStartTempDay = 1;
        iEndTempYear = now.getFullYear();
        iEndTempMonth = 12;
        iEndTempDay = 31;
        str = str + GetDivItemTemplate("За 2-е полугодие", GetStartTemp(), GetEndTemp(), 10);

        iStartTempYear = now.getFullYear() - 1;
        iStartTempMonth = now.getMonth() + 1;
        iStartTempDay = now.getDate();
        iEndTempYear = now.getFullYear();
        iEndTempMonth = now.getMonth() + 1;
        iEndTempDay = now.getDate();
        str = str + GetDivItemTemplate("За 12 месяцев", GetStartTemp(), GetEndTemp(), 11);

        iStartTempYear = now.getFullYear();
        iStartTempMonth = 1;
        iStartTempDay = 1;
        iEndTempYear = now.getFullYear();
        iEndTempMonth = now.getMonth() + 1;
        iEndTempDay = now.getDate();
        str = str + GetDivItemTemplate("С начала года", GetStartTemp(), GetEndTemp(), 12);

        iStartTempYear = now.getFullYear() - 1;
        iStartTempMonth = 12;
        iStartTempDay = 1;
        iEndTempYear = now.getFullYear();
        iEndTempMonth = 2;
        iEndTempDay = 28;
        str = str + GetDivItemTemplate("За зиму", GetStartTemp(), GetEndTemp(), 13);

        iStartTempYear = now.getFullYear();
        iStartTempMonth = 3;
        iStartTempDay = 1;
        iEndTempYear = now.getFullYear();
        iEndTempMonth = 5;
        iEndTempDay = 31;
        str = str + GetDivItemTemplate("За весну", GetStartTemp(), GetEndTemp(), 14);

        iStartTempYear = now.getFullYear();
        iStartTempMonth = 6;
        iStartTempDay = 1;
        iEndTempYear = now.getFullYear();
        iEndTempMonth = 8;
        iEndTempDay = 30;
        str = str + GetDivItemTemplate("За лето", GetStartTemp(), GetEndTemp(), 15);

        iStartTempYear = now.getFullYear();
        iStartTempMonth = 9;
        iStartTempDay = 1;
        iEndTempYear = now.getFullYear();
        iEndTempMonth = 11;
        iEndTempDay = 30;
        str = str + GetDivItemTemplate("За осень", GetStartTemp(), GetEndTemp(), 16);
        
        return str;
    }
    function onClickTemplateItem(start, end){
        start = "" + start;
        iStartTempYear = + start.substring(0, 4);
        iStartTempMonth = + start.substring(4, 6);
        iStartTempDay = + start.substring(6, 8);
        
        end = "" + end;
        iEndTempYear = + end.substring(0, 4);
        iEndTempMonth = + end.substring(4, 6);
        iEndTempDay = + end.substring(6, 8);
        
        iStartPeriodYear = iStartTempYear;
        iStartPeriodMonth = iStartTempMonth;
        iStartPeriodDay = iStartTempDay;
        iEndPeriodYear = iEndTempYear;
        iEndPeriodMonth = iEndTempMonth;
        iEndPeriodDay = iEndTempDay;
        SetStartEndPeriod();
        
        ShowDiv("divBlockSwitchPeriod");
        SetValue("divListTemplates", "");
    }

</script>

<? // $strButtonName, $strOnClickFunction - можно установить эти переменные, чтобы появилась стартовая кнопка ?>
<div id="divBlockPeriod" style="display:none;padding:0px;padding-top:10px;" class = "card-panel" align="center">
    <h5>Укажите период</h5>

    <table>
        <tr style="border: 0px solid black;">
            <td>
                <div align="right">
                <a class="linkWhite" href="javascript:void(0);" onclick="OnClickStartPeriod()">
                    <div id="divStartDateTime" style="background-Color:black; color:white;display: inline-block; padding:20px; padding-left:15px; padding-right:15px; margin: 0px;"><h6></h6></div>
                </a>
                </div>
            </td>
            <td><div align="center">-</div></td>
            <td>
                <div align="left">
                <a class="linkWhite" href="javascript:void(0);" onclick="OnClickEndPeriod()">
                    <div id="divEndDateTime" style="background-Color:black; color:white;display: inline-block; padding: 20px; padding-left:15px; padding-right:15px; margin: 0px;"><h6></h6></div>
                </a>
                </div>
            </td>
        </tr>
    </table>
    <br>
    
    <div id="divListTemplates"></div>

    <?
        if (!empty($strButtonName))
            if (!empty($strOnClickFunction)) {
                echo '<div style="background-color:lightgrey;padding-bottom:5px;">';
                GetDivCenterButton($strButtonName, $strOnClickFunction);
                echo '</div>';
            }
    ?>



    
</div>
<div align="right" id="divBlockSwitchPeriod">
    <a href="javascript:void(0);" onclick="OnClickOpenFullPeriod()">
        <div style="padding:0px; margin: 0px;">
            <div style=" padding: 3px 15px 3px 15px; margin: 0px;"><img src="/images/arrow-down.png" width=20px;></div>
        </div> 
    </a>
</div>   
