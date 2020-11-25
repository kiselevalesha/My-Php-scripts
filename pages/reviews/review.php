<?
    
    require_once 'utils/start.php';
    require_once "ui/interface.php";
    $uidAppointment = $_GET['id'];
    
    if ($idState == EnumTypeReviewState::EDIT) {
        $strTitle = "Отчёт";
        setcookie("appointment", "");   //  Удаляем установленную куки на Запись. Она больше не нужна.
    }
    else {
        $strTitle = "Отзыв";
    }
    
    
?>
<!DOCTYPE html>
<html>
<head>
<?    
    require_once '../php-scripts/utils/head1973.php';
    require_once '../js-scripts/image-upload.php';
    require_once '../php-scripts/ui/Calendar/javascript.php';
?>
    <script type = "text/javascript">
    
        const TypeReviewStateEDIT = 1;
        const TypeReviewStateVIEW = 2;
        var idState = <? echo $idState; ?>
    
        var idAppointment = '<? echo $uidAppointment; ?>';
        var intRating = 0, strReview = "";
        var strJsonAppointment = "";
        var strUrlAPI = "/api/v1/appointments/reviews/";
        eraseCookie("appointment");


        document.addEventListener("DOMContentLoaded", function(event) {
            ShowHide("divWait", "divContent");
            if (!IsHaveToken()) {
                QueryToken();
            }
            else {
                RunStartQuery();
            }
        });
        
        function RunStartQuery() {
            ShowHide("divWait", "divContent");
            LOG(GetJsonReview())
            RunAjax(GetJsonReview(), strUrlAPI + "get.php", OnResponseAppointment);
        }

        function OnResponseAppointment() {
            if (this.readyState != 4) return;
            strJsonAppointment = this.responseText;
            LOG("Get OnResponse123Appointment: " + strJsonAppointment);
            if (IsItJson(strJsonAppointment))    GetAppointment(JSON.parse(strJsonAppointment));
            ShowHide("divContent","divWait");
        }
        function GetAppointment(json) {
            if (json == null)   return;
            if (json == undefined)   return;
            if (json.data == undefined)   return;
            if (json.data.appointment == undefined)   return;
            
            var appointment = json.data.appointment;
            
            if (!(appointment.age.start == undefined)) {
                var start = "" + appointment.age.start;
                if (+start > 0) {
                    iYear = +start.substring(0, 4);
                    iMonth = +start.substring(4, 6);
                    SetValue("month", GetNameMonth(iMonth));
                    SetValue("monthBottom", GetNameMonth(iMonth));
                    iDay = +start.substring(6, 8);
                    SetValue("day", iDay);
                    iHour = +start.substring(8, 10);
                    iMinute = +start.substring(10, 12);
                    SetValue("time", GetTwoNumbers(iHour) + ":" + GetTwoNumbers(iMinute));
                }
            }
            
            if (!(appointment.employee == undefined)) {
                
                var employee = appointment.employee;
                var name = "";
                if (IsSet(employee.name)) name = employee.name;
                if (name.trim().length == 0)    name = '<i style="color:grey;">Имя не указано</i>';
                SetValue("name", name);
                
                var phone = "";
                if (IsSet(employee.phone))    phone = employee.phone;
                SetValue("phone", phone);
                
                var email = "";
                if (IsSet(employee.email))    email = employee.email;
                SetValue("email", email);
                
                var photoEmployee = "/images/profile.png";
                if (IsSet(employee.photo))    photoEmployee = employee.photo;
                SetImage("photoEmployee", photoEmployee);
            }

            
            if (IsSet(appointment.duration.minutes)) {
                duration = +appointment.duration.minutes
                SetValue("duration", duration + " мин.");
            }
            if (IsSet(appointment.cost.summa)) {
                cost = +appointment.cost.summa/100;
                SetValue("cost", cost + " руб.");
            }
                
            var strDivServices = "";
            if (!(appointment.services == undefined))
                for (var i=0; i < appointment.services.length; i++) {
                    if (strDivServices.length > 0)  strDivServices = strDivServices + '<hr>';
                    var service = appointment.services[i];
                    strDivServices = strDivServices + MakeBlockService(service.name, service.duration, +service.cost/100);
                }
            if (strDivServices.length > 0) {
                SetValue("divListOfServices", strDivServices);
                ShowDiv("divTitleServices");
            }
            
            if (appointment.photo != undefined)
                if (appointment.photo.length > 0) {
                    SetImage("photoPortfolio", "https://записи.онлайн/" + appointment.photo);
                    ShowDiv("divPhotoPortfolio");
                }
                
            //  Нужно показывать серию фотографий с Визит-а !!!! Сделай потом !!!
            

            if (!(appointment.client == undefined)) {
                
                var client = appointment.client;
                var name = "";
                if (IsSet(client.name)) name = client.name;
                if (name.trim().length == 0)    name = '<i style="color:grey;">Имя не указано</i>';
                SetValue("nameClient", name);
                
                var email = "";
                if (IsSet(client.email))    email = client.email;
                SetValue("email", email);
                
                var phone = "";
                if (IsSet(client.phone))    phone = client.phone;
                SetValue("phoneClient", phone);
                
                var photoClient = "/images/profile.png";
                if (IsSet(client.photo))    photoClient = client.photo;
                SetImage("photoClient", photoClient);
            }
            else {
                SetValue("nameClient", '<i style="color:grey;">Клиент не указан</i>');
                SetImage("photoClient", "/images/profile.png");
            }

            
            intRating = 0;
            if (IsSet(appointment.rate))    intRating = appointment.rate;
            OnClickStar(intRating);
            OnClickStar(intRating);
            
            strReview = "";
            if (IsSet(appointment.review))    strReview = appointment.review;
            SetTextAreaValue('reviewDescription', strReview);
            SetValue('idTextReview', (strReview.length > 0) ? strReview : "<b>...</b>");
            
            LOG("idState="+idState+" TypeReviewStateEDIT="+TypeReviewStateEDIT)
            //if (idState == TypeReviewStateEDIT) {
                if ((intRating > 0) || (strReview.length > 0))
                    ShowRated();
                else {
                    ShowNotRated();
                    Speak("Будем благодарны за вашу оценку и комментарий о выполненной работе");
                }
            //}
            //else ShowDiv("divBlockShowReview");

            if (json.data.photos !== undefined) ShowJsonPhotos(json.data.photos);

            M.updateTextFields();
        }
        
        function GetJsonReview() {
            return JSON.stringify({
                token:strToken,
                code: idAppointment,
                rate: intRating,
                review: strReview
            });
        }

        function MakeBlockService(name, duration, cost) {
        return '<table>'+
                    '<tr><td>'+
                        '<div style="display: inline-block;"><div id="nameService"><h6><b> ' + name + '</b></h6></div></div>'+
                    '</td><td>'+
                        '<div align="right"><div style="display: inline-block;"><b><div id="costService">' + cost + ' руб.</div></b></div></div>'+
                    '</td></tr>'+
                '</table>';
        }



        function OnClickStar(star) {
            intRating = star;
            ClearStars("star");
            ClearStars("astar");
            SetStars(+star, "star");
            SetStars(+star, "astar");
        }
        function ClearStars(strName) {
            for (var i = 1; i <= 5; i++)    SetValue(strName + i, "star_border");
        }
        function SetStars(count, strName) {
            for (var i = 1; i <= count; i++)    SetValue(strName + i, "star");
        }



    function OnClickSave() {
        if (idAppointment < 0) return;
        strReview = GetStringValue("reviewDescription");
        SetValue('idTextReview', (strReview.length > 0) ? strReview : "<b>...</b>");
        
        HideDiv("divBlockEditReview");
        ShowWaiting();
        RunAjax(GetJsonReview(), strUrlAPI + "put.php", OnResponseSave);
    }

    function OnResponseSave() {
        if (this.readyState != 4) return;
        LOG("Get OnResponseSettings Response:"+ this.responseText);
        if (IsItJson(this.responseText))    AfterSave(JSON.parse(this.responseText));
        HideWaiting();
    }
    function AfterSave(json) {
        if (json == null)   return;
        if (json == undefined)   return;
        if (json.status == undefined)   return;
        if (+json.status.id == 200) {
            ShowRated();
            ShowDiv("blockThanks");
            Speak("Спасибо за обратную связь");
        }
    }

    function ShowRated() {
        LOG("ShowRated")
        if (idState == TypeReviewStateEDIT) {
            //ShowDiv("blockThanks");
            HideDiv("divClient");
        }
        else {
            //HideDiv("blockThanks");
            LOG("fuufff")
            ShowDiv("divClient");
        }
        ShowDiv("divBlockShowReview");
        HideDiv("divBlockEditReview");
        HideDiv("divSaveButton");
    }
    function ShowNotRated() {
        //HideDiv("blockThanks");
        ShowDiv("divBlockEditReview");
        ShowDiv("divSaveButton");
    }



    function ShowJsonPhotos(photos) {
        LOG("ShowJsonPhotos");
        if (photos == null)   return;
        if (photos.length == 0) return;
        
        ShowHide("divBlockPhotos");

        var strDivPhotos = "";
        for (var i=0; i < photos.length; i++) {
            var photo = photos[i];
            strDivPhotos = strDivPhotos + GetDivPhoto(i, photo.url, photo.ageCreated, photo.description, photo.descriptionOnline);
        }
        SetValue('divListOfItems', strDivPhotos);
    }

    function GetDivPhoto(index, url, age, description, descriptionOnline) {
        var strDescriptionOnline = "";
        if (IsSet(descriptionOnline))  strDescriptionOnline = '<div style="background-color:lightgrey;margin-top:5px;padding:10px;">' + descriptionOnline + '</div>';
        return '<div class = "row card-panel" style="border-left: 5px solid black;padding:0px;">'+
                    '<a class="linkBlack" href="javascript:void(0);" onclick="OnClickItemPhoto(' + index + ')">'+
                        '<div style="padding:5px;" align="center"><img src="' + url + '" width=100%;></div>'+
                        '<div style="padding:10px;">'+
                        '<div align="center">' + GetStrFromLongDate(age) + '</div>'+
                        '<div style="margin-top:5px;">' + description + '</div>'+
                        '</div>' + strDescriptionOnline +
                    '</a>'+
                '</div>';
    }

    function OnClickItemPhoto(index) {
        var idPhoto = 0;
        if (IsItJson(strJsonPhotos)) {
            var photos = GetJsonData(JSON.parse(strJsonPhotos));
            if (photos.length > index)  idPhoto = photos[index].id;
        }
        if (idPhoto > 0) {
            Save();
            GoTo('editPhoto.php?photo=' + idPhoto);
        }
    }

    </script>
    </head>
    <body>

