<?
    class EnumEssential {
        const CLIENTS = 1;
        const SERVICES = 2;
        const PRODUCTS = 3;
        const PRICELISTS = 4;
        const EMPLOYEE = 5;
        const VENDORS = 6;
        const MONEY = 7;
        const CRITERIONS = 8;
        const CATEGORIES = 9;
        
        const PLACES = 10;
        const UNITS = 11;
        const RESOURCES = 12;
        const PRICELIST_SECTIONS = 13;
        const GROUPS = 14;
        const APPOINTMENT = 15;
        const VISITS = 16;
        const APPOINTMENTS = 17;
        const ORDERS = 18;
        const INVENTARISATION = 19;
        
        const RECOMENDATIONS = 20;
        const RESERVATIONTIMETEMPLATES = 21;
        const SETS = 22;      //  Это нужно убрать. Вместо него использовать ABONEMENTS
        const CONTACTS = 23;
        const PRICELIST_CONTENT = 24;
        const WASTETHEORY = 25;
        const WASTEFACT = 26;
        const SALONS = 27;
        const CHOOSEPLACE = 28;
        const TAXES = 29;
        
        const REPORTS = 30;
        const CURRENCY = 31;
        const HIERARCHY = 32;
        const CHOOSEVISITS = 33;
        const CHOOSEPAYMENTS = 34;
        const PAYMENTS = 35;
        const BILLS = 36;
        const NOTIFICATION = 37;      //  Потом вообще удали
        const NOTIFICATIONS = 38;
        const NOTIFICATIONRULES = 39;
        
        const SALARY = 40;
        const SALARYS = 41;
        const INVENTARISATIONS = 42;
        const DESTINATION = 43;
        const MESSAGES = 44;
        const HELP = 45;
        const RULES = 46;
        const TEMPLATEDAYS = 47;
        const TASKS = 48;
        const SETTINGS = 49;
        
        const CHOOSEAPPOINTMENTS = 50;
        const WIZARD = 51;
        const CHOOSE = 52;
        const PHONECONTACTS = 53;
        //const EMAILCONTACTS = 59;
        const COUNTRIES = 54;
        const FORMATDATE = 55;
        const FORMATTIME = 56;
        const BONUSESADD = 57;
        const BONUSESSUB = 58;
        const PURCHASES = 64;
        const PURCHASEPRODUCTS = 65;
        const CALLS = 67;
        const MOVEMENT = 68;
        const TAXCONTENTS = 69;
        
        const BONUSES = 70;
        const SKIDKI = 71;
        const ABONEMENTS = 72;
        const GIFTS = 73;
        const SERTIFICATES = 74;
        const FLYERS = 75;
        const COUPONS = 76;
        const REKLAMA = 77;
        const ACTIONS = 78;
        const REFERALCARDS = 79;
        
        const MARKETING = 80;
        const MONEYDESTINATION = 81;
        const PRICELISTCOMBI = 82;
        const SALONEMPLOYEE = 83;
        const CARDITEMS = 84;
        const PAYS = 85;
        const SUBSCRIPTIONS = 86;
        const PROFILE = 87;
        const SALES = 88;
        const PRICELISTCOMBISETS = 89;
        
        const MAINMENU = 90;
        const DESTINATIONMARKETING = 91;
        const VISITCONFIRMED = 92;
        const VISITSTATUS = 93;
        const SUPPORT = 94;
        const TIPS = 95;
        const CHANNELS = 96;
        const PHOTOS = 97;
        const ABOUT = 98;
        const ALLPHOTOS = 99;
        
        const EMPTY = 100;
        const PRIHOD = 101;
        const RASHOD = 102;
        const SETTAXES = 103;
        const SETTAXCONTENT = 104;
        const CASH = 105;
        const PARTNERS = 106;
        const PARTNERPAYMENTS = 107;
        const ONLINEAPPOINTMENTS = 108;
        const TYPEBILLS = 109;
        
        const QUANTITY = 110;
        const IMPORT = 111;
        const EXPORT = 112;
        const BONUSESPERPAYMENTPRODUCTS = 113;
        const PAYMENTSPERPRODUCTS = 114;
        const TOTALPAYMENT = 115;
        const DAYGRAPHIC = 116;
        const CITIES = 117;
        const FORCREATECOMMUNICATIONS = 118;
        const FORSENDCOMMUNICATIONS = 119;
        
        const TEAMS = 120;
        const BONUSCARDS = 121;
        const RESERVATIONTIMES = 122;
        const GRAPHIC = 123;
        const PARTNER = 124;
        const EMPLOYEECATEGORY = 125;
        const PRODUCTSORDER = 126;
        const MINIPRICELIST = 127;
        const UILOG = 128;
        //const ONLINEFORMDATA = 129;
        
        //const ONLINEFORM = 130;
        const MESSAGETEMPLATE = 131;
        const REVIEWS = 132;
        const PRODUCTSVISIT = 133;
        const USERPROFILE = 134;
        const SELECTDATETIME = 135;
        const EDITREVIEWS = 136;
        const RECENTCALLS = 137;
        const ZAKAZES = 138;
        const NEXTAPPOINTMENTS = 139;
        
        const ONLINEFORMS = 140;
        const ONLINETEMPLATES = 141;
        const APPOINTMENTMEMBERS = 142;
        const MASTERS = 143;
        const ASSISTENTS = 144;
        const MONEYWASTE = 145;
        const ONLINETEMPLATECONTENT = 146;
        const ADRESS = 147;
        const MESSAGECOLLECTIVE = 148;
        
        
        //  Новые - добавленные. Нужно перенести и в андроид-приложение!
        const DEPARTMENTS = 149;
        const OPERATORS = 150;
        const MESSAGECHANNELS = 151;
        const HISTORIES = 152;
        const TOKENS = 153;
        const PORTFOLIO = 154;
        const INCOME = 155;
        const OUTCOME = 156;
        const MESSAGECLIENTS = 157;
        const SHOPPINGS = 158;
        const BOTMESSAGES = 159;

        const COSTS = 160;
        const DURATIONS = 161;
        const DESCRIPTIONS = 162;
        const TITLES = 163;
        const PHONES = 164;
        const EMAILS = 165;
        const VIBERS = 166;
        const WHATSAPPS = 167;
        const VKONTAKTES = 168;
    
        const NAMES = 169;
        const SURNAMES = 170;
        const PATRONYMICS = 171;
        const BANKACCOUNTS = 171;
        const MESSAGERULES = 172;


        function GetNameEssentialRussian($idEssential) {
            $str = "";
            switch($idEssential) {
                case EnumEssential::CLIENTS:
                    $str = "КЛИЕНТЫ"; break;
                case EnumEssential::SERVICES:
                    $str = "УСЛУГИ"; break;
                case EnumEssential::PRODUCTS:
                    $str = "ТОВАРЫ"; break;
                case EnumEssential::RESOURCES:
                    $str = "РЕСУРСЫ"; break;
                case EnumEssential::EMPLOYEE:
                    $str = "СОТРУДНИКИ"; break;
                case EnumEssential::SALONS:
                    $str = "САЛОНЫ"; break;
                case EnumEssential::VISITS:
                    $str = "ВИЗИТЫ"; break;
                case EnumEssential::ACTIONS:
                    $str = "АКЦИИ"; break;
                case EnumEssential::VENDORS:
                    $str = "ПОСТАВЩИКИ"; break;
            }
            return $str;
        }
        
    }
?>