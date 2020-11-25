<?php

//  Создаём копию базы данных из андроид-приложения.
//  По экспоритуемым данным. В приложении есть функция app.ExecuteExportDB();


    $arrayTables = array();
    $arrayTableFields = array();


function AddOtherTables() {
    AddDescription("SubscriptionChanges", "  ");
    AddDescription("SubscriptionPayments", "  ");
    AddDescription("SubscriptionStates", "  ");
    AddDescription("SubscriptionWastes", "  ");
    AddDescription("Subscriptions", "  ");
    AddDescription("Msg", "  ");
    AddDescription("Talks", "  ");
    AddDescription("Settings", "  ");
    AddDescription("Log", "  ");
    AddDescription("clicks", "  ");
    AddDescription("photoservices", "  ");
    AddDescription("Schedule", "  ");
    AddDescription("Shoppings", "  ");
    AddDescription("History", "  ");
    AddDescription("BotMessages", "  ");
    AddDescription("BankAccounts", "  ");
    AddDescription("Vendors", "  ");

    // ... добавь все остальные таблицы потом
}

function AddDescription($strTableName, $strFields) {
    global $arrayTables;
    if (empty($arrayTables))    $arrayTables = array();
    global $arrayTableFields;
    if (empty($arrayTableFields))    $arrayTableFields = array();

    if ((strlen($strTableName) > 1) && (strlen($strFields) > 1)) {
        array_push($arrayTables, $strTableName);
        array_push($arrayTableFields, $strFields);
    }
}


//  Ниже этого комментария переписываются данные на экспортированные из приложения

$strTableName = 'Adress';
$strFields ='isDeleted,idEssential,idOwner,floatLatitude,floatLongitude,strPostIndex,strCountry,strRegion,strCity,strStreet,strHouse,strCorpus,strAppartment,strDescription,strMetro1,strMetro2,strMetro3,idCategory,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Appointments';
$strFields ='isDeleted,strTokenAdministratorOrder,intCodeTokenAdministratorOrder,strTokenAdministratorVisit,intCodeTokenAdministratorVisit,
idClient,idContact,idAdress,idSalon,idDepartment,idPlace,idCourse,idPhoto,
idMaster1, summaMaster1, idMaster2, summaMaster2, idAssistent1, summaAssistent1, idAssistent2, summaAssistent2, 
idTypeToolCreator,idInstanceToolCreator,idEssentialCreator,

ageCreated,ageOrderStart,

costOrder,isAutoCalcCostOrder,costVisit,isAutoCalcCostVisit,idTotalPayment,isTotalPaymentZero,
idCurrency,idAutoChoosePricelist,idPricelist,idAction,
intMinutesDuration,isAutoCalculationDuration,

flagIncomeOutcome,idReklama,
idNeedCreateCommunications,idNeedSendEmail,idNeedSaveInCalendar,idEventCalendar,
idForCreateCommunicationBefore,idForCreateCommunicationAfter,
isRemind,ageRemindWill,ageRemindWas,intMinutesRemind,strTextRemindMessage,idSendNotification,

ageSendedInfoToMaster,ageAcceptedByMaster,
ageSendedInfoToClient,ageConfirmedByClient,idTypeConfirmed,

idStatus,ageClientCame,ageWorkStart,ageWorkEnd,ageReview,intRatingByMaster,strReviewByMaster,intRatingByClient,strReviewByClient,

strUrlReferer,strBarCode,strDescription,isNew,isFinished,longCode,

idEssentialAuthor,idAuthor,ageChanged,strJson,strJsonServices';


AddDescription($strTableName, $strFields);
$strTableName = 'Audios';
$strFields ='isDelete,idEssential,idOwner,idCreator,dateTimeCreated,dateTimeDeleted,strDescription,strDescriptionOnline,strFileName,intFileSize,isPublish,isShowOnline,isSynchronized,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Bills';
$strFields ='isDeleted,idTotalPayment,intBillNumber,idAppointment,idEssentialContent,idMaster,idAdministrator,ageBilled,strDescription,idTypeBill,summaTotal,idCurrency,idTax,isAutoCalc,isSaved,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Calls';
$strFields ='isDelete,idTypeCall,idClient,idTypeContact,strAdress,dateTimeStartCall,dateTimeEndCall,idEmployee,strDescription,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Clients';
$strFields ='isDeleted,strName,strSurName,strPatronymic,strAlias,strToken,strYandexToken,strVKToken,dateBorn,idSex,strDescription,intPeriodDays,isAutoCalcPeriod,idCategory,idMainPhoto,idReklama,isUse,isNew,ageCreated,ageFirstVisit,ageLastVisit,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);

$strTableName = 'Contacts';
$strFields ='isDeleted,idOwnerEssential,idOwner,idType,isAllow,strText,intPhonePrefix,intCodeText,strPassword,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);

