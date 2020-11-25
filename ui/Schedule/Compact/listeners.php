<script type = "text/javascript">

    //  Обработчик открытия блока - дней календаря
    function OnClickShowCalendar() {
        HideDiv("divBlockSwitchCalendar");
        isShowFullCalendar = true;
        DisplayDiv("tr3");
        DisplayDiv("tr4");
        DisplayDiv("tr5");
        UpdateCalendar();
        MakeArrayTypeDays();
        ShowCalendar();
        ShowDiv("divCalendar");
        //UpdateCalendar();
        //ShowCalendar();
    }

    //  Обработчики блока кнопок навигации - смещения по дням - влево-вправо
    function OnClickShiftRightOn1Day(index) {
        ChangeSelectedDate(1);
    }
    function OnClickShiftRightOn5Days() {
        ChangeSelectedDate(5);
    }
    
    function OnClickShiftLeftOn1Day() {
        ChangeSelectedDate(-1);
    }
    function OnClickShiftLeftOn5Days() {
        ChangeSelectedDate(-5);
    }

</script>