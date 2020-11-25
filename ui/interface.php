<?

function GetDivPeriodPanel() {
    GetDivPeriodPanelInner("Рассчитать", "OnClickStart");
}
function GetDivPeriodPanelInner($strButtonName, $strOnClickFunction) {
?>
<div class = "card-panel" align="center">
    <div class = "row">
        <h5>Укажите период</h5>
    </div>

    <table>
        <tr>
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

    <div>
        <?
            if (! empty($strButtonName))
                GetDivCenterButton($strButtonName, $strOnClickFunction);
        ?>
    </div>
</div>
<?
}


function ShowDivChart($strNameChart, $strDescription) {
    echo '<div id="div'.$strNameChart.'"><br><br><br>';
        GetDivHelpInfo($strDescription);
        echo '<div style="height:100%;padding:0px;">';
            echo '<canvas id="'.$strNameChart.'" width="400" height="400"></canvas>';
        echo '</div>';
    echo '</div>';
}


function GetDivWaiting() {
    echo '<br><div align="center" style="display:block; height:100%;" id="divWait"><br><br><br><br><br><img src="/images/progress1.gif" width=50px;><br><br><br><br><br></div>';
}
function GetDivWaitPage($idPage) {
    echo '<br><div align="center" style="display:block; height:100%;" id="divWait'.$idPage.'"><br><br><br><br><br><img src="/images/progress1.gif" width=50px;><br><br><br><br><br></div>';
}
function GetDivsWaitingAndEror($idPage) {
    echo '<div align="center" style="display:block; height:100%;" id="divWait'.$idPage.'"><br><br><br><br><br><img src="/images/progress1.gif" width=50px;><br><br><br><br><br></div>';
    echo '<div id="divError'.$idPage.'"></div>';
}


function GetDivTalk($strMessaga) {
    echo '<div style="background-color:#DDD; padding-top:15px; padding-bottom:15px;"><div id="divDivider"></div>';
    echo '<div style="">';
    $strMessage = $strMessaga;
    require '../php-scripts/ui/Talk/uiTalk.php';
    echo '</div></div>';
    GetDivPlusButton('href="javascript:void(0);" onclick="OnClickAddMessage()"');
}

function GetDivTopMenuTalon($strMenuTitle) {
    $iconLeft = " ";
    $iconRight = " ";
    $strLinkLeft = "";
    $strLinkRight = "";
    require_once "../php-scripts/ui/TopMenu/uiTopMenu.php";
}
function GetDivTopMenuMain($strMenuTitle) {
    GetDivTopMenuCustomBackIcon($strMenuTitle, "menu.php", "menu");
}
function GetDivTopMenu($strMenuTitle) {
    GetDivTopMenuCustomBack($strMenuTitle, "");
}
function GetDivTopMenuCustomBack($strMenuTitle, $strUrlBack) {
    GetDivTopMenuCustomBackIcon($strMenuTitle, $strUrlBack, "arrow_back");
}
function GetDivTopMenuCustomBackIcon($strMenuTitle, $strUrlBack, $strIcon) {
    $iconLeft = $strIcon;
    $strLinkLeft = $strUrlBack;
    $strLinkRight = "settings.php";
    require_once "../php-scripts/ui/TopMenu/uiTopMenu.php";
}
function GetDivPlusButton($strHref) {
    GetDivPlusButtonSource($strHref, "divPlusButton");
}
function GetDivPlusButtonSource($strHref, $strId) {
?>
<div id="<? echo $strId; ?>" style="display:none;" align="right"><br><a class="btn-floating btn-large waves-effect waves-light red" <? echo $strHref; ?>><i class="material-icons">add</i></a><br></div>
<?
}
function GetDivTopLine() {
    echo '<div class="header"> </div>';
}

function GetDivSteps($step) {
    $step1 = true;
    $step2 = false;
    if ($step > 1)  $step2 = true;
    /*$step3 = false;
    if ($step > 2)  $step3 = true;*/
?>
<div align="center">
    <div style="background-Color:lightgrey; display: inline-block; padding: 10px 20px 10px 20px; margin: 0px;">
        <img src="/images/dotFull.png" width=20px;>
        <img src="/images/<? if ($step2) echo "dotFull"; else echo "dotEmpty"; ?>.png" width=20px;>
    </div>
</div>
<?
}