$strTableName = 'Countries';
$strFields ='isDelete,idFormatDate,idFormatTime,idCurrency,isShowCurrencyAfterSum,isTaxIncluded,intFirstDayOfWeek,strCapital,strCode,strName,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Courses';
$strFields ='isDelete,idClient,idColor,intCountTotalVisits,strDescription,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Criterions';
$strFields ='isDeleted,strName,strDescription,isNew,isUse,idEssential,idClientCategory,idClient,idEmployeeCategory,idEmployee,idProductCategory,idProduct,idServiceCategory,idService,idSetCategory,idSet,idPlaceCategory,idPlace,intDayWeek1,intDayWeek2,intDayWeek3,intDayWeek4,intDayWeek5,intDayWeek6,intDayWeek7,intDayMonth1,intDayMonth2,intDayMonth3,intDayMonth4,intDayMonth5,intDayMonth6,intDayMonth7,intDayMonth8,intDayMonth9,intDayMonth10,intDayMonth11,intDayMonth12,intDayMonth13,intDayMonth14,intDayMonth15,intDayMonth16,intDayMonth17,intDayMonth18,intDayMonth19,intDayMonth20,intDayMonth21,intDayMonth22,intDayMonth23,intDayMonth24,intDayMonth25,intDayMonth26,intDayMonth27,intDayMonth28,intDayMonth29,intDayMonth30,intDayMonth31,intMonth1,intMonth2,intMonth3,intMonth4,intMonth5,intMonth6,intMonth7,intMonth8,intMonth9,intMonth10,intMonth11,intMonth12,intHour1,intHour2,intHour3,intHour4,intHour5,intHour6,intHour7,intHour8,intHour9,intHour10,intHour11,intHour12,intHour13,intHour14,intHour15,intHour16,intHour17,intHour18,intHour19,intHour20,intHour21,intHour22,intHour23,intHour24,ageStart,ageEnd,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Currency';
$strFields ='isDelete,strFullName,strShortName,idImageCurrencyBlack,idImageCurrencyWhite,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);


$strTableName = 'Employees';
$strFields ='isDeleted,strName,strSurName,strPatronymic,strAlias,strToken,strYandexToken,strVKToken,dateBorn,idSex,strDescription,strPromoCode,isUse,idMainPhoto,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);