<?
    if ($idState == EnumTypeReviewState::EDIT)
        GetDivTopMenuTalon($strTitle);
    else
        GetDivTopMenu($strTitle);
?>

    <br>
    <div align="center" style="display:block;" id="divWait">
        <br><br><br><br><br>
        <img src="/images/progress1.gif" width=50px;>
        <br><br><br><br><br>
    </div>

    <div class = "container" style="padding:0px;" id="divContent">

    <br>
    <table style="margin:0px;">
        <tr>
            <td width=10%></td>
            <td class="red" style="padding-left:20px; padding-right:20px; color:white;">
                
                <div align="center">
                    <h3><b><div id="day"><? echo $day; ?></div></b></h3>
                    <div id="month"><? echo $strRMonth; ?></div>
                </div>
                
            </td>
            <td width=90%></td>
        </tr>
    </table>



<div class = "row card" style="padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">

    <br>
    <table>
    <tr>
        <td></td>
        <td>
            
            <div style="background-color:grey;padding:2px; display: inline-block;">
                <div style="background-color:white; padding:10px; padding-left:20px; padding-right:20px;" align="center">
                    <div style="display: inline-block;"><i class = "material-icons prefix">alarm</i></div>
                    <div style="display: inline-block;"><h5><b><div id="time">00:00</div></b></h5></div>
                </div>
            </div>
            
        </td>
        <td>
            <div align="right">
            
            <div style="background-color:grey;padding:2px; display: inline-block;">
                <div style="background-color:white; padding:10px; padding-left:20px; padding-right:20px;" align="center">
                    <div style="display: inline-block;"><i class = "material-icons prefix">watch</i></div>
                    <div style="display: inline-block;"><h5><b><div id="duration">0 мин.</div></b></h5></div>
                </div>
            </div>
            
            </div>
        </td>
        <td></td>
    </tr>