function GetDivListMenuItemId($strLink, $strTitle, $strDescription, $strId) {
    GetDivListMenuItemSource($strLink, $strTitle, $strDescription, "", $strId, "30px", "20px");
}

function GetDivListMenuItem($strLink, $strTitle, $strDescription, $strComment) {
    GetDivListMenuItemSource($strLink, $strTitle, $strDescription, $strComment, "", "30px", "20px");
}

function GetDivListMenuItemSource($strLink, $strTitle, $strDescription, $strComment, $strDivComment, $paddingTop, $paddingBottom) {
?>
    <a href="<? echo $strLink; ?>" style="color:black;">
        <div class = "row card-panel" style="border-left: 10px solid black; padding: 0px; font-family:Verdana;">
            <table width=100%><tr>
                <td width=1%></td>
                <td>
                    <div align="left" style="padding: 1px 0px <? echo $paddingTop.' '.$paddingBottom; ?>;">
                        <div><h3><? echo $strTitle; ?></h3></div>
                        <div><? echo $strDescription; ?></div>
                        <div style="margin-top:5px;" id="<? echo $strDivComment; ?>"><b><? echo $strComment; ?></b></div>
                    </div>
                </td>
                <td><img align="right" src="images/arrow-right.png" alt=">" style="width:23px;"></td>
                <td width=1%></td>
            </tr></table>
        </div>
    </a>
<?
}


function GetDivHelpInfo($strDescription) {
?>
    <br>
    <? GetDivHelpInfoSource($strDescription); ?>
    <br>
<?
}
function GetDivHelpInfoSource($strDescription) {
?>
    <a style="color:black;" href="javascript:void(0);" onclick="OnClickSpeech('<? echo $strDescription; ?>')">
        <div class = "row card-panel" style="border-left: 5px solid red; padding: 0px; font-family:Verdana;">
            <table width=100%><tr>
                <td width=1%><img align="right" src="images/robot.svg" alt="" style="width:60px;"></td>
                <td width=98%>
                    <div align="left" style="padding: 10px;">
                        <div><h6 style="line-height: 150%;"><? echo $strDescription; ?></h6></div>
                    </div>
                </td>
                <td width=1%></td>
            </tr></table>
        </div>
    </a>
<?
}

function GetDivSalon($strName, $strDescription) {
?>
    <a style="color:black;">
        <div class = "row card-panel" style="border-left: 10px solid black; border-right: 10px solid black; padding: 10px; font-family:Verdana;" align="center">
            <div><h4><? echo $strName; ?></h4></div>
            <div><h6><? echo $strDescription; ?></h6></div><br>
        </div>
    </a>
<?
}

function GetDivMaster($strName, $strSpecialization, $strPhoto) {
?>
    <a style="color:black;">
        <div class = "row card-panel" style="border-left: 10px solid black; border-right: 10px solid black; padding: 10px; font-family:Verdana;" align="center">
            <div><img align="center" src="<? echo $strPhoto; ?>" alt="" class="avatar" style="width:60px;"></div>
            <div><h4><? echo $strName; ?></h4></div>
            <div><h6><? echo $strSpecialization; ?></h6></div><br>
        </div>
    </a>
<?
}


function GetDivGoBackButton() {
?>
    <div class = "row">
        <div class = "input-field col s8">
            <a class="linkWhite" href="javascript:void(0);" onclick="GotoBackPage()">
                <div style="color:grey; padding: 5px 20px 5px 20px; margin: 0px;"><h5><img src="/images/arrow-left-grey.png" width="20px;"> Вернуться</h5></div>
            </a>
        </div>
       
        <div class = "input-field col s4">
        </div>
    </div>
<?
}

// Это пока нигде не используется !
function GetDivGoBackIndexAndNextButtons() {
?>
    <div class = "row">
        <div class = "input-field col s6">
            <a class="linkWhite" href="index.php">
                <div style="color:grey; padding: 5px; margin: 0px;"><h5><img src="/images/arrow-left-grey.png" width="20px;"> Назад</h5></div>
            </a>
        </div>
       
        <div class = "input-field col s6">
            <div align="right" style="display:none;" id="divWaitNext">
                <img src="/images/progress1.gif" width=50px;>
            </div>

            <div align="right" id="divNextButton">
                <a class="linkWhite" href="javascript:void(0);" onclick="OnClickStepNext()">
                    <div style="background-Color:black; color:white;display: inline-block; padding: 5px 20px 5px 20px; margin: 0px;"><h5>Далее</h5></div>
                </a>
            </div>
        </div>
    </div>
<?
}