$strTableName = 'ForCalculationsService';
$strFields ='isDelete,strOutFileName,strOutFilePath,idCodeCalc,idItem,idSubItem,idEssentialItem,dateTimeStart,dateTimeEnd,idStatus,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ForCreateCommunications';
$strFields ='isDelete,dateTimeCreated,dateTimeCreateWill,dateTimeCreateWas,isSystem,idAction,idTypeRun,idType,idNotificationRule,idTypeReport,idReport,idCriterion,idClient,idEmployee,idAppointment,idTotalPayment,idTypeDelivery,strAdress,strTitle,strBody,strLog,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ForNotificationRules';
$strFields ='isDelete,idEssentialFrom,idOwnerFrom,idEssentialUser,idUser,idAction,isDone,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ForSendCommunications';
$strFields ='isDelete,dateTimeCreated,dateTimeSendWill,dateTimeSendWas,idForCreateCommunication,idAction,idType,idNotificationRule,idReport,idCriterion,idClient,idEmployee,idAppointment,idTotalPayment,idEssentialRecepient,idRecepient,idStatus,idTypeDeliveryWill,idTypeDeliveryWas,strAdress,strTitle,strBodySource,strBodyOut,strLog,idTypeCreation,isSystem,isAnalyseAnswer,isManualEdited,idManualEditedSet,isSuccess,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ForUploads';
$strFields ='isDelete,strTable,strParameters,dateTimeAppended,dateTimeExecuted,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Graphic';
$strFields ='isDeleted,intYear,intMonth,intDay,idTemplateDay,idEssentialOwner,idOwner,idSalon,idPlace,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Groups';
$strFields ='isDeleted,idEssential,idType,idColor,strName,strDescription,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'HierarchyCategories';
$strFields ='isDeleted,idEssential,idCategory,idOwner,idParent,strName,strDescription,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Images';
$strFields ='isDeleted,idSite,idEssential,idOwner,strName,strDescription,strDescriptionOnline,strUrl,intFileSize,isPublish,isShowOnline,isMainInSequence,isUseInPortfolio,isNew,ageCreated,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ImagesLists';
$strFields ='isDelete,idImage,idEssential,idOwner,strDescription,strFileName,intNumberPosition,isSelected,isMainInSequence,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = '222DBLogs';
$strFields ='isDelete,idWho,dateTimeExecuted,idType,strSQL,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'MainMenu';
$strFields ='isDelete,idCode,idParent,isShow,strName,strDescription,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Messages';
$strFields ='isDeleted,idTalk,idType,strBody,strBodyOut,strUidUser,intCodeUidUser,ageWillSend,ageWasSended,idTypeChannel,strAdress,idMessageRule,isApproved,idReport,isTextMessage,isNew,isDraft,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'MessageTemplates';
$strFields ='isDeleted,idTalk,idType,strBody,strUidUser,intCodeUidUser,ageWillSend,ageWasSended,idTypeChannel,strAdress,idMessageRule,idReport,isTextMessage,isNew,isDraft,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Movement';
$strFields ='isDelete,idPlaceFrom,idEmployeeFrom,idSectionFrom,idPlaceTo,idEmployeeTo,idSectionTo,dateTimeMovement,idProduct,intQuantityProduct,idUnitProduct,intQuantityContent,idUnitContent,idVisit,idService,idPricelist,cost,idCurrency,isRashod,isAutoCalculation,isNew,strDescription,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'MessageRules';  //  NotificationRules
$strFields ='isDeleted,strName,strDescription,strBody,idTypeRecepient,idTypeMessage,idTypeChannel,idTypeContent,isApproved,idTypeDate,ageCustom,idTypeTime,intTimeCustom,intHoursShift,idTypeDelivery,idTypeRepeat,intRepeatCustom,idCategoryClients,idCategoryEmployee,idCategoryProducts,idCategoryServices,idCategoryPlaces,intRateByMaster,intRateByClient,idReport,isHidden,isNew,isUse,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'OnlineForms';
$strFields ='isDelete,strName,strDescription,strLink,idColor,idPricelist,isShowServices,isShowProducts,isShowAnother,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'OnlineFormActions';
$strFields ='isDelete,idOnlineForm,idAction,dateTimeUpdated,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'OnlineFormPricelistContents';
$strFields ='isDelete,idOnlineForm,idPricelistContent,dateTimeUpdated,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'OnlineTemplates';
$strFields ='isDelete,strName,strDescription,idColor,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'OnlineTemplateContents';
$strFields ='isDelete,idParent,idOnlineTemplate,idEssentialProduct,idProduct,strName,costFrom,costTo,intDurationFrom,intDurationTo,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'AppointmentEmployee';
$strFields ='isDeleted,idAppointment,idEmployee,isMain,isMaster,isAssistent,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Ostatki';
$strFields ='isDelete,idPlace,idEmployee,idSection,idProduct,intQuantityProductWas,idUnitProduct,intQuantityContentWas,idUnitContent,intExcess,intShortage,dateTimeInventarisation,strInventariationNumber,strInventarisationCode,isNew,strDescription,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'OstatkiArchive';
$strFields ='isDelete,idPlace,idEmployee,idSection,idProduct,intQuantityProductWas,idUnitProduct,intQuantityContentWas,idUnitContent,intExcess,intShortage,dateTimeInventarisation,isNew,strDescription,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'OwnersGroups';
$strFields ='isDeleted,idEssential,idOwner,idGroup,isChecked,isAutoCreated,idGroupRule,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Payments';
$strFields ='isDelete,idTotalPayment,idEssentialPayer,idPayer,idEssentialReceiver,idReceiver,idEmployee,idTypePayment,idTypeContent,idItemPayment,idSubItemPayment,idMoneyBase,dateTimePayed,summaTips,cost,idCurrency,isAutoCreated,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'PaymentsPerProducts';
$strFields ='isDelete,idEssentialPayment,idItemPayment,idSubItemPayment,idClient,idProduct,idEssentialProduct,idTotalPayment,idPricelist,cost,intQuantity,summaPayment,dateTimePayment,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'PhoneContacts';
$strFields ='isDelete,idPhoneContact,strAlias,strPhone,strEmail,strPathImage,isUsed,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Portfolio';
$strFields ='isDelete,idImage,idEssential,idProduct,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'PriceLists';
$strFields ='isDeleted,idCriterion,strName,strDescription,isAddTip,intTipProcents,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'PricelistContent';
$strFields ='isDeleted,idPricelist,idPricelistSection,idOwner,idEssential,idProduct,isUse,isCostPerTime,isAbonement,intQuantity,idWhat,intDurationMinutes,costForSale,costForService,intSellerProcents,summaSellerFixMoney,intMasterProcents,summaMasterFixMoney,isCalcProductPrice,strDescription,idTax,idCurrency,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Products';
$strFields ='isDeleted,idEssential,strName,strNameOnline,strNameCheque,strSynonyms,strDescription,strArticul,strBarCode,idCategory,intUsePeriod,isAutoCalculation,idNotificationRule,idTax,idUnitProduct,idUnitContent,intQuantityBrutto,intQuantityNetto,idItemWizard,isForWoman,isForMan,isForChildren,isForSale,isUse,isShowOnline,isNew,idMainPhoto,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ProductRecomendations';
$strFields ='isDelete,idProduct,idProductForSale,strRecomendation,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ProductsBill';
$strFields ='isDelete,idOwner,intQuantity,intMinutesDuration,idEssential,idProduct,cost,summaTotal,summaTax,summaTip,isCheckedForPayment,dateTimeUpdated,isManualEdited,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ProductsOrder';
$strFields ='isDeleted,idOwner,intQuantity,intMinutesDuration,idEssential,idProduct,cost,summaTotal,summaTax,summaTip,isCheckedForPayment,dateTimeUpdated,isManualEdited,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'PurchaseProducts';
$strFields ='isDelete,idPurchase,idProduct,cost,idCurrency,intQuantity,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ProductResources';
$strFields ='isDelete,idProduct,idResource,dateTimeUpdated,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'SetsContent';
$strFields ='isDelete,idOwner,intQuantity,intMinutesDuration,idEssential,idProduct,cost,summaTotal,summaTax,summaTip,isCheckedForPayment,dateTimeUpdated,isManualEdited,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ProductTaxes';
$strFields ='isDeleted,idProduct,idTax,dateTimeUpdated,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ProductsVisit';
$strFields ='isDeleted,idOwner,intQuantity,intMinutesDuration,idEssential,idProduct,cost,summaTotal,summaTax,summaTip,isCheckedForPayment,dateTimeUpdated,isManualEdited,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Purchases';
$strFields ='isDelete,dateTimeBuyed,idVendor,idEmployee,cost,summaPayed,idCurrency,isMakeWasteMoney,idWasteMoney,isUse,strDescription,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Recomendations';
$strFields ='isDelete,idEssential,idOwner,idProduct,isUse,strDescription,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Reports';
$strFields ='isDelete,idForCalculation,idTypeReport,isActive,strName,strDescription,idTypePeriod,isPreviousPeriod,isIgnoreVacancy,idClientCategory,idClient,idEmployeeCategory,idEmployee,idProductCategory,idProduct,idServiceCategory,idService,idSetCategory,idSet,idPlaceCategory,idPlace,idTypeSorting,isReverseSorting,idTypeGrouping,isNumbered,isGroupTotal,isTotalInEnd,isPeriodicalSendReport,isSendEmptyReport,idTypeSendMethod,strAdress,idTypeRepeat,intRepeatDays,dateStartRepeat,timeCreateReport,isUse,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ReservationTimes';
$strFields ='isDeleted,idEssentialOwner,idOwner,idType,idColor,idTypeReason,idReservationTimeTemplate,dateTimeDay,intTimeStart,intTimeEnd,intMinutesDuration,strDescription,idNeedSaveInCalendar,intMinutesRemind,idEventCalendar,idSalon,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ReservationTimeTemplates';
$strFields ='isDelete,idEssentialOwner,idColor,timeStart,timeEnd,intMinutesDuration,strDescription,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Resources';
$strFields ='isDeleted,strName,strDescription,strSynonyms,strInventoryNumber,strBarCode,idSalon,idPlace,idCategory,idMainPhoto,intMinutesDuration,isHaveAppointments,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ResourceCategoriesOrder';
$strFields ='isDelete,idCategory,idOwner,dateTimeStart,dateTimeEnd,isManualEdited,dateTimeUpdated,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ResourceCategoriesService';
$strFields ='isDelete,idCategory,idOwner,dateTimeStart,dateTimeEnd,isManualEdited,dateTimeUpdated,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ResourceCategoriesVisit';
$strFields ='isDelete,idCategory,idOwner,dateTimeStart,dateTimeEnd,isManualEdited,dateTimeUpdated,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ResourcesOrder';
$strFields ='isDelete,idResource,idOwner,dateTimeStart,dateTimeEnd,isManualEdited,dateTimeUpdated,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ResourcesService';
$strFields ='isDelete,idResource,idOwner,dateTimeStart,dateTimeEnd,isManualEdited,dateTimeUpdated,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ResourcesVisit';
$strFields ='isDelete,idResource,idOwner,dateTimeStart,dateTimeEnd,isManualEdited,dateTimeUpdated,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Salary';
$strFields ='isDeleted,intYear,intMonth,intDay,idSalon,idPlace,idEmployee,idCurrency,summaAsMaster,summaAsAssistent,summaAsAdministartor,summaForPeriod,summaForRent,summaAsSeller,summaOnHands,summaBonus,summaPenalty,summaFix,isAutoCalculation,dateTimeCalculated,isSdelnoAsMaster,intProcentsMaster,summaFixMoneyMaster,isAccountSkidkiMaster,isAccountRevenuMaster,isAdditionForReturnClient,intAdditionForReturnClientProcents,additionForReturnClientSumma,isSubtractionForNotReturnClient,intSubtractionForNotReturnClientProcents,summaSubtractionForNotReturnClient,isCorrectionByClientRateMaster,intStars1ProcentsMaster,intStars2ProcentsMaster,intStars3ProcentsMaster,intStars4ProcentsMaster,intStars5ProcentsMaster,isSdelnoAsAssistent,intProcentsAsAssistent,summaFixMoneyAsAssistent,isAccountSkidkiAssistent,isAccountRevenuAssistent,isCorrectionByClientRateAssistent,intStars1ProcentsAssistent,intStars2ProcentsAssistent,intStars3ProcentsAssistent,intStars4ProcentsAssistent,intStars5ProcentsAssistent,isAdditionForReturnClientAssistent,intAdditionForReturnClientProcentsAssistent,summaAdditionForReturnClientAssistent,isSubtractionForNotReturnClientAssistent,intSubtractionForNotReturnClientProcentsAssistent,summaSubtractionForNotReturnClientAssistent,isSdelnoAsAdministrator,isAccountSkidkiAdministrator,isAccountRevenuAdministrator,intProcentsCostOrderAdministrator,summaFixMoneyCostOrderAdministrator,intProcentsIncomeCallToVisit,intProcentsOutcomeCallToVisit,isCorrectionByClientRateAdministrator,intStars1ProcentsAdministrator,intStars2ProcentsAdministrator,intStars3ProcentsAdministrator,intStars4ProcentsAdministrator,intStars5ProcentsAdministrator,isPaymentByTime,summaPaymentOklad,idTypeTimePayment,isPaymentByWorkTime,isPaymentByRent,summaPaymentRent,idTypeRentPayment,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Salons';
$strFields ='isDeleted,strFirebase,intCodeFirebase,idCategory,strName,strAlias,strDescription,intINN,intKPP,idTypeLegacy,idMainPhoto,isShowOnline,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'SalonEmployee';
//isAddsAndSubs,summaBonus,summaPenalty,summaFix,
$strFields ='isDeleted,idSalon,idDepartment,idEmployee,strSpecialization,idPosition,idPlace,idSalaryRule,idProfile,isCanChangeProfile,idCurrency,idPricelist,