</table>

    <div class = "col s12">

        <table>
            <tr>
                <td width=1%;>
                    <br>
                    <div align="center"><img id="photoEmployee" class="avatar60" src="" width=60px;></div>
                </td>
                <td>
                       <div>
                            <h5><div id="name"></div></h5>
                            <b><div id="phone"></div></b>
                       </div>
                </td>
            </tr>
        </table>
        

        <div id="divTitleServices" class = "row" style="background-color:lightgrey;display:none;">
            <table>
                <tr>
                    <td width=1%;>
                        <h4> </h4>
                    </td>
                    <td width=1%;>
                        <h4> Услуги:</h4>
                    </td>
                    <td width=100%;> </td>
                    <td width=1%;>
                    </td>
                    <td> </td>
                </tr>
            </table>
        </div>
        
        <div id="divPhotoPortfolio" style="display:none;" align="center"><img id="photoPortfolio" src="" width="90%"></div><br>

        <div class = "row" style="padding-left:10px; padding-right:10px;">
            <div id="divListOfServices"></div>
        </div>

        <div class = "row" style="background-color:lightgrey; padding:10px;">
            <div align="right">
                <a  style="color:black;">
                <div style="background-color:grey;padding:2px; display: inline-block;">
                    <div style="background-color:white; padding:10px; padding-left:20px; padding-right:20px;" align="right">
                        <div style="display: inline-block;color:red;"><h5><b><div id="cost">0 руб.</div></b></h5></div>
                    </div>
                </div>
                </a>
            </div>
        </div>

        <div class="row" id="divStatusBar"></div>

    </div>