function GetDivGoBackAndNextButtons() {
    return GetDivGoBackAndNextButtonsWithNames("Назад", "Далее");
}

function GetDivGoBackAndNextButtonsWithNames($strBack, $strNext) {
?>
    <div class = "row" id="divBlockPrevNext" style="display:none;">
       <div class = "input-field col s6">
            <a class="linkWhite" href="javascript:void(0);" onclick="GotoBackPage()">
                <div style="color:grey; padding: 5px; margin: 0px;"><h5><img src="/images/arrow-left-grey.png" width=20px;> <?echo $strBack;?></h5></div>
            </a>
       </div>
       
       
        <div class = "input-field col s6">
            <div align="right" style="display:none;" id="divWaitNext">
                <img src="/images/progress1.gif" width=50px;>
            </div>

            <div align="right" id="divNextButton">
                <a class="linkWhite" href="javascript:void(0);" onclick="OnClickNext()">
                    <div style="background-Color:black; color:white;display: inline-block; padding: 5px 20px 5px 20px; margin: 0px;"><h5><?echo $strNext;?></h5></div>
                </a>
            </div>
        </div>
    </div>
<?
}


function GetDivFooter() {
    global $strTitleService;
    require_once '../php-scripts/ui/footer.php';
}
function GetDivFooter2() {
    global $strTitleService;
    require_once '../php-scripts/ui/footer2.php';
}
function GetDivFooter3() {
    global $strTitleService;
    require_once '../php-scripts/ui/footer3.php';
}


function GetDivSelectableService() {
?>
      <div class = "row card-panel" style="border-left: 5px solid black; padding: 15px;">
        <div style="padding:0px 0px 0px 15px;">
            <h5>Sewase sdjhk ldfj lsdjf ljsf lide uweir Sewase sdjhk ldfj lsdjf ljsf lide uweir</h5>
        </div>
        <div>
           <div class = "col s8">
              <div class="grey lighten-1" style="display: inline-block; padding:10px 15px 10px 15px; margin:2px">
                  <div style="display: inline-block;"><img src="/images/price.png" width=15px;></div>
                  <div style="display: inline-block;"><b> 1256</b> руб.</div>
              </div>
              <div class="grey lighten-2" style="display: inline-block; padding:10px 15px 10px 15px; margin:2px;">
                  <div style="display: inline-block;"><img src="/images/clock.png" width=15px;></div>
                  <div style="display: inline-block;"><b>1</b> ч. <b>30</b> мин.</div>
              </div>
           </div>
           
           <div class = "col s4" align="right">
            <div class="switch">
                <label>
                  <input type="checkbox" id="profile-switch-input" name="swo" onclick="OnClickSwitch(this)">
                  <span id="profile-switch-lever" class="lever black"></span>
                </label>
            </div>
           </div>
        </div>
      </div>
<?
}

function GetDivButtonSave() {
    GetDivCenterButton("Сохранить", "OnClickSave");
}
function GetDivCenterButton($strTitleButton, $strOnClickFunction) {
    GetDivCenterColorButton($strTitleButton, $strOnClickFunction, "black");
}
function GetDivCenterColorButton($strTitleButton, $strOnClickFunction, $colorBack) {
?>
    <br>
    <div class = "row">
        <div class = "col s12" align="center">
            <a class="linkWhite" href="javascript:void(0);" onclick="<? echo $strOnClickFunction; ?>()">
                <div style="background-color:<? echo $colorBack; ?>; color:white;display: inline-block; padding: 5px 20px 5px 20px; margin: 0px;"><h5><? echo $strTitleButton; ?></h5></div>
            </a>
        </div>
    </div>
<?
}


function GetHead() {
    global $strTitle;
?>
    <title><? echo $strTitle; ?></title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">      
    <?    require '../css/css.css'; ?>
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<?
}


