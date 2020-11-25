<?
    if (strlen($iconLeft) == 0)         $iconLeft = "arrow_back";
    if (strlen($iconRight) == 0)        $iconRight = "more_vert";
    if (strlen($strTopMenuColor) == 0)  $strTopMenuColor = "black";
?>

<script type = "text/javascript">
    function OnClickLeftMenuButton(url) {
        if (url.length == 0)    GotoBackPage();
        else                    GoTo(url);
    }
</script>
<table class="<? echo $strTopMenuColor; ?>" style="color:white;">
    <tr>
        <td width=10%>
            <a class="linkWhite" href="javascript:void(0);" onclick="OnClickLeftMenuButton('<?echo $strLinkLeft; ?>')">
                <i class = "material-icons prefix" style="color:white; font-size:33pt"><? echo $iconLeft; ?></i>
            </a>
        </td>
        <td width=80%><div id="divTitle" align="center" style="color:white;font-family:Verdana; font-size:13pt;padding:0px 0px 0px 0px; margin:0px;"><? echo mb_strtoupper($strMenuTitle); ?></div></td>
        <td width=10%>
            <a href="<? echo $strLinkRight; ?>">
            <div align="right"><i class = "material-icons prefix" style="color:white; font-size:20pt; padding:0px;"><? echo $iconRight; ?></i></div>
            </a>
        </td>
    </tr>
</table>

<div id="divLog"></div>

<div id="divInfoAppointments"></div>
<div id="divInfoMessages"></div>
<div id="divInfoSupport"></div>