</div>
    



    
    
    
    
    
      
      
<table style="color:transparent;margin:0px;">
    <tr>
        <td width=10%></td>
        <td class="red" style="padding-left:20px;padding-right:20px;">
            <div align="center">
                <div style="height:0px;" id="monthBottom">февраля</div>
            </div>
        </td>
        <td width=90%></td>
    </tr>
</table>

    <div id="divBlockPhotos" style="display:none;">
        <br><br>
        <div align="center"><div style="background-color:black;color:white;padding:5px;display:inline-block;"><b>Фотоотчёт</b></div></div>
        <div id="divListOfItems"></div>
    </div>
    

    <br><br>
    <div id="divBlockShowReview" style="display:none;">
        <div class = "row card" style="padding:15px;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><br>
            <div align="center">Поставленная оценка:</div><br>
            <div id="divStars" align="center">
                <i id="astar1" style="padding:5px;font-size:250%;" class = "material-icons prefix">star_border</i>
                <i id="astar2" style="padding:5px;font-size:250%;" class = "material-icons prefix">star_border</i>
                <i id="astar3" style="padding:5px;font-size:250%;" class = "material-icons prefix">star_border</i>
                <i id="astar4" style="padding:5px;font-size:250%;" class = "material-icons prefix">star_border</i>
                <i id="astar5" style="padding:5px;font-size:250%;" class = "material-icons prefix">star_border</i>
            </div>
        
           <div><b>Комментарий:</b></div>
           <div id="idTextReview"></div>
           <br>
           
        </div>

        <br>
        <div id="divClient" class = "row card" style="display:none;padding:15px;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;">
            <table>
                <tr>
                    <td width=1%;>
                        <br>
                        <div align="center"><img id="photoClient" src="" width=60px;></div>
                    </td>
                    <td>
                           <div>
                                <h5><div id="nameClient"></div></h5>
                                <b><div id="phoneClient"></div></b>
                           </div>
                    </td>
                </tr>
            </table>
        </div>
        
    </div>

        






    
    
    <div id="divBlockEditReview" style="display:none;">
        <?
            $strDescription = "Будем благодарны за вашу оценку и комментарий о выполненной работе.";
            GetDivHelpInfo($strDescription);
        ?>
    
        <div class = "row card" style="padding:15px;padding-top:0px;margin-top:0px;padding-bottom:0px;margin-bottom:0px;"><br>
            <div align="center">Ваша оценка:</div><br>
            <div class = "row" id="divStars" align="center">
                <a class="linkBlack" href="javascript:void(0);" onclick="OnClickStar(1)">
                    <i id="star1" style="padding:5px;font-size:250%;" class = "material-icons prefix">star_border</i>
                </a>
                <a class="linkBlack" href="javascript:void(0);" onclick="OnClickStar(2)">
                    <i id="star2" style="padding:5px;font-size:250%;" class = "material-icons prefix">star_border</i>
                </a>
                <a class="linkBlack" href="javascript:void(0);" onclick="OnClickStar(3)">
                    <i id="star3" style="padding:5px;font-size:250%;" class = "material-icons prefix">star_border</i>
                </a>
                <a class="linkBlack" href="javascript:void(0);" onclick="OnClickStar(4)">
                    <i id="star4" style="padding:5px;font-size:250%;" class = "material-icons prefix">star_border</i>
                </a>
                <a class="linkBlack" href="javascript:void(0);" onclick="OnClickStar(5)">
                    <i id="star5" style="padding:5px;font-size:250%;" class = "material-icons prefix">star_border</i>
                </a>
            </div>
        
           <div class = "col s12">
               <div class = "input-field">
                  <textarea id="reviewDescription" class="materialize-textarea"></textarea>
                  <label for = "reviewDescription" id="_reviewDescription">Пояснение:</label>
               </div>
           </div>
           
        </div>
        <div id="divSaveButton" style="display:none;">
            <br>
            <?
                GetDivCenterButton("Оценить", "OnClickSave");
            ?>
        </div>
    </div>
    <div id="blockThanks" style="display:none;">
        <?
            $strDescription = "Спасибо за вашу оценку.";
            GetDivHelpInfo($strDescription);
        ?>
    </div>



    </div>
    <br><br><br><br>

<? GetDivFooter2(); ?>

    </body>
</html>