isHaveAccess,isMaster,isAssistent,isAdministrator,isCanSeeClients,isCanChangeData,intPinCode,intPinCodeAtempts,idStatusInvite,ageSalaryCalculation,

isSdelnoAsMaster,intProcentsMaster,summaFixMoneyMaster,isAccountSkidkiMaster,isAccountRevenuMaster,isAdditionForReturnClient,
intAdditionForReturnClientProcents,summaAdditionForReturnClient,isSubtractionForNotReturnClient,

intSubtractionForNotReturnClientProcents,summaSubtractionForNotReturnClient,isCorrectionByClientRateMaster,
intStars0ProcentsMaster,intStars1ProcentsMaster,intStars2ProcentsMaster,intStars3ProcentsMaster,intStars4ProcentsMaster,intStars5ProcentsMaster,

isSdelnoAsAssistent,intProcentsAsAssistent,summaFixMoneyAsAssistent,isAccountSkidkiAssistent,isAccountRevenuAssistent,
isCorrectionByClientRateAssistent,intStars0ProcentsAssistent,intStars1ProcentsAssistent,intStars2ProcentsAssistent,intStars3ProcentsAssistent,
intStars4ProcentsAssistent,intStars5ProcentsAssistent,isAdditionForReturnClientAssistent,
intAdditionForReturnClientProcentsAssistent,summaAdditionForReturnClientAssistent,isSubtractionForNotReturnClientAssistent,
intSubtractionForNotReturnClientProcentsAssistent,summaSubtractionForNotReturnClientAssistent,

