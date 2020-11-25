<?
abstract class EnumIdSites {
    const SITE_ZAPISI_ONLINE = 1;
    const SITE_ZAPISHIS_ONLINE = 2;
    const SITE_TALON24_RU = 3;
    const SITE_ROBOT_SALON = 4;
    const SITE_5SLEVA5SPRAVA = 5;
    const SITE_PRIMITIV = 6;
}
abstract class EnumDomenSites {
    const SITE_ZAPISI_ONLINE = "записи.онлайн";
    const SITE_ZAPISHIS_ONLINE = "запишись.онлайн";
    const SITE_TALON24_RU = "talon24.ru";
    const SITE_ROBOT_SALON = "robot.salon";
    const SITE_5SLEVA5SPRAVA_RU = "5sleva5sprava.ru";
    const SITE_PRIMITIV_RU = "primitiv.ru";
}

class Sites
{
    public static function GetIdSiteByDomen($strDomen) {
        if (strpos(EnumDomenSites::SITE_ZAPISI_ONLINE, $strDomen))  return EnumIdSites::SITE_ZAPISI_ONLINE;
        if (strpos(EnumDomenSites::SITE_ZAPISHIS_ONLINE, $strDomen))  return EnumIdSites::SITE_ZAPISHIS_ONLINE;
        if (strpos(EnumDomenSites::SITE_TALON24_RU, $strDomen))  return EnumIdSites::SITE_TALON24_RU;
        if (strpos(EnumDomenSites::SITE_ROBOT_SALON, $strDomen))  return EnumIdSites::SITE_ROBOT_SALON;
        if (strpos(EnumDomenSites::SITE_5SLEVA5SPRAVA, $strDomen))  return EnumIdSites::SITE_5SLEVA5SPRAVA;
        if (strpos(EnumDomenSites::SITE_PRIMITIV, $strDomen))  return EnumIdSites::SITE_PRIMITIV;
        return 0;
    }
    public static function GetDomenByIdSite($id) {
        switch($id) {
            case EnumIdSites::SITE_ZAPISI_ONLINE:   return EnumDomenSites::SITE_ZAPISI_ONLINE;
            case EnumIdSites::SITE_ZAPISHIS_ONLINE:   return EnumDomenSites::SITE_ZAPISHIS_ONLINE;
            case EnumIdSites::SITE_TALON24_RU:   return EnumDomenSites::SITE_TALON24_RU;
            case EnumIdSites::SITE_ROBOT_SALON:   return EnumDomenSites::SITE_ROBOT_SALON;
            case EnumIdSites::SITE_5SLEVA5SPRAVA:   return EnumDomenSites::SITE_5SLEVA5SPRAVA;
            case EnumIdSites::SITE_PRIMITIV:   return EnumDomenSites::SITE_PRIMITIV;
        }
        return "";
    }
    public static function GetFullPath($idSite, $strUrl) {
        return 'https://'.Sites::GetDomenByIdSite($idSite).'/'.$strUrl;
    }
}
?>