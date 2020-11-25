<?
$iCell = 1;

function CreateRowFullCells($id) {
    $style = '';
    if ($id > 2)    $style = 'display: none;';
    echo '<tr id="tr'.$id.'" style="'.$style.'">';
    for($i=0; $i < 7; $i++) CreateFullCell();
    echo "</tr>";
}
function CreateFullCell() {
    global $iCell;
    echo '<td width=14%><a href="javascript:void(0);" onclick="OnClickCell(event)"><b><div style="color:black; padding: 6px; margin: 0px;" id="cell'.$iCell.'" align="center"></div></b></a></td>';
    $iCell++;
}

?>

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
<?
    CreateRowFullCells(1);
    CreateRowFullCells(2);
    CreateRowFullCells(3);
    CreateRowFullCells(4);
    CreateRowFullCells(5);
    CreateRowFullCells(6);
?>
    
</table>