function GetDivCompactItems($strOnClickFunction) {
?>
<br><br>
<table style="margin:0px;">
    <tr>
        <td style="margin:0px; padding:0px;"><hr></td>
        <td width=1% style="margin:0px; padding:0px;">
            <a class="linkBlack" href="javascript:void(0);" onclick="<? echo $strOnClickFunction; ?>()">
            <div style="background-color:grey;padding:2px; display: inline-block; margin:0px;">
                <div style="background-color:white; padding-left:20px; padding-right:20px; padding-bottom:10px;" align="center">
                    <div style="display: inline-block;"><b>...</b></div>
                </div>
            </div>
            </a>
        </td>
        <td style="margin:0px; padding:0px;"><hr></td>
    </tr>
</table>
<br><br>
<?
}



function GetTab3($num, $strOnClickFunction, $strTitleTab) {
?>
    <div class = "col s4" style="padding:0px; margin: 0px;">
        <div style="background-color:white; padding:2px; margin: 0px;" id="divTopLine<? echo $num; ?>"></div>
       <a href="javascript:void(0);" onclick="<? echo $strOnClickFunction; ?>()">
           <div align="center" style="background-color:white; color:black; padding: 15px 0px 15px 0px; margin: 0px;" id="divBack<? echo $num; ?>"><h6><? echo $strTitleTab; ?></h6></div>
       </a>
       <div style="background-color:black; padding:2px; margin: 0px;" id="divBottomLine<? echo $num; ?>"></div>
    </div>
<?
}

function Get3Tabs($strTitleTab1, $strTitleTab2, $strTitleTab3) {
    echo '<div id="divBlockTabs" class = "row" style="padding:0px; margin:0px; display:none;">';
    echo GetTab3(1, "OnClickTab1", $strTitleTab1);
    echo GetTab3(2, "OnClickTab2", $strTitleTab2);
    echo GetTab3(3, "OnClickTab3", $strTitleTab3);
    echo '</div>';
}




function GetTab2($num, $strOnClickFunction, $strTitleTab) {
?>
    <div class = "col s6" style="padding:0px; margin: 0px;">
        <div style="background-color:white; padding:2px; margin: 0px;" id="divTopLine<? echo $num; ?>"></div>
       <a href="javascript:void(0);" onclick="<? echo $strOnClickFunction; ?>()">
           <div align="center" style="background-color:white; color:black; padding: 15px 0px 15px 0px; margin: 0px;" id="divBack<? echo $num; ?>"><h6><? echo $strTitleTab; ?></h6></div>
       </a>
       <div style="background-color:black; padding:2px; margin: 0px;" id="divBottomLine<? echo $num; ?>"></div>
    </div>
<?
}

function Get2Tabs($strTitleTab1, $strTitleTab2) {
    echo '<div id="divBlockTabs" class = "row" style="padding:0px; margin:0px; display:none;">';
    echo GetTab2(1, "OnClickTab1", $strTitleTab1);
    echo GetTab2(2, "OnClickTab2", $strTitleTab2);
    echo '</div>';
}



function GetTab4($num, $strOnClickFunction, $strTitleTab) {
?>
    <div class = "col s3" style="padding:0px; margin: 0px;">
        <div style="background-color:white; padding:2px; margin: 0px;" id="divTopLine<? echo $num; ?>"></div>
       <a href="javascript:void(0);" onclick="<? echo $strOnClickFunction; ?>()">
           <div align="center" style="background-color:white; color:black; padding: 15px 0px 15px 0px; margin: 0px;" id="divBack<? echo $num; ?>"><h6><? echo $strTitleTab; ?></h6></div>
       </a>
       <div style="background-color:black; padding:2px; margin: 0px;" id="divBottomLine<? echo $num; ?>"></div>
    </div>
<?
}

function Get4Tabs($strTitleTab1, $strTitleTab2, $strTitleTab3, $strTitleTab4) {
    echo '<div id="divBlockTabs" class = "row" style="padding:0px; margin:0px; display:none;">';
    echo GetTab4(1, "OnClickTab1", $strTitleTab1);
    echo GetTab4(2, "OnClickTab2", $strTitleTab2);
    echo GetTab4(3, "OnClickTab3", $strTitleTab3);
    echo GetTab4(4, "OnClickTab4", $strTitleTab4);
    echo '</div>';
}

?>