isSdelnoAsAdministrator,
isAccountSkidkiAdministrator,isAccountRevenuAdministrator,intProcentsCostOrderAdministrator,summaFixMoneyCostOrderAdministrator,
intProcentsIncomeCallToVisit,intProcentsOutcomeCallToVisit,isCorrectionByClientRateAdministrator,intStars0ProcentsAdministrator,intStars1ProcentsAdministrator,
intStars2ProcentsAdministrator,intStars3ProcentsAdministrator,intStars4ProcentsAdministrator,intStars5ProcentsAdministrator,

isPaymentByTime,summaPaymentOklad,idTypeTimePayment,isPaymentByWorkTime,isPaymentByRent,summaPaymentRent,idTypeRentPayment,

isShowOnline,strDescriptionOnline,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ServicesEmployee';
$strFields ='isDelete,idOwner,intQuantity,idEssential,idProduct,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Sets';
$strFields ='isDelete,strName,strDescription,cost,isAutoCalculateCost,intMinutesDuration,strBarCode,intUsePeriod,idNotificationRule,isShowOnline,isAutoCalculateDuration,isAbonement,intPeriodUseDays,idTypeStartPeriod,dateTimeStartPeriod,dateTimeEndPeriod,dateTimeUsedBefore,isUsed,intMaxQuantityFreezes,intMaxDaysOneFreeze,intMaxDaysTotalFreezes,isForWoman,isForMan,isForChildren,isNew,isUse,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'SetTaxes';
$strFields ='isDelete,strName,strDescription,idColor,isUse,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'SetTaxContents';
$strFields ='isDelete,idSetTax,idTax,isUse,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'SpendServices';
$strFields ='isDelete,idService,idPlace,idProduct,idUnit,intQuantity,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Subscriptions222';
$strFields ='isDelete,idCodeCountry,idCode,strSKU,cost,idCurrency,idTypePeriod,strTitle,strDescription,intMaxSize,isNewItem,isHitSales,isAvailable,isPayed,dateTimePayed,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Synchronization';
$strFields ='isDelete,strTableName,idPriority,dateTimeGlobalSynchronization,isNeedDownload,intCountBadAtemptsDownload,dateTimeDownload,dateTimeLocalSynchronization,isNeedUpload,intCountBadAtemptsUpload,dateTimeUpload,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Tabs';
$strFields ='isDelete,idEssential,idTab,strName,isShowFab,isShow,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Tasks';
$strFields ='isDelete,idTypeTask,idCategory,idEssentialAction,idEssentialAuthor,idAuthorTask,dateTimeChanged,dateTimeCreated,isReaded,isDone,isUse,isNew,strName,strDescription,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'TaskMembers';
$strFields ='isDelete,idTask,strKeyFirebaseTask,idUser,idEssentialUser,strKeyFirebaseUser,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Taxes';
$strFields ='isDeleted,idForCalculation,strName,strDescription,idTypePeriod,isTaxAddToPrice,isUse,isNew,idColor,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'TaxProcents';
$strFields ='isDelete,idTax,intProcents,summa,summaMinCurrency,summaMaxCurrency,summaDedaction,summaTaxStart,summaTotalTax,isAddWithOthers,isUse,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'TemplateDays';
$strFields ='isDeleted,idTypeDay,intTimeStart,intTimeEnd,idColor,isCanEdit,strName,strDescription,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'TemplateReports';
$strFields ='isDelete,idForCalculation,idTypeReport,isActive,strName,strDescription,idTypePeriod,isPreviousPeriod,isIgnoreVacancy,idClientCategory,idClient,idEmployeeCategory,idEmployee,idProductCategory,idProduct,idServiceCategory,idService,idSetCategory,idSet,idPlaceCategory,idPlace,idTypeSorting,isReverseSorting,idTypeGrouping,isNumbered,isGroupTotal,isTotalInEnd,isPeriodicalSendReport,isSendEmptyReport,idTypeSendMethod,strAdress,idTypeRepeat,intRepeatDays,dateStartRepeat,timeCreateReport,isUse,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'UserProfileTemplates';
$strFields ='isDelete,strName,strDescription,isCanEditClients,isCanDeleteClients,isCanSeeNameClients,isCanSeeFIOClients,isCanSeeContactsClients,isCanEditEmployee,isCanEditVendors,isCanEditSalons,isCanEditAppointments,isCanEditVisits,isCanEditTotalPayments,isCanEditInventarization,isCanEditPrices,isCanEditProducts,isCanEditServices,isCanEditMarketings,isCanEditResources,isCanEditMoney,isCanEditOnline,isCanEditReports,isCanSeeReports,isCanUseCommunicationsWithClients,isCanEditPhotos,isCanEditProfile,isCanEditSettings,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'TheoryWaste';
$strFields ='isDelete,idVisit,idService,idProduct,idWhat,intQuantityProduct,intQuantityContent,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'TotalPayments';
$strFields ='isDelete,idForCalculation,intPaymentNumber,idClient,idCassir,strBarCode,summaBilled,summaSkidka,summaPayed,summaDeposit,summaDebt,summaBonuses,summaTaxes,summaTips,idCurrency,dateTimeEdited,dateTimeCalculated,dateTimePayed,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'TotalSalaries';
$strFields ='isDelete,dateTimeStart,dateTimeEnd,idEmployee,idSalon,summaTotalNachisleno,summaTotalVydano,isAutoCalculation,dateTimeCalculated,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'UILogs';
$strFields ='isDelete,idActivity,iPage,idAction,dateTime,idType,idUI,strNameUI,strValue,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Units';
$strFields ='isDelete,strShortName,strFullName,isUse,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'UserProfiles';
$strFields ='isDelete,idTemplate,idUser,idSalon,strDescription,isCanEditClients,isCanDeleteClients,isCanSeeNameClients,isCanSeeFIOClients,isCanSeeContactsClients,isCanEditEmployee,isCanEditVendors,isCanEditSalons,isCanEditAppointments,isCanEditVisits,isCanEditTotalPayments,isCanEditInventarization,isCanEditPrices,isCanEditProducts,isCanEditServices,isCanEditMarketings,isCanEditResources,isCanEditMoney,isCanEditOnline,isCanEditReports,isCanSeeReports,isCanUseCommunicationsWithClients,isCanEditPhotos,isCanEditProfile,isCanEditSettings,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'UseServices';
$strFields ='isDelete,idType,idEssential,idService,idMaster,idPriceList,intQuantity,intMinutes,cost,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Vendors';
$strFields ='isDelete,idCategory,strName,strAlias,INN,KPP,idTypeLegacy,strDescription,idMainPhoto,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'VisitEmployee';
$strFields ='isDelete,idVisit,idEmployee,dateTimeUpdated,isMainMaster,isMaster,isChecked,summaForServices,summaForProducts,summaForResources,summaForAdministration,summaForTips,isAutoCalculation,dateTimeCalculated,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'WasteMoney';
$strFields ='isDelete,idTotalPayment,idEssentialPayer,idPayer,idEssentialReceiver,idReceiver,idEmployee,idTypePayment,idTypeWaste,idMoneyBase,dateTimePayed,idCurrency,cost,isNew,isSaved,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Wizard';
$strFields ='isDelete,strEmail,strIdDevice,strKeyFirebaseEmployee,idCodeStartAction,idCountry,strCity,idFormatDate,idFormatTime,intFirstDayOfWeek,isTaxIncluded,isShowCurrencyAfterSum,idFunctionality,isUseOnlineServices,idPricelist,idCurrency,idAdministrator,isAllowGeoLocation,isAllowReceiveFomService,isAllowReceiveFomClients,isAllowTemporarySaving,isAllowPublishOnline,isAllowOnlineAppointment,strLink,intMinutesPeriod,intMinutesBreakPeriod,intMinutesReservationBefore,intMinutesReservationStartTime,intMinutesReservationEndTime,idAlgorithm,isAutoSearchReviews,isNotSearchReviewsForLostClients,timeStartSearchReviews,timeEndSearchReviews,strCheckCode,intCheckCode,isDefault,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Zakazes';
$strFields ='isDelete,strClientName,strDescription,dateTimeOrderStart,cost,strAdress,floatLatitude,floatLongitude,isAccepted,dateTimeAccepted,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'GivenAbonements';
$strFields ='isDelete,idEssentialMarketingFrom,idItemMarketingFrom,idTotalPayment,intBuyNumber,idSet,idClient,idEmployee,intPeriodUseDays,idTypeStartPeriod,dateTimeActivation,dateTimeUsedBefore,isUsed,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'GivenAbonementFreeze';
$strFields ='isDelete,idGivenAbonement,dateTimeStart,dateTimeEnd,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'GivenBonuses';
$strFields ='isDelete,idEssentialMarketingFrom,idItemMarketingFrom,idTemplateBonus,idCardBonus,idClient,idEmployee,dateTimeActivation,dateTimeUsedBefore,isUse,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'GivenBonusCards';
$strFields ='isDelete,idEssentialMarketingFrom,idItemMarketingFrom,idTemplateBonus,idClient,idEmployee,strRealCardNumber,strVirtualCardNumber,dateTimeActivation,dateTimeUsedBefore,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'GivenCoupons';
$strFields ='isDelete,idEssentialMarketingFrom,idItemMarketingFrom,strNumber,strBarCode,idCoupon,idClient,idEmployee,dateTimeActivation,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'GivenFlyers';
$strFields ='isDelete,idEssentialMarketingFrom,idItemMarketingFrom,strNumber,strBarCode,idFlyer,idClient,idEmployee,dateTimeActivation,isUse,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'GivenGifts';
$strFields ='isDelete,idEssentialMarketingFrom,idItemMarketingFrom,idTotalPayment,dateTimeUpdated,isChecked,idGift,idClient,idEmployee,dateTimeDelivery,isUse,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'GivenPayments';
$strFields ='isDelete,idTypeMarketing,idMarketing,idClient,idTotalPayment,summa,intQuantity,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'GivenSertificates';
$strFields ='isDelete,idEssentialMarketingFrom,idItemMarketingFrom,strBarCode,idSertificate,intPeriodUseDays,idTypeStartPeriod,dateTimeActivation,dateTimeSaled,idClient,idGroup,idEmployee,isUse,isUsed,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'GivenSkidki';
$strFields ='isDelete,idEssentialMarketingFrom,idItemMarketingFrom,idSkidka,idClient,idEmployee,strDescription,intProcents,summa,dateTimeActivation,dateTimeUsedBefore,isUse,isUsed,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'BonusContent';
$strFields ='isDelete,idOwner,intQuantity,intMinutesDuration,idEssential,idProduct,cost,summaTotal,summaTax,summaTip,isCheckedForPayment,dateTimeUpdated,isManualEdited,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'SertificateContent';
$strFields ='isDelete,idOwner,intQuantity,intMinutesDuration,idEssential,idProduct,cost,summaTotal,summaTax,summaTip,isCheckedForPayment,dateTimeUpdated,isManualEdited,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'SkidkaContent';
$strFields ='isDelete,idOwner,intQuantity,intMinutesDuration,idEssential,idProduct,cost,summaTotal,summaTax,summaTip,isCheckedForPayment,dateTimeUpdated,isManualEdited,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'TemplateBonuses';
$strFields ='isDelete,strName,strDescription,idCriterion,idCurrency,intRateAdd,intRateSub,summaMinBonuses,summaMaxPayment,intProcentsCost,intPeriodUseDays,dateTimeStartPeriod,dateTimeEndPeriod,dateTimeUsedBefore,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'TemplateCoupons';
$strFields ='isDelete,strName,strDescription,summaNominal,summaPrice,idAction,intPeriodUseDays,idTypeStartPeriod,dateTimeUsedBefore,dateTimeStartPeriod,dateTimeEndPeriod,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'TemplateFlyers';
$strFields ='isDelete,strName,strDescription,summaPrice,idAction,intPeriodUseDays,dateTimeUsedBefore,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'TemplateGifts';
$strFields ='isDelete,strName,strDescription,idCriterion,idGiftAction,isUse,isDone,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'TemplateReferalCards';
$strFields ='isDelete,strName,strDescription,intStartNumber,intEndNumber,idActionForSender,idActionForPresenter,intQuantity,dateTimeIssue,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'TemplateSertificates';
$strFields ='isDelete,strName,strDescription,idCriterion,summaNominal,summaPrice,summaMaxPayment,intPeriodUseDays,idTypeStartPeriod,dateTimeUsedBefore,dateTimeStartPeriod,dateTimeEndPeriod,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'TemplateSkidka';
$strFields ='isDelete,strName,strDescription,idCriterion,intProcents,summa,summaBillMin,summaSkidkiMax,intCountTimesForUse,intPeriodUseDays,dateTimeStartPeriod,dateTimeEndPeriod,dateTimeUsedBefore,intProcentsEmployee,isGiveOnlyManual,isAdditive,isExclusive,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'UsedAbonements';
$strFields ='isDelete,idTotalPayment,idGivenAbonement,idProduct,idProductEssential,intQuantity,summaPayment,dateTimeUpdated,isAutoCalculation,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'UsedAbonementsSub';
$strFields ='isDelete,idOwner,intQuantity,intMinutesDuration,idEssential,idProduct,cost,summaTotal,summaTax,summaTip,isCheckedForPayment,dateTimeUpdated,isManualEdited,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'UsedBonusesAdd';
$strFields ='isDelete,idTotalPayment,idGivenBonus,summaBonuses,idClient,idEmployee,dateTimeUpdated,isBurned,isAutoCalculation,isChecked,isUsed,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'UsedBonusesSub';
$strFields ='isDelete,idTotalPayment,idBonusAdd,summaBonuses,summaPayment,isAutoCalculation,dateTimeUpdated,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'UsedSertificates';
$strFields ='isDelete,idTotalPayment,idGivenSertificate,summaPayment,isAutoCalculation,dateTimeUpdated,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'UsedSkidki';
$strFields ='isDelete,idTotalPayment,idGivenSkidka,summaPayment,isAutoCalculation,dateTimeUpdated,isChecked,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Actions';
$strFields ='isDeleted,strName,strDescription,strPromoDescription,ageStartPeriod,ageEndPeriod,isSendMessage,ageSendMessage,idCriterionSendMessage,strBodyMessage,isShowOnline,isNew,isUse,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ActionContents';
$strFields ='isDelete,idAction,idTypeMarketing,idMarketing,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'PaymentPartners';
$strFields ='isDelete,strName,strDescription,strQueryUrl,isUse,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'QueryPaymentsFromPartners';
$strFields ='isDelete,idPartner,summaQuery,summaMax,isHaveAnswer,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ReferalCardItems';
$strFields ='isDelete,idTemplateCard,idEssentialRecipient,idRecipient,idEmployee,strBarCode,dateTimeActivation,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'ReferalCardMovements';
$strFields ='isDelete,idCardItem,idEssentialSender,idSender,idActionForSender,idEssentialPresenter,idPresenter,idActionForPresenter,dateTimeMovement,isUse,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Reklama';
$strFields ='isDelete,strName,strDescription,idCategory,idAction,dateTimeStartPeriod,dateTimeEndPeriod,isUse,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);
$strTableName = 'Reviews';
$strFields ='isDelete,strLink,strContent,idClient,idMaster,idSalon,idAppointment,dateTimeCreated,intRate,isNew,idEssentialAuthor,idAuthor,ageChanged,strJson';
AddDescription($strTableName, $strFields);


?>