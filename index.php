<?php

define('LINE_API',"https://notify-api.line.me/api/notify");





  require __DIR__ . '/vendor/autoload.php';
  /*Get Data From POST Http Request*/
  $datas = file_get_contents('php://input');
  /*Decode Json From LINE Data Body*/
  $deCode = json_decode($datas,true);
  file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
  $replyToken = $deCode['events'][0]['replyToken'];
  $userId = $deCode['events'][0]['source']['userId'];
  $type = $deCode['events'][0]['type'];
  $words = trim($deCode['events'][0]['message']['text']);

  // ********** ต้อง ตัดช่องว่าง
  $token = "zBbSW/cJy2BOX0clUvk3E91A7uV1h6RN1YjYNvNZLR0ntovKjQZvKo7Ctb/3YbUMRXCX1/ynDfmCGuJoIMgYOflHlbVeOE3i6D2tuNQyB44vP+UkihIrz8fFvQEiXqnq76FsOlw7gLmHotKjy4GBgAdB04t89/1O/w1cDnyilFU=";
  $LINEProfileDatas['url'] = "https://api.line.me/v2/bot/profile/".$userId;
    $LINEProfileDatas['token'] = $token;
    // --------------------------------------------------------------------------------------------------------------
    $resultsLineProfile = getLINEProfile($LINEProfileDatas);
    $resultscovid = getcovidtoday();
    $resultsProcovid = getcovidsum();
    $resultsallcovid = getcovidall();

// --------------------------------------------------------------------------------------------------------------
     file_put_contents("log-covid.txt",$resultscovid . PHP_EOL, FILE_APPEND);
    file_put_contents('log-profile.txt', $resultsLineProfile['message'] . PHP_EOL, FILE_APPEND);
// --------------------------------------------------------------------------------------------------------------
    $LINEUserProfile = json_decode($resultsLineProfile['message'],true);
    $covidtodaydecode = json_decode($resultscovid,true);
    $covidProcovid = json_decode($resultsProcovid,true);
    $covidalldecode = json_decode($resultsallcovid,true);

   
// --------------------------------------------------------------------------------------------------------------
$casesallcovid = json_encode("⚠️🌍 ยอดรวมผู้ติดเชื้อรวมทั่วโลก : ".checknull(jsonFormatDecode($covidalldecode['cases'])));
$deathsallcovid = json_encode("☠️🌍 ยอดรวมผู้ป่วยที่เสียชีวิตแล้วทั่วโลก : ".checknull(jsonFormatDecode($covidalldecode['deaths'])));

    // --------------------------------------------------------------------------------------------------------------

    $UpdateDatecovid = json_encode("💡Last Update : ".$covidtodaydecode['UpdateDate']);
    $Confirmedcovid = json_encode("⚠️ ผู้ติดเชื้อประเทศไทย : ".checknull(jsonFormatDecode($covidtodaydecode['Confirmed'])));
    $Recoveredcovid = json_encode("✅ รักษาหายแล้ว : ".checknull(jsonFormatDecode($covidtodaydecode['Recovered'])));
    $Hospitalizedcovid = json_encode("🏥 กำลังรักษา : ".checknull(jsonFormatDecode($covidtodaydecode['Hospitalized'])));
    $Deathscovid = json_encode("☠️ เสียชีวิต : ".checknull(jsonFormatDecode($covidtodaydecode['Deaths'])));
    $NewConfirmedcovid = json_encode("⚠️ ผู้ติดเชื้อใหม่ : ".checknull(jsonFormatDecode($covidtodaydecode['NewConfirmed'])));
    $NewRecoveredcovid = json_encode("✅ รักษาหายแล้ว : ".checknull(jsonFormatDecode($covidtodaydecode['NewRecovered'])));
    $NewHospitalizedcovid = json_encode("🏥 กำลังรักษา : ".checknull(jsonFormatDecode($covidtodaydecode['NewHospitalized'])));
    $NewDeathscovid = json_encode("☠️ เสียชีวิต : ".checknull(jsonFormatDecode($covidtodaydecode['NewDeaths'])));
    $AllCovid = json_encode("=== ยอดรวม ==="."\n\n".jsonFormatDecode($Confirmedcovid)."\n".jsonFormatDecode($Recoveredcovid)."\n".jsonFormatDecode($Hospitalizedcovid)."\n".jsonFormatDecode($Deathscovid)."\n\n"."=== ยอดวันนี้ ==="."\n\n".jsonFormatDecode($NewConfirmedcovid)."\n".jsonFormatDecode($NewRecoveredcovid)."\n".jsonFormatDecode($NewHospitalizedcovid)."\n".jsonFormatDecode($NewDeathscovid)."\n\n"."=== ทั่วโลก ==="."\n\n".jsonFormatDecode($casesallcovid)."\n".jsonFormatDecode($deathsallcovid));
   
    // --------------------------------------------------------------------------------------------------------------
$Bangkok = json_encode("มีผู้ติดเชื้อในจังหวัดกรุงเทพมหานคร : ".checknull(jsonFormatDecode($covidProcovid['Province']['Bangkok'])));
 $UnknownProcovid =  json_encode("🚩 ข้อมูลที่ยังไม่ทราบจังหวัด : ".checknull(jsonFormatDecode($covidProcovid['Province']['Unknown'])));
 $Nonthaburi = json_encode("มีผู้ติดเชื้อในจังหวัดนนทบุรี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Nonthaburi'])));
 $Phuket = json_encode("มีผู้ติดเชื้อในจังหวัดภูเก็ต : ".checknull(jsonFormatDecode($covidProcovid['Province']['Phuket'])));
 $SamutPrakan = json_encode("มีผู้ติดเชื้อในจังหวัดสมุทรปราการ : ".checknull(jsonFormatDecode($covidProcovid['Province']['Samut Prakan'])));
 $Chonburi = json_encode("มีผู้ติดเชื้อในจังหวัดชลบุรี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Chonburi'])));
 $Yala = json_encode("มีผู้ติดเชื้อในจังหวัดยะลา : ".checknull(jsonFormatDecode($covidProcovid['Province']['Yala'])));
 $Pattani = json_encode("มีผู้ติดเชื้อในจังหวัดปัตตานี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Pattani'])));
 $ChiangMai = json_encode("มีผู้ติดเชื้อในจังหวัดเชียงใหม่ : ".checknull(jsonFormatDecode($covidProcovid['Province']['Chiang Mai'])));
 $Songkhla = json_encode("มีผู้ติดเชื้อในจังหวัดสงขลา : ".checknull(jsonFormatDecode($covidProcovid['Province']['Songkhla'])));
 $PathumThani = json_encode("มีผู้ติดเชื้อในจังหวัดปทุมธานี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Pathum Thani'])));
 $NakhonPathom = json_encode("มีผู้ติดเชื้อในจังหวัดนครพนม : ".checknull(jsonFormatDecode($covidProcovid['Province']['Nakhon Pathom'])));
 $SamutSakhon = json_encode("มีผู้ติดเชื้อในจังหวัดสมุทรสาคร : ".checknull(jsonFormatDecode($covidProcovid['Province']['Samut Sakhon'])));
 $NakhonRatchasima = json_encode("มีผู้ติดเชื้อในจังหวัดนครราชสีมา : ".checknull(jsonFormatDecode($covidProcovid['Province']['Nakhon Ratchasima'])));
 $Chachoengsao = json_encode("มีผู้ติดเชื้อในจังหวัดฉะเชิงเทรา : ".checknull(jsonFormatDecode($covidProcovid['Province']['Chachoengsao'])));
 $UbonRatchathani = json_encode("มีผู้ติดเชื้อในจังหวัดอุบลราชธานี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Ubon Ratchathani'])));
 $PrachuapKhiriKhan = json_encode("มีผู้ติดเชื้อในจังหวัดประจวบคีรีขันธ์ : ".checknull(jsonFormatDecode($covidProcovid['Province']['Prachuap Khiri Khan'])));
 $SuratThani = json_encode("มีผู้ติดเชื้อในจังหวัดสุราษฎร์ธานี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Surat Thani'])));
 $Krabi = json_encode("มีผู้ติดเชื้อในจังหวัดกระบี่ : ".checknull(jsonFormatDecode($covidProcovid['Province']['Krabi'])));
 $Buriram = json_encode("มีผู้ติดเชื้อในจังหวัดบูรีรัมย์ : ".checknull(jsonFormatDecode($covidProcovid['Province']['Buriram'])));
 $SaKaeo = json_encode("มีผู้ติดเชื้อในจังหวัดสกลนคร : ".checknull(jsonFormatDecode($covidProcovid['Province']['Sa Kaeo'])));
 $Narathiwat = json_encode("มีผู้ติดเชื้อในจังหวัดนาราธิวาส : ".checknull(jsonFormatDecode($covidProcovid['Province']['Narathiwat'])));
 $ChiangRai = json_encode("มีผู้ติดเชื้อในจังหวัดเชียงราย : ".checknull(jsonFormatDecode($covidProcovid['Province']['Chiang Rai'])));
 $Kanchanaburi = json_encode("มีผู้ติดเชื้อในจังหวัดกาญจนบุรี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Kanchanaburi'])));
 $UdonThani = json_encode("มีผู้ติดเชื้อในจังหวัดอุดรธานี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Udon Thani'])));
 $Surin = json_encode("มีผู้ติดเชื้อในจังหวัดสุรินทร์ : ".checknull(jsonFormatDecode($covidProcovid['Province']['Surin'])));
 $Sisaket = json_encode("มีผู้ติดเชื้อในจังหวัดศรีสะเกษ : ".checknull(jsonFormatDecode($covidProcovid['Province']['Sisaket'])));
 $Ratchaburi = json_encode("มีผู้ติดเชื้อในจังหวัดราชบุรี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Ratchaburi'])));
 $NakhonSawan = json_encode("มีผู้ติดเชื้อในจังหวัดนครสววค์ : ".checknull(jsonFormatDecode($covidProcovid['Province']['Nakhon Sawan'])));
 $NakhonSiThammarat = json_encode("มีผู้ติดเชื้อในจังหวัดนครศรีธรรมราช : ".checknull(jsonFormatDecode($covidProcovid['Province']['Nakhon Si Thammarat'])));
 $Saraburi = json_encode("มีผู้ติดเชื้อในจังหวัดสระบุรี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Saraburi'])));
 $Phatthalung = json_encode("มีผู้ติดเชื้อในจังหวัดพัทลุง : ".checknull(jsonFormatDecode($covidProcovid['Province']['Phatthalung'])));
 $Trang = json_encode("มีผู้ติดเชื้อในจังหวัดตรัง : ".checknull(jsonFormatDecode($covidProcovid['Province']['Trang'])));
 $MaeHongSon = json_encode("มีผู้ติดเชื้อในจังหวัดแม่ฮ่องสอน : ".checknull(jsonFormatDecode($covidProcovid['Province']['Mae Hong Son'])));
 $Rayong = json_encode("มีผู้ติดเชื้อในจังหวัดระยอง : ".checknull(jsonFormatDecode($covidProcovid['Province']['Rayong'])));
 $NongBuaLamphu = json_encode("มีผู้ติดเชื้อในจังหวัดหนองบัวลำพูล : ".checknull(jsonFormatDecode($covidProcovid['Province']['Nong Bua Lamphu'])));
 $Mukdahan = json_encode("มีผู้ติดเชื้อในจังหวัดมุกดาหาร : ".checknull(jsonFormatDecode($covidProcovid['Province']['Mukdahan'])));
 $KhonKaen = json_encode("มีผู้ติดเชื้อในจังหวัดขอนแข่น : ".checknull(jsonFormatDecode($covidProcovid['Province']['Khon Kaen'])));
 $Prachinburi = json_encode("มีผู้ติดเชื้อในจังหวัดปราจีนบุรี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Prachinburi'])));
 $RoiEt = json_encode("มีผู้ติดเชื้อในจังหวัดร้อยเอ็ด : ".checknull(jsonFormatDecode($covidProcovid['Province']['Roi Et'])));
 $Chanthaburi = json_encode("มีผู้ติดเชื้อในจังหวัดจันทบุรี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Chanthaburi'])));
 $Sukhothai = json_encode("มีผู้ติดเชื้อในจังหวัดสุโขทัย : ".checknull(jsonFormatDecode($covidProcovid['Province']['Sukhothai'])));
 $Phetchabun = json_encode("มีผู้ติดเชื้อในจังหวัดเพชรบูรณ์ : ".checknull(jsonFormatDecode($covidProcovid['Province']['Phetchabun'])));
 $Kalasin = json_encode("มีผู้ติดเชื้อในจังหวัดกาฬสินธุ์ : ".checknull(jsonFormatDecode($covidProcovid['Province']['Kalasin'])));
 $Uttaradit = json_encode("มีผู้ติดเชื้อในจังหวัดอุตรดิตถ์   : ".checknull(jsonFormatDecode($covidProcovid['Province']['Uttaradit'])));
 $Phitsanulok = json_encode("มีผู้ติดเชื้อในจังหวัดพิษณุโลก : ".checknull(jsonFormatDecode($covidProcovid['Province']['Phitsanulok'])));
 $Phayao = json_encode("มีผู้ติดเชื้อในจังหวัดพะเยา : ".checknull(jsonFormatDecode($covidProcovid['Province']['Phayao'])));
 $AmnatCharoen = json_encode("มีผู้ติดเชื้อในจังหวัดอำนาจเจริญ : ".checknull(jsonFormatDecode($covidProcovid['Province']['Amnat Charoen'])));
 $Chaiyaphum = json_encode("มีผู้ติดเชื้อในจังหวัดชัยภูมิ : ".checknull(jsonFormatDecode($covidProcovid['Province']['Chaiyaphum'])));
 $Lopburi = json_encode("มีผู้ติดเชื้อในจังหวัดลพบุรี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Lopburi'])));
 $SuphanBuri = json_encode("มีผู้ติดเชื้อในจังหวัดสุพรรณบุรี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Suphan Buri'])));
 $NakhonNayok = json_encode("มีผู้ติดเชื้อในจังหวัดนครนายก : ".checknull(jsonFormatDecode($covidProcovid['Province']['Nakhon Nayok'])));
 $Phetchaburi = json_encode("มีผู้ติดเชื้อในจังหวัดเพชรบุรี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Phetchaburi']))."คน ");
 $Loei = json_encode("มีผู้ติดเชื้อในจังหวัดเลย : ".checknull(jsonFormatDecode($covidProcovid['Province']['Loei'])));
 $Lamphun = json_encode("มีผู้ติดเชื้อในจังหวัดลำพูน : ".checknull(jsonFormatDecode($covidProcovid['Province']['Lamphun'])));
 $Tak = json_encode("มีผู้ติดเชื้อในจังหวัดตาก : ".checknull(jsonFormatDecode($covidProcovid['Province']['Tak'])));
 $NongKhai = json_encode("มีผู้ติดเชื้อในจังหวัดหนองคาย : ".checknull(jsonFormatDecode($covidProcovid['Province']['Nong Khai'])));
 $Phrae = json_encode("มีผู้ติดเชื้อในจังหวัดแพร่ : ".checknull(jsonFormatDecode($covidProcovid['Province']['Phrae'])));
 $Yasothon = json_encode("มีผู้ติดเชื้อในจังหวัดยโสธร : ".checknull(jsonFormatDecode($covidProcovid['Province']['Yasothon'])));
 $Chumphon = json_encode("มีผู้ติดเชื้อในจังหวัดชุมพร : ".checknull(jsonFormatDecode($covidProcovid['Province']['Chumphon'])));
 $NakhonPhanom = json_encode("มีผู้ติดเชื้อในจังหวัดนครพนม : ".checknull(jsonFormatDecode($covidProcovid['Province']['Nakhon Phanom'])));
 $UthaiThani = json_encode("มีผู้ติดเชื้อในจังหวัดอุทัยธานี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Uthai Thani'])));
 $MahaSarakham = json_encode("มีผู้ติดเชื้อในจังหวัดมหาสารคาม : ".checknull(jsonFormatDecode($covidProcovid['Province']['Maha Sarakham'])));
 $Lampang = json_encode("มีผู้ติดเชื้อในจังหวัดลำปาง : ".checknull(jsonFormatDecode($covidProcovid['Province']['Lampang'])));
 $PhraNakhonSiAyutthaya = json_encode("มีผู้ติดเชื้อในจังหวัดพระนครศรีอยุทธยา : ".checknull(jsonFormatDecode($covidProcovid['Province']['Phra Nakhon Si Ayutthaya'])));
$Trat= json_encode("มีผู้ติดเชื้อในจังหวัดตราด : ".checknull(jsonFormatDecode($covidProcovid['Province']['Trat'])));
$Phangnga= json_encode("มีผู้ติดเชื้อในจังหวัดพังงา : ".checknull(jsonFormatDecode($covidProcovid['Province']['Phangnga'])));
$Ranong= json_encode("มีผู้ติดเชื้อในจังหวัดระนอง : ".checknull(jsonFormatDecode($covidProcovid['Province']['Ranong'])));
$Nan = json_encode("มีผู้ติดเชื้อในจังหวัดน่าน : ".checknull(jsonFormatDecode($covidProcovid['Province']['Nan'])));

$KamphaengPhet = json_encode("มีผู้ติดเชื้อในจังหวัดกำแพงเพชร : ".checknull(jsonFormatDecode($covidProcovid['Province'][' Kamphaeng Phet'])));
$Chainat = json_encode("มีผู้ติดเชื้อในจังหวัดชัยนาจ  : ".checknull(jsonFormatDecode($covidProcovid['Province']['Chainat'])));
$Phichit = json_encode("มีผู้ติดเชื้อในจังหวัดพิจิตร  : ".checknull(jsonFormatDecode($covidProcovid['Province']['Phichit'])));
$SamutSongkhram = json_encode("มีผู้ติดเชื้อในจังหวัดสมุทรสงคราม : ".checknull(jsonFormatDecode($covidProcovid['Province']['Samut Songkhram'])));
$SingBuri = json_encode("มีผู้ติดเชื้อในจังหวัดสิงห์บุรี : ".checknull(jsonFormatDecode($covidProcovid['Province']['Sing Buri'])));
$AngThong = json_encode("มีผู้ติดเชื้อในจังหวัดอ่างทอง : ".checknull(jsonFormatDecode($covidProcovid['Province']['Ang Thong'])));
$SaKaeo = json_encode("มีผู้ติดเชื้อในจังหวัดสระแก้ว : ".checknull(jsonFormatDecode($covidProcovid['Province']['Sa Kaeo'])));
$Satun = json_encode("มีผู้ติดเชื้อในจังหวัดสตูล : ".checknull(jsonFormatDecode($covidProcovid['Province']['Satun'])));

        // --------------------------------------------------------------------------------------------------------------
//         $Chinese = json_encode("สัญชาติจีน : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Chinese'])));
//         $French = json_encode("สัญชาติฝรั่งเศส : ".checknull(jsonFormatDecode($covidProcovid['Nation']['French'])));
//         $English = json_encode("สัญชาติอังกฤษ : ".checknull(jsonFormatDecode($covidProcovid['Nation']['English'])));
//         $Japanese = json_encode("สัญชาติญี่ปุ่น : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Japanese'])));
//         $Canadian = json_encode("สัญชาติแคนนาดา : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Canadian'])));
//         $Burmese = json_encode("สัญชาติพม่า : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Burmese'])));
//         $German = json_encode("สัญชาติเยอรมัน : ".checknull(jsonFormatDecode($covidProcovid['Nation']['German'])));
//         $Russian = json_encode("สัญชาติรัชเซีย : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Russian'])));
//         $Italian = json_encode("สัญชาติอิตาลี : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Italian'])));
//         $Swedish = json_encode("สัญชาติสวีเดน : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Swedish'])));
//         $Danish = json_encode("สัญชาติเดนมาร์ก : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Danish'])));
//         $Belgian = json_encode("สัญชาติเบลเยี่ยม : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Belgian'])));
//         $Swiss = json_encode("สัญชาติสวิสเซอร์แลนด์ : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Swiss'])));
//         $Pakistani = json_encode("สัญชาติปากีสถาน : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Pakistani'])));
//         $Singaporean = json_encode("สัญชาติสิงคโปร์ : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Singaporean'])));
//         $Korean = json_encode("สัญชาติเกาหลี : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Korean'])));
//         $Portuguese = json_encode("สัญชาติโปรตุเกส : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Portuguese'])));
//         $Spain = json_encode("สัญชาติสเปน : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Spain'])));
//         $Malaysian = json_encode("สัญชาติมาเลเชีย : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Malaysian'])));
//         $Indian = json_encode("สัญชาติอินเดีย : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Indian'])));
//         $Cambodian = json_encode("สัญชาติกัมพูชา : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Cambodian'])));
//         $Indonesian = json_encode("สัญชาติอินโดนีเซีย : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Indonesian'])));
//         $NewZealand = json_encode("สัญชาตินิวซีแลนด์ : ".checknull(jsonFormatDecode($covidProcovid['Nation']['New Zealand'])));
//         $Filipino = json_encode("สัญชาติฟิลิปปินส์ : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Filipino'])));
//         $Finnish = json_encode("สัญชาติฟินแลนด์ : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Finnish'])));
//         $Laotian = json_encode("สัญชาติลาว : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Laotian'])));
//         $Ukrainian = json_encode("สัญชาติยูเครน : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Ukrainian'])));
//         $Taiwanese = json_encode("สัญชาติไต้หวัน : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Taiwanese'])));
//         $Uzbeks = json_encode("สัญชาติอุซเบกิสถาน : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Uzbeks'])));
//         $American =json_encode("สัญชาติอเมริกัน : ".checknull(jsonFormatDecode($covidProcovid['Nation']['American'])));
// $Australian =json_encode("สัญชาติออสเตรเลีย : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Australian'])));
// $Tunisian =json_encode("สัญชาติตูนิเซีย : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Tunisian'])));
// $British =json_encode("สัญชาติบริติช : ".checknull(jsonFormatDecode($covidProcovid['Nation']['British'])));
// $Iranian =json_encode("สัญชาติอิหร่าน : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Iranian'])));
// $Mexican =json_encode("สัญชาติเม็กซิกัน : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Mexican'])));
// $Liberian =json_encode("สัญชาติไลบีเรีย : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Liberian'])));
// $IndianThai =json_encode("สัญชาติอินเดีย : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Indian-Thai'])));
// $Vietnamese =json_encode("สัญชาติเวียดนาม : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Vietnamese'])));
// $Serbian =json_encode("สัญชาติเซอเบีย : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Serbian'])));
// $Albanian =json_encode("สัญชาติแอลเบเนีย : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Albanian'])));
// $Hungarian =json_encode("สัญชาติฮังการี : ".checknull(jsonFormatDecode($covidProcovid['Nation']['Hungarian'])));
  // --------------------------------------------------------------------------------------------------------------

$numorternation = checknull(jsonFormatDecode($covidProcovid['Nation']['Chinese'])+jsonFormatDecode($covidProcovid['Nation']['French'])+jsonFormatDecode($covidProcovid['Nation']['English'])+jsonFormatDecode($covidProcovid['Nation']['Japanese'])+jsonFormatDecode($covidProcovid['Nation']['American'])+jsonFormatDecode($covidProcovid['Nation']['Russian'])+jsonFormatDecode($covidProcovid['Nation']['Canadian'])+jsonFormatDecode($covidProcovid['Nation']['Burmese'])+jsonFormatDecode($covidProcovid['Nation']['Italian'])+jsonFormatDecode($covidProcovid['Nation']['Swedish'])+jsonFormatDecode($covidProcovid['Nation']['German'])+jsonFormatDecode($covidProcovid['Nation']['Belgian'])+jsonFormatDecode($covidProcovid['Nation']['Swiss'])+jsonFormatDecode($covidProcovid['Nation']['Danish'])+jsonFormatDecode($covidProcovid['Nation']['Pakistani'])+jsonFormatDecode($covidProcovid['Nation']['Indian'])+jsonFormatDecode($covidProcovid['Nation']['Australian'])+jsonFormatDecode($covidProcovid['Nation']['Korean'])+jsonFormatDecode($covidProcovid['Nation']['Singaporean'])+jsonFormatDecode($covidProcovid['Nation']['Filipino'])+jsonFormatDecode($covidProcovid['Nation']['Spain'])+jsonFormatDecode($covidProcovid['Nation']['Portuguese'])+jsonFormatDecode($covidProcovid['Nation']['Cambodian'])+jsonFormatDecode($covidProcovid['Nation']['Malaysian'])+jsonFormatDecode($covidProcovid['Nation']['Albanian'])+jsonFormatDecode($covidProcovid['Nation']['Indonesian'])+jsonFormatDecode($covidProcovid['Nation']['Mexican'])+jsonFormatDecode($covidProcovid['Nation']['New Zealand'])+jsonFormatDecode($covidProcovid['Nation']['Finnish'])+jsonFormatDecode($covidProcovid['Nation']['Dutch'])+jsonFormatDecode($covidProcovid['Nation']['Iranian'])+jsonFormatDecode($covidProcovid['Nation']['Ukrainian'])+jsonFormatDecode($covidProcovid['Nation']['Laotian'])+jsonFormatDecode($covidProcovid['Nation']['British'])+jsonFormatDecode($covidProcovid['Nation']['Vietnamese'])+jsonFormatDecode($covidProcovid['Nation']['Serbian'])+jsonFormatDecode($covidProcovid['Nation']['Taiwanese'])+jsonFormatDecode($covidProcovid['Nation']['Hungarian'])+jsonFormatDecode($covidProcovid['Nation']['Indian-Thai'])+jsonFormatDecode($covidProcovid['Nation']['Tunisian'])+jsonFormatDecode($covidProcovid['Nation']['Uzbeks'])+jsonFormatDecode($covidProcovid['Nation']['Liberian']));
        $Detailcovid = json_encode( date("d/m/Y") ."\n\n📝🇹🇭🚨🦠🌡 \nผู้ติดเชื้อสะสมในประเทศไทยจำนวน ".checknull(jsonFormatDecode($covidtodaydecode['Confirmed']))." ( เพิ่มขึ้น ".checknull(jsonFormatDecode($covidtodaydecode['NewConfirmed']))." )\nเสียชีวิตแล้ว ".checknull(jsonFormatDecode($covidtodaydecode['Deaths']))." ( เพิ่มขึ้น ".checknull(jsonFormatDecode($covidtodaydecode['NewDeaths']))."  )\n--------------\n🇹🇭 เป็นชาวไทยจำนวน ".checknull(jsonFormatDecode($covidProcovid['Nation']['Thai']))." \n🏳️‍🌈 เป็นชาวต่างชาติจำนวน ".$numorternation." \n🏳️ ไม่ทราบสัญชาติ ".checknull(jsonFormatDecode($covidProcovid['Nation']['Unknown']))." \n--------------\n🚹 เพศชายจำนวน ".checknull(jsonFormatDecode($covidProcovid['Gender']['Male']))." \n🚺 เพศหญิง ".checknull(jsonFormatDecode($covidProcovid['Gender']['Female']))." \n❔ ไม่ทราบเพศ ".checknull(jsonFormatDecode($covidProcovid['Gender']['Unknown']))." \n\n#ข้อมูลจากกรมควบคุมโรค"."\n\n"."🌍🌎🌍🌍🌍\nผู้ติดเชื้อสะสมในโลกจำนวน ".checknull(jsonFormatDecode($covidalldecode['cases']))." ( เพิ่มขึ้น ".checknull(jsonFormatDecode($covidalldecode['todayCases']))."  )\nเสียชีวิตแล้ว ".checknull(jsonFormatDecode($covidalldecode['deaths']))." ( เพิ่มขึ้น ".checknull(jsonFormatDecode($covidalldecode['todayDeaths']))."  )");
  // --------------------------------------------------------------------------------------------------------------

    $displayName = $LINEUserProfile['displayName'];
    $displayImage = $LINEUserProfile['pictureUrl'];
    $wordstart = json_encode("🙏🏼 สวัสดีครับ คุณ ".$displayName." 🙏🏼 \n"."\n 📃 ผม Tid-Yang-Wa BOT รายงานสถานการณ์โควิด-19 ในประเทศไทยครับ ดูแลสุขภาพด้วยนะครับ🦠");
    $LINEDatas['token'] = $token;

    $client = new \Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes(\Google_Service_Sheets::SPREADSHEETS);
    $client->setAuthConfig(__DIR__.'/plasma-centaur-273314-c328d8fb0be6.json');
    $client->setAccessType('offline');
    // $client->setPrompt('select_account consent');

    $service = new \Google_Service_Sheets($client);

    $spreadsheetId = "1BNQ9vvK4ddrnVgw4BVcdMDJN4oIGpPVTlhM0NiyZUoY";

    // updateData($spreadsheetId,$service);
    insertData($spreadsheetId,$service,$userId,$displayName,$words,$displayImage);
    //insertData2($spreadsheetId,$service,$displayImage);

// --------------------------------------------------------------------------------------------------------------

   $jsonUpdateDatecovid = '{
    "type": "text",
    "text":'.$UpdateDatecovid.'
}';
  $decodejsonUpdateDatecovid = jsonFormatDecode($jsonUpdateDatecovid);
// --------------------------------------------------------------------------------------------------------------
 $jsonConfirmedcovid = '{
    "type": "text",
    "text": '.$Confirmedcovid.'
}';
  $decodejsonConfirmedcovid = jsonFormatDecode($jsonConfirmedcovid);

   $jsonRecoveredcovid = '{
    "type": "text",
    "text": '.$Recoveredcovid.'
}';
  $decodejsonRecoveredcovid = jsonFormatDecode($jsonRecoveredcovid);
  
   $jsonHospitalizedcovid = '{
    "type": "text",
    "text": '.$Hospitalizedcovid.'
}';
  $decodejsonHospitalizedcovid = jsonFormatDecode($jsonHospitalizedcovid);
  
   $jsonDeathscovid = '{
    "type": "text",
    "text": '.$Deathscovid.'
}';
  $decodejsonDeathscovid = jsonFormatDecode($jsonDeathscovid);
  
   $jsonNewConfirmedcovid = '{
    "type": "text",
    "text": '.$NewConfirmedcovid.'
}';
  $decodejsonNewConfirmedcovid = jsonFormatDecode($jsonNewConfirmedcovid);
  
   $jsonNewRecoveredcovid = '{
    "type": "text",
    "text": '.$NewRecoveredcovid.'
}';
  $decodejsonNewRecoveredcovid = jsonFormatDecode($jsonNewRecoveredcovid);
  
   $jsonNewHospitalizedcovid = '{
    "type": "text",
    "text": '.$NewHospitalizedcovid.'
}';
  $decodejsonNewHospitalizedcovid = jsonFormatDecode($jsonNewHospitalizedcovid);
  
   $jsonNewDeathscovid = '{
    "type": "text",
    "text": '.$NewDeathscovid.'
}';
  $decodejsonNewDeathscovid = jsonFormatDecode($jsonNewDeathscovid);
  
  $jsonAllcovid = '{
    "type": "text",
    "text": '.$AllCovid.'
}';
  $decodejsonAllcovid = jsonFormatDecode($jsonAllcovid);
// --------------------------------------------------------------------------------------------------------------
  $jsonProvince = '{
    "type": "text",
    "text": " เลือกจังหวัดได้เลยครับ "
}';
  $decodejsonProvince = jsonFormatDecode($jsonProvince);
  // --------------------------------------------------------------------------------------------------------------
// 77 จังหวัด
 $jsonBangkok = '{
    "type": "text",
    "text": '.$Bangkok.'
}';
  $decodejsonBangkok = jsonFormatDecode($jsonBangkok);
  $jsonUnknownProcovid = '{
    "type": "text",
    "text": '.$UnknownProcovid.'
}';
$decodejsonUnknownProcovid = jsonFormatDecode($jsonUnknownProcovid);
//  $Nonthaburi 
$jsonNonthaburi = '{
    "type": "text",
    "text": '.$Nonthaburi.'
}';
$decodejsonNonthaburi = jsonFormatDecode($jsonNonthaburi);
//  $Phuket 
$jsonPhuket = '{
    "type": "text",
    "text": '.$Phuket.'
}';
$decodejsonPhuket = jsonFormatDecode($jsonPhuket);

//  $SamutPrakan 
$jsonSamutPrakan = '{
    "type": "text",
    "text": '.$SamutPrakan.'
}';
$decodejsonSamutPrakan = jsonFormatDecode($jsonSamutPrakan);
//  $Chonburi
$jsonChonburi = '{
    "type": "text",
    "text": '.$Chonburi.'
}';
$decodejsonChonburi = jsonFormatDecode($jsonChonburi);

//  $Yala 
$jsonYala = '{
    "type": "text",
    "text": '.$Yala.'
}';
$decodejsonYala = jsonFormatDecode($jsonYala);

//  $Pattani 
$jsonPattani = '{
    "type": "text",
    "text": '.$Pattani.'
}';
$decodejsonPattani = jsonFormatDecode($jsonPattani);

//  $ChiangMai 
$jsonChiangMai = '{
    "type": "text",
    "text": '.$ChiangMai.'
}';
$decodejsonChiangMai = jsonFormatDecode($jsonChiangMai);

//  $Songkhla 
$jsonSongkhla = '{
    "type": "text",
    "text": '.$Songkhla.'
}';
$decodejsonSongkhla = jsonFormatDecode($jsonSongkhla);

//  $PathumThani 
$jsonPathumThani = '{
    "type": "text",
    "text": '.$PathumThani.'
}';
$decodejsonPathumThani = jsonFormatDecode($jsonPathumThani);

//  $NakhonPathom 
$jsonNakhonPathom = '{
    "type": "text",
    "text": '.$NakhonPathom.'
}';
$decodejsonNakhonPathom = jsonFormatDecode($jsonNakhonPathom);
//  $SamutSakhon 
$jsonSamutSakhon = '{
    "type": "text",
    "text": '.$SamutSakhon.'
}';
$decodejsonSamutSakhon = jsonFormatDecode($jsonSamutSakhon);

//  $NakhonRatchasima 
$jsonNakhonRatchasima = '{
    "type": "text",
    "text": '.$NakhonRatchasima.'
}';
$decodejsonNakhonRatchasima = jsonFormatDecode($jsonNakhonRatchasima);

//  $Chachoengsao 
$jsonChachoengsao = '{
    "type": "text",
    "text": '.$Chachoengsao.'
}';
$decodejsonChachoengsao = jsonFormatDecode($jsonChachoengsao);

//  $UbonRatchathani 
$jsonUbonRatchathani = '{
    "type": "text",
    "text": '.$UbonRatchathani.'
}';
$decodejsonUbonRatchathani = jsonFormatDecode($jsonUbonRatchathani);

//  $PrachuapKhiriKhan 
$jsonPrachuapKhiriKhan = '{
    "type": "text",
    "text": '.$PrachuapKhiriKhan.'
}';
$decodejsonPrachuapKhiriKhan = jsonFormatDecode($jsonPrachuapKhiriKhan);

//  $SuratThani
$jsonSuratThani = '{
    "type": "text",
    "text": '.$SuratThani.'
}';
$decodejsonSuratThani = jsonFormatDecode($jsonSuratThani); 

//  $Krabi
$jsonKrabi = '{
    "type": "text",
    "text": '.$Krabi.'
}';
$decodejsonKrabi = jsonFormatDecode($jsonKrabi); 

//  $Buriram
$jsonBuriram = '{
    "type": "text",
    "text": '.$Buriram.'
}';
$decodejsonBuriram = jsonFormatDecode($jsonBuriram);  

//  $SaKaeo
$jsonSaKaeo = '{
    "type": "text",
    "text": '.$SaKaeo.'
}';
$decodejsonSaKaeo = jsonFormatDecode($jsonSaKaeo); 

//  $Narathiwat
$jsonNarathiwat = '{
    "type": "text",
    "text": '.$Narathiwat.'
}';
$decodejsonNarathiwat = jsonFormatDecode($jsonNarathiwat); 

//  $ChiangRai
$jsonChiangRai = '{
    "type": "text",
    "text": '.$ChiangRai.'
}';
$decodejsonChiangRai = jsonFormatDecode($jsonChiangRai);  

//  $Kanchanaburi
$jsonKanchanaburi = '{
    "type": "text",
    "text": '.$Kanchanaburi.'
}';
$decodejsonKanchanaburi = jsonFormatDecode($jsonKanchanaburi);   

//  $UdonThani
$jsonUdonThani = '{
    "type": "text",
    "text": '.$UdonThani.'
}';
$decodejsonUdonThani = jsonFormatDecode($jsonUdonThani);   

//  $Surin
$jsonSurin = '{
    "type": "text",
    "text": '.$Surin.'
}';
$decodejsonSurin = jsonFormatDecode($jsonSurin);  

//  $Sisaket
$jsonSisaket = '{
    "type": "text",
    "text": '.$Sisaket.'
}';
$decodejsonSisaket = jsonFormatDecode($jsonSisaket);  

//  $Ratchaburi
$jsonRatchaburi = '{
    "type": "text",
    "text": '.$Ratchaburi.'
}';
$decodejsonRatchaburi = jsonFormatDecode($jsonRatchaburi); 

//  $NakhonSawan
$jsonNakhonSawan = '{
    "type": "text",
    "text": '.$NakhonSawan.'
}';
$decodejsonNakhonSawan = jsonFormatDecode($jsonNakhonSawan);

//  $NakhonSiThammarat
$jsonNakhonSiThammarat = '{
    "type": "text",
    "text": '.$NakhonSiThammarat.'
}';
$decodejsonNakhonSiThammarat = jsonFormatDecode($jsonNakhonSiThammarat); 

//  $Saraburi
$jsonSaraburi = '{
    "type": "text",
    "text": '.$Saraburi.'
}';
$decodejsonSaraburi = jsonFormatDecode($jsonSaraburi);  

//  $Phatthalung
$jsonPhatthalung = '{
    "type": "text",
    "text": '.$Phatthalung.'
}';
$decodejsonPhatthalung = jsonFormatDecode($jsonPhatthalung); 

//  $Trang
$jsonTrang = '{
    "type": "text",
    "text": '.$Trang.'
}';
$decodejsonTrang = jsonFormatDecode($jsonTrang);

//  $MaeHongSon
$jsonMaeHongSon = '{
    "type": "text",
    "text": '.$MaeHongSon.'
}';
$decodejsonMaeHongSon = jsonFormatDecode($jsonMaeHongSon); 

//  $Rayong
$jsonRayong = '{
    "type": "text",
    "text": '.$Rayong.'
}';
$decodejsonRayong = jsonFormatDecode($jsonRayong); 

//  $NongBuaLamphu
$jsonNongBuaLamphu = '{
    "type": "text",
    "text": '.$NongBuaLamphu.'
}';
$decodejsonNongBuaLamphu = jsonFormatDecode($jsonNongBuaLamphu); 

//  $Mukdahan
$jsonMukdahan = '{
    "type": "text",
    "text": '.$Mukdahan.'
}';
$decodejsonMukdahan = jsonFormatDecode($jsonMukdahan); 

//  $KhonKaen
$jsonKhonKaen = '{
    "type": "text",
    "text": '.$KhonKaen.'
}';
$decodejsonKhonKaen = jsonFormatDecode($jsonKhonKaen);  

//  $Prachinburi
$jsonPrachinburi = '{
    "type": "text",
    "text": '.$Prachinburi.'
}';
$decodejsonPrachinburi = jsonFormatDecode($jsonPrachinburi); 

//  $RoiEt
$jsonRoiEt = '{
    "type": "text",
    "text": '.$RoiEt.'
}';
$decodejsonRoiEt = jsonFormatDecode($jsonRoiEt); 

//  $Chanthaburi
$jsonChanthaburi = '{
    "type": "text",
    "text": '.$Chanthaburi.'
}';
$decodejsonChanthaburi = jsonFormatDecode($jsonChanthaburi); 

//  $Sukhothai
$jsonSukhothai = '{
    "type": "text",
    "text": '.$Sukhothai.'
}';
$decodejsonSukhothai = jsonFormatDecode($jsonSukhothai); 

//  $Phetchabun
$jsonPhetchabun = '{
    "type": "text",
    "text": '.$Phetchabun.'
}';
$decodejsonPhetchabun = jsonFormatDecode($jsonPhetchabun); 

//  $Kalasin
$jsonKalasin = '{
    "type": "text",
    "text": '.$Kalasin.'
}';
$decodejsonKalasin = jsonFormatDecode($jsonKalasin); 

//  $Uttaradit
$jsonUttaradit = '{
    "type": "text",
    "text": '.$Uttaradit.'
}';
$decodejsonUttaradit = jsonFormatDecode($jsonUttaradit); 

//  $Phitsanulok
$jsonPhitsanulok = '{
    "type": "text",
    "text": '.$Phitsanulok.'
}';
$decodejsonPhitsanulok = jsonFormatDecode($jsonPhitsanulok); 

//  $Phayao
$jsonPhayao = '{
    "type": "text",
    "text": '.$Phayao.'
}';
$decodejsonPhayao = jsonFormatDecode($jsonPhayao); 

//  $AmnatCharoen
$jsonAmnatCharoen = '{
    "type": "text",
    "text": '.$AmnatCharoen.'
}';
$decodejsonAmnatCharoen = jsonFormatDecode($jsonAmnatCharoen); 

//  $Chaiyaphum
$jsonChaiyaphum = '{
    "type": "text",
    "text": '.$Chaiyaphum.'
}';
$decodejsonChaiyaphum = jsonFormatDecode($jsonChaiyaphum); 

//  $Lopburi
$jsonLopburi = '{
    "type": "text",
    "text": '.$Lopburi.'
}';
$decodejsonLopburi = jsonFormatDecode($jsonLopburi); 

//  $SuphanBuri
$jsonSuphanBuri = '{
    "type": "text",
    "text": '.$SuphanBuri.'
}';
$decodejsonSuphanBuri = jsonFormatDecode($jsonSuphanBuri); 

//  $NakhonNayok
$jsonNakhonNayok = '{
    "type": "text",
    "text": '.$NakhonNayok.'
}';
$decodejsonNakhonNayok = jsonFormatDecode($jsonNakhonNayok); 

//  $Phetchaburi
$jsonPhetchaburi = '{
    "type": "text",
    "text": '.$Phetchaburi.'
}';
$decodejsonPhetchaburi = jsonFormatDecode($jsonPhetchaburi); 

//  $Loei
$jsonLoei = '{
    "type": "text",
    "text": '.$Loei.'
}';
$decodejsonLoei = jsonFormatDecode($jsonLoei);

//  $Lamphun
$jsonLamphun = '{
    "type": "text",
    "text": '.$Lamphun.'
}';
$decodejsonLamphun = jsonFormatDecode($jsonLamphun); 

//  $Tak
$jsonTak = '{
    "type": "text",
    "text": '.$Tak.'
}';
$decodejsonTak = jsonFormatDecode($jsonTak); 

//  $NongKhai
$jsonNongKhai = '{
    "type": "text",
    "text": '.$NongKhai.'
}';
$decodejsonNongKhai = jsonFormatDecode($jsonNongKhai); 

//  $Phrae
$jsonPhrae = '{
    "type": "text",
    "text": '.$Phrae.'
}';
$decodejsonPhrae = jsonFormatDecode($jsonPhrae); 

//  $Yasothon
$jsonYasothon = '{
    "type": "text",
    "text": '.$Yasothon.'
}';
$decodejsonYasothon = jsonFormatDecode($jsonYasothon); 

//  $Chumphon
$jsonChumphon = '{
    "type": "text",
    "text": '.$Chumphon.'
}';
$decodejsonChumphon = jsonFormatDecode($jsonChumphon);

//  $NakhonPhanom
$jsonNakhonPhanom = '{
    "type": "text",
    "text": '.$NakhonPhanom.'
}';
$decodejsonNakhonPhanom = jsonFormatDecode($jsonNakhonPhanom); 

//  $UthaiThani
$jsonUthaiThani = '{
    "type": "text",
    "text": '.$UthaiThani.'
}';
$decodejsonUthaiThani = jsonFormatDecode($jsonUthaiThani); 

//  $MahaSarakham 
$jsonMahaSarakham = '{
    "type": "text",
    "text": '.$MahaSarakham.'
}';
$decodejsonMahaSarakham = jsonFormatDecode($jsonMahaSarakham);

//  $Lampang
$jsonLampang = '{
    "type": "text",
    "text": '.$Lampang.'
}';
$decodejsonLampang = jsonFormatDecode($jsonLampang); 

//  $PhraNakhonSiAyutthaya
$jsonPhraNakhonSiAyutthaya = '{
    "type": "text",
    "text": '.$PhraNakhonSiAyutthaya.'
}';
$decodejsonPhraNakhonSiAyutthaya = jsonFormatDecode($jsonPhraNakhonSiAyutthaya);  

// $Trat
$jsonTrat = '{
    "type": "text",
    "text": '.$Trat.'
}';
$decodejsonTrat = jsonFormatDecode($jsonTrat);

// $Phangnga
$jsonPhangnga = '{
    "type": "text",
    "text": '.$Phangnga.'
}';
$decodejsonPhangnga = jsonFormatDecode($jsonPhangnga);

// $Ranong
$jsonRanong = '{
    "type": "text",
    "text": '.$Ranong.'
}';
$decodejsonRanong = jsonFormatDecode($jsonRanong);

// $Nan
$jsonNan = '{
    "type": "text",
    "text": '.$Nan.'
}';
$decodejsonNan = jsonFormatDecode($jsonNan); 


$jsonKamphaengPhet = '{
    "type": "text",
    "text": '.$KamphaengPhet.'
}';
$decodejsonKamphaengPhet = jsonFormatDecode($jsonKamphaengPhet);


$jsonChainat = '{
    "type": "text",
    "text": '.$Chainat.'
}';
$decodejsonChainat = jsonFormatDecode($jsonChainat);

$jsonPhichit = '{
    "type": "text",
    "text": '.$Phichit.'
}';
$decodejsonPhichit = jsonFormatDecode($jsonPhichit);

$jsonSamutSongkhram = '{
    "type": "text",
    "text": '.$SamutSongkhram.'
}';
$decodejsonSamutSongkhram = jsonFormatDecode($jsonSamutSongkhram);

$jsonSingBuri = '{
    "type": "text",
    "text": '.$SingBuri.'
}';
$decodejsonSingBuri = jsonFormatDecode($jsonSingBuri);

$jsonAngThong = '{
    "type": "text",
    "text": '.$AngThong.'
}';
$decodejsonAngThong = jsonFormatDecode($jsonAngThong);

$jsonSaKaeo = '{
    "type": "text",
    "text": '.$SaKaeo.'
}';
$decodejsonSaKaeo = jsonFormatDecode($jsonSaKaeo);

$jsonSatun = '{
    "type": "text",
    "text": '.$Satun.'
}';
$decodejsonSatun = jsonFormatDecode($jsonSatun);
  // --------------------------------------------------------------------------------------------------------------
 $jsonThai = '{
    "type": "text",
    "text": '.$Thai.'
}';
  $decodejsonThai = jsonFormatDecode($jsonThai);
  
  // --------------------------------------------------------------------------------------------------------------
$jsonWait = '{
  "type": "text",
  "text": " ข้อมูลมีปัญหากำลังดำเนินการแก้ไขครับ ♥ "
}';
  $decodejsonWait = jsonFormatDecode($jsonWait);

$jsonStart = '{
  "type": "text",
  "text": '.$wordstart.'
}';
  $decodeJsonStart = jsonFormatDecode($jsonStart);


//   "text": "📝พิมพ์หัวข้อตามนี้ครับ📝\n\nพิมพ์ 1 เพื่อแสดงยอดรวมผู้ติดเชื้อปัจจุบันของประเทศไทย⚠️\nพิมพ์ 2 เพื่อแสดงผู้รักษาที่หายแล้วกลับบ้านได้✅\nพิมพ์ 3 เพื่อแสดงผู้ป่วยที่กำลังรักษา🏥\nพิมพ์ 4 เพื่อแสดงผู้ป่วยที่เสียชีวิตแล้ว❌\nพิมพ์ 5 เพื่อแสดงผู้ป่วยรายใหม่วันนี้⚠️\nพิมพ์ 6 เพื่อแสดงผู้ป่วยรายใหม่ที่รักษาหาย✅\nพิมพ์ 7 เพื่อแสดงผู้ป่วยรายใหม่ที่กำลังรักษา🏥\nพิมพ์ 8 เพื่อแสดงผู้ป่วยที่เสียชีวิตแล้ววันนี้❌\nพิมพ์ 9 เพื่อแสดงยอดรวมทั้งหมด📺"

      $jsonChoose = '{
  "type": "imagemap",
  "baseUrl": "https://phptraining.amn-corporation.com/ku-src/RabbitProject/report.jpg?_ignored=",
  "altText": "This is an imagemap",
  "baseSize": {
    "width": 1040,
    "height": 1040
  },
  "actions": [
    {
      "type": "message",
      "area": {
        "x": 72,
        "y": 178,
        "width": 735,
        "height": 74
      },
      "text": "ยอดรวมผู้ติดเชื้อปัจจุบันของประเทศไทย"
    },
    {
      "type": "message",
      "area": {
        "x": 76,
        "y": 283,
        "width": 559,
        "height": 65
      },
      "text": "ผู้รักษาที่หายแล้ว"
    },
    {
      "type": "message",
      "area": {
        "x": 77,
        "y": 379,
        "width": 424,
        "height": 66
      },
      "text": "ผู้ป่วยที่กำลังรักษา"
    },
    {
      "type": "message",
      "area": {
        "x": 78,
        "y": 473,
        "width": 429,
        "height": 73
      },
      "text": "ผู้ป่วยที่เสียชีวิต"
    },
    {
      "type": "message",
      "area": {
        "x": 85,
        "y": 571,
        "width": 413,
        "height": 69
      },
      "text": "ผู้ป่วยรายใหม่วันนี้"
    },
    {
      "type": "message",
      "area": {
        "x": 84,
        "y": 662,
        "width": 505,
        "height": 74
      },
      "text": "ผู้ป่วยรายใหม่ที่รักษาหาย"
    },
    {
      "type": "message",
      "area": {
        "x": 85,
        "y": 768,
        "width": 510,
        "height": 70
      },
      "text": "ผู้ป่วยรายใหม่ที่กำลังรักษา"
    },
    {
      "type": "message",
      "area": {
        "x": 89,
        "y": 865,
        "width": 464,
        "height": 72
      },
      "text": "ผู้ป่วยที่เสียชีวิตแล้ววันนี้"
    },
     {
      "type": "message",
      "area": {
        "x": 634,
        "y": 489,
        "width": 282,
        "height": 121
      },
      "text": "แสดงยอดรวมทั้งหมด"
    }
  ]
}';
$decodeJsonChoose = jsonFormatDecode($jsonChoose);
// --------------------------------------------------------------------------------------------------------------

$jsonDetailcovid1 = '{
  "type": "text",
  "text": '.$Detailcovid.'
}';
$decodejsonDetailcovid1 = jsonFormatDecode($jsonDetailcovid1);

$jsonDetailcovid2 = '{
  "type": "image",
  "originalContentUrl": "https://phptraining.amn-corporation.com/ku-src/RabbitProject/symptom.jpg?_ignored=",
  "previewImageUrl": "https://phptraining.amn-corporation.com/ku-src/RabbitProject/symptom.jpg?_ignored=",
  "animated": false
}';
$decodejsonDetailcovid2 = jsonFormatDecode($jsonDetailcovid2);

$jsonDetailcovid3 = '{
  "type": "image",
  "originalContentUrl": "https://phptraining.amn-corporation.com/ku-src/RabbitProject/protect.jpg?_ignored=",
  "previewImageUrl": "https://phptraining.amn-corporation.com/ku-src/RabbitProject/protect.jpg?_ignored=",
  "animated": false
}';
$decodejsonDetailcovid3 = jsonFormatDecode($jsonDetailcovid3);

$jsonDetailcovid4 = '';
$decodejsonDetailcovid4 = jsonFormatDecode($jsonDetailcovid4);


// --------------------------------------------------------------------------------------------------------------

// $messages['replyToken'] = $replyToken;
$messages['messages'][0] = $decodeJsonStart;

// --------------------------------------------------------------------------------------------------------------
$jsonflexNorth = '{
  "type": "imagemap",
  "baseUrl": "https://phptraining.amn-corporation.com/ku-src/RabbitProject/Province/North.jpg?_ignored=",
  "altText": "This is an imagemap",
  "baseSize": {
    "width": 1040,
    "height": 1040
  },
  "actions": [
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 0,
        "width": 347,
        "height": 347
      },
      "text": "จังหวัดเชียงราย"
    },
    {
      "type": "message",
      "area": {
        "x": 347,
        "y": 1,
        "width": 345,
        "height": 346
      },
      "text": "จังหวัดเชียงใหม่"
    },
    {
      "type": "message",
      "area": {
        "x": 692,
        "y": 0,
        "width": 348,
        "height": 345
      },
      "text": "จังหวัดน่าน"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 348,
        "width": 346,
        "height": 344
      },
      "text": "จังหวัดพะเยา"
    },
    {
      "type": "message",
      "area": {
        "x": 347,
        "y": 348,
        "width": 345,
        "height": 343
      },
      "text": "จังหวัดแพร่"
    },
    {
      "type": "message",
      "area": {
        "x": 693,
        "y": 346,
        "width": 346,
        "height": 346
      },
      "text": "จังหวัดแม่ฮ่องสอน"
    },
    {
      "type": "message",
      "area": {
        "x": 1,
        "y": 692,
        "width": 344,
        "height": 348
      },
      "text": "จังหวัดลำปาง"
    },
    {
      "type": "message",
      "area": {
        "x": 346,
        "y": 692,
        "width": 346,
        "height": 348
      },
      "text": "จังหวัดลำพูน"
    },
    {
      "type": "message",
      "area": {
        "x": 693,
        "y": 692,
        "width": 347,
        "height": 348
      },
      "text": "จังหวัดอุตรดิตถ์"
    }
  ]
}';
  $decodejsonflexNorth = jsonFormatDecode($jsonflexNorth);

// --------------------------------------------------------------------------------------------------------------
$jsonflexNortheast = '{
  "type": "imagemap",
  "baseUrl": "https://phptraining.amn-corporation.com/ku-src/RabbitProject/Province/Northeast.jpg?_ignored=",
  "altText": "This is an imagemap",
  "baseSize": {
    "width": 1040,
    "height": 2421
  },
  "actions": [
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 0,
        "width": 344,
        "height": 350
      },
      "text": "จังหวัดกาฬสินธุ์"
    },
    {
      "type": "message",
      "area": {
        "x": 343,
        "y": 0,
        "width": 352,
        "height": 348
      },
      "text": "จังหวัดขอนแก่น"
    },
    {
      "type": "message",
      "area": {
        "x": 692,
        "y": 0,
        "width": 348,
        "height": 347
      },
      "text": "จังหวัดชัยภูมิ"
    },
    {
      "type": "message",
      "area": {
        "x": 1,
        "y": 346,
        "width": 345,
        "height": 344
      },
      "text": "จังหวัดนครพนม"
    },
    {
      "type": "message",
      "area": {
        "x": 346,
        "y": 344,
        "width": 348,
        "height": 348
      },
      "text": "จังหวัดนครราชสีมา"
    },
    {
      "type": "message",
      "area": {
        "x": 693,
        "y": 344,
        "width": 347,
        "height": 348
      },
      "text": "จังหวัดบุรีรัมย์"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 687,
        "width": 346,
        "height": 351
      },
      "text": "จังหวัดมหาสารคาม"
    },
    {
      "type": "message",
      "area": {
        "x": 346,
        "y": 689,
        "width": 345,
        "height": 353
      },
      "text": "จังหวัดมุกดาหาร"
    },
    {
      "type": "message",
      "area": {
        "x": 691,
        "y": 691,
        "width": 346,
        "height": 349
      },
      "text": "จังหวัดยโสธร"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 1037,
        "width": 346,
        "height": 347
      },
      "text": "จังหวัดร้อยเอ็ด"
    },
    {
      "type": "message",
      "area": {
        "x": 346,
        "y": 1037,
        "width": 345,
        "height": 349
      },
      "text": "จังหวัดเลย"
    },
    {
      "type": "message",
      "area": {
        "x": 691,
        "y": 1037,
        "width": 344,
        "height": 344
      },
      "text": "จังหวัดสกลนคร"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 1386,
        "width": 351,
        "height": 344
      },
      "text": "จังหวัดสุรินทร์"
    },
    {
      "type": "message",
      "area": {
        "x": 348,
        "y": 1387,
        "width": 342,
        "height": 343
      },
      "text": "จังหวัดศรีสะเกษ"
    },
    {
      "type": "message",
      "area": {
        "x": 690,
        "y": 1384,
        "width": 350,
        "height": 347
      },
      "text": "จังหวัดหนองคาย"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 1729,
        "width": 347,
        "height": 345
      },
      "text": "จังหวัดหนองบัวลำภู"
    },
    {
      "type": "message",
      "area": {
        "x": 350,
        "y": 1734,
        "width": 349,
        "height": 332
      },
      "text": "จังหวัดอุดรธานี"
    },
    {
      "type": "message",
      "area": {
        "x": 692,
        "y": 1728,
        "width": 348,
        "height": 344
      },
      "text": "จังหวัดอุบลราชธานี"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 2075,
        "width": 350,
        "height": 346
      },
      "text": "จังหวัดอำนาจเจริญ"
    }
  ]
}';
  $decodejsonflexNortheast = jsonFormatDecode($jsonflexNortheast);

// --------------------------------------------------------------------------------------------------------------
    $jsonflexCentralregion = '{
  "type": "imagemap",
  "baseUrl": "https://phptraining.amn-corporation.com/ku-src/RabbitProject/Province/Center.jpg?_ignored=",
  "altText": "This is an imagemap",
  "baseSize": {
    "width": 1040,
    "height": 2768
  },
  "actions": [
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 0,
        "width": 344,
        "height": 350
      },
      "text": "กรุงเทพมหานคร "
    },
    {
      "type": "message",
      "area": {
        "x": 343,
        "y": 0,
        "width": 352,
        "height": 348
      },
      "text": "จังหวัดกำแพงเพชร"
    },
    {
      "type": "message",
      "area": {
        "x": 692,
        "y": 0,
        "width": 348,
        "height": 347
      },
      "text": "จังหวัดชัยนาท"
    },
    {
      "type": "message",
      "area": {
        "x": 1,
        "y": 346,
        "width": 345,
        "height": 344
      },
      "text": "จังหวัดนครนายก"
    },
    {
      "type": "message",
      "area": {
        "x": 346,
        "y": 344,
        "width": 348,
        "height": 348
      },
      "text": "จังหวัดนครปฐม"
    },
    {
      "type": "message",
      "area": {
        "x": 693,
        "y": 344,
        "width": 347,
        "height": 348
      },
      "text": "จังหวัดนครสวรรค์"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 687,
        "width": 346,
        "height": 351
      },
      "text": "จังหวัดนนทบุรี"
    },
    {
      "type": "message",
      "area": {
        "x": 346,
        "y": 689,
        "width": 345,
        "height": 353
      },
      "text": "จังหวัดปทุมธานี"
    },
    {
      "type": "message",
      "area": {
        "x": 691,
        "y": 691,
        "width": 346,
        "height": 349
      },
      "text": "จังหวัดพระนครศรีอยุธยา"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 1037,
        "width": 346,
        "height": 347
      },
      "text": "จังหวัดพิจิตร"
    },
    {
      "type": "message",
      "area": {
        "x": 346,
        "y": 1037,
        "width": 345,
        "height": 349
      },
      "text": "จังหวัดพิษณุโลก"
    },
    {
      "type": "message",
      "area": {
        "x": 691,
        "y": 1037,
        "width": 344,
        "height": 344
      },
      "text": "จังหวัดเพชรบูรณ์"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 1386,
        "width": 351,
        "height": 344
      },
      "text": "จังหวัดลพบุรี"
    },
    {
      "type": "message",
      "area": {
        "x": 348,
        "y": 1387,
        "width": 342,
        "height": 343
      },
      "text": "จังหวัดสมุทรปราการ"
    },
    {
      "type": "message",
      "area": {
        "x": 690,
        "y": 1384,
        "width": 350,
        "height": 347
      },
      "text": "จังหวัดสมุทรสงคราม"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 1729,
        "width": 347,
        "height": 345
      },
      "text": "จังหวัดสมุทรสาคร"
    },
    {
      "type": "message",
      "area": {
        "x": 350,
        "y": 1734,
        "width": 349,
        "height": 341
      },
      "text": "จังหวัดสิงห์บุรี"
    },
    {
      "type": "message",
      "area": {
        "x": 692,
        "y": 1728,
        "width": 348,
        "height": 344
      },
      "text": "จังหวัดสุโขทัย"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 2075,
        "width": 350,
        "height": 346
      },
      "text": "จังหวัดสุพรรณบุรี"
    },
    {
      "type": "message",
      "area": {
        "x": 344,
        "y": 2075,
        "width": 350,
        "height": 344
      },
      "text": "จังหวัดสระบุรี"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 2420,
        "width": 344,
        "height": 341
      },
      "text": "จังหวัดอ่างทอง"
    },
    {
      "type": "message",
      "area": {
        "x": 691,
        "y": 2073,
        "width": 349,
        "height": 349
      },
      "text": "จังหวัดอุทัยธานี"
    }
  ]
}';
  $decodejsonflexCentralregion = jsonFormatDecode($jsonflexCentralregion);
     
// --------------------------------------------------------------------------------------------------------------
  $jsonflexEast = '{
  "type": "imagemap",
  "baseUrl": "https://phptraining.amn-corporation.com/ku-src/RabbitProject/Province/East.jpg?_ignored=",
  "altText": "This is an imagemap",
  "baseSize": {
    "width": 1040,
    "height": 1038
  },
  "actions": [
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 1,
        "width": 346,
        "height": 346
      },
      "text": "จังหวัดจันทบุรี"
    },
    {
      "type": "message",
      "area": {
        "x": 347,
        "y": 0,
        "width": 346,
        "height": 349
      },
      "text": "จังหวัดฉะเชิงเทรา"
    },
    {
      "type": "message",
      "area": {
        "x": 692,
        "y": 0,
        "width": 348,
        "height": 346
      },
      "text": "จังหวัดชลบุรี"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 347,
        "width": 344,
        "height": 345
      },
      "text": "จังหวัดตราด"
    },
    {
      "type": "message",
      "area": {
        "x": 345,
        "y": 347,
        "width": 348,
        "height": 345
      },
      "text": "จังหวัดปราจีนบุรี"
    },
    {
      "type": "message",
      "area": {
        "x": 691,
        "y": 347,
        "width": 348,
        "height": 344
      },
      "text": "จังหวัดระยอง"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 693,
        "width": 347,
        "height": 344
      },
      "text": "จังหวัดสระแก้ว"
    }
  ]
}';
  $decodejsonflexEast = jsonFormatDecode($jsonflexEast);

// --------------------------------------------------------------------------------------------------------------

  $jsonflexWest = '{
  "type": "imagemap",
  "baseUrl": "https://phptraining.amn-corporation.com/ku-src/RabbitProject/Province/West.jpg?_ignored=",
  "altText": "This is an imagemap",
  "baseSize": {
    "width": 1040,
    "height": 692
  },
  "actions": [
    {
      "type": "message",
      "area": {
        "x": 1,
        "y": 0,
        "width": 346,
        "height": 349
      },
      "text": "จังหวัดกาญจนบุรี"
    },
    {
      "type": "message",
      "area": {
        "x": 347,
        "y": 0,
        "width": 346,
        "height": 347
      },
      "text": "จังหวัดตาก"
    },
    {
      "type": "message",
      "area": {
        "x": 693,
        "y": 0,
        "width": 347,
        "height": 347
      },
      "text": "จังหวัดประจวบคีรีขันธ์"
    },
    {
      "type": "message",
      "area": {
        "x": 2,
        "y": 350,
        "width": 345,
        "height": 338
      },
      "text": "จังหวัดเพชรบุรี"
    },
    {
      "type": "message",
      "area": {
        "x": 343,
        "y": 346,
        "width": 345,
        "height": 346
      },
      "text": "จังหวัดราชบุรี"
    }
  ]
}';
  $decodejsonflexWest = jsonFormatDecode($jsonflexWest);

// --------------------------------------------------------------------------------------------------------------
    $jsonflexSouth = '{
  "type": "imagemap",
  "baseUrl": "https://phptraining.amn-corporation.com/ku-src/RabbitProject/Province/South.jpg?_ignored=",
  "altText": "This is an imagemap",
  "baseSize": {
    "width": 1040,
    "height": 1730
  },
  "actions": [
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 0,
        "width": 344,
        "height": 350
      },
      "text": "จังหวัดกระบี่"
    },
    {
      "type": "message",
      "area": {
        "x": 343,
        "y": 0,
        "width": 352,
        "height": 348
      },
      "text": "จังหวัดชุมพร"
    },
    {
      "type": "message",
      "area": {
        "x": 692,
        "y": 0,
        "width": 348,
        "height": 347
      },
      "text": "จังหวัดตรัง"
    },
    {
      "type": "message",
      "area": {
        "x": 1,
        "y": 346,
        "width": 345,
        "height": 344
      },
      "text": "จังหวัดนครศรีธรรมราช"
    },
    {
      "type": "message",
      "area": {
        "x": 346,
        "y": 344,
        "width": 348,
        "height": 348
      },
      "text": "จังหวัดนราธิวาส"
    },
    {
      "type": "message",
      "area": {
        "x": 693,
        "y": 344,
        "width": 347,
        "height": 348
      },
      "text": "จังหวัดปัตตานี"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 687,
        "width": 346,
        "height": 351
      },
      "text": "จังหวัดพังงา"
    },
    {
      "type": "message",
      "area": {
        "x": 346,
        "y": 689,
        "width": 345,
        "height": 353
      },
      "text": "จังหวัดพัทลุง"
    },
    {
      "type": "message",
      "area": {
        "x": 691,
        "y": 691,
        "width": 346,
        "height": 349
      },
      "text": "จังหวัดภูเก็ต"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 1037,
        "width": 346,
        "height": 347
      },
      "text": "จังหวัดระนอง"
    },
    {
      "type": "message",
      "area": {
        "x": 346,
        "y": 1037,
        "width": 345,
        "height": 349
      },
      "text": "จังหวัดสตูล"
    },
    {
      "type": "message",
      "area": {
        "x": 691,
        "y": 1037,
        "width": 344,
        "height": 344
      },
      "text": "จังหวัดสงขลา"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 1386,
        "width": 351,
        "height": 344
      },
      "text": "จังหวัดสุราษฎร์ธานี"
    },
    {
      "type": "message",
      "area": {
        "x": 348,
        "y": 1387,
        "width": 342,
        "height": 343
      },
      "text": "จังหวัดยะลา"
    }
  ]
}';
  $decodejsonflexSouth = jsonFormatDecode($jsonflexSouth);
// --------------------------------------------------------------------------------------------------------------
$jsonflexProvince = '
{
  "type": "imagemap",
  "baseUrl": "https://phptraining.amn-corporation.com/ku-src/RabbitProject/Province/Province.jpg?_ignored=",
  "altText": "This is an imagemap",
  "baseSize": {
    "width": 1040,
    "height": 1040
  },
  "actions": [
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 0,
        "width": 350,
        "height": 520
      },
      "text": "ภาคเหนือ"
    },
    {
      "type": "message",
      "area": {
        "x": 347,
        "y": 0,
        "width": 346,
        "height": 518
      },
      "text": "ภาคตะวันออกเฉียงเหนือ"
    },
    {
      "type": "message",
      "area": {
        "x": 691,
        "y": 0,
        "width": 349,
        "height": 522
      },
      "text": "ภาคกลาง"
    },
    {
      "type": "message",
      "area": {
        "x": 0,
        "y": 518,
        "width": 347,
        "height": 522
      },
      "text": "ภาคตะวันออก"
    },
    {
      "type": "message",
      "area": {
        "x": 347,
        "y": 516,
        "width": 344,
        "height": 522
      },
      "text": "ภาคตะวันตก"
    },
    {
      "type": "message",
      "area": {
        "x": 693,
        "y": 520,
        "width": 347,
        "height": 520
      },
      "text": "ภาคใต้"
    }
  ]
}';
  $decodejsonflexProvince = jsonFormatDecode($jsonflexProvince);
// --------------------------------------------------------------------------------------------------------------
$jsonLocationCu = '{
  "type": "location",
  "title": "โรงพยาบาลจุฬาลงกรณ์",
  "address": "1873 Rama IV Rd, Pathum Wan, Pathum Wan District, Bangkok 10330",
  "latitude": 13.732498,
  "longitude": 100.536834
}';
$decodeJsonLocationCu = jsonFormatDecode($jsonLocationCu);
$jsonLocationRa = '{
  "type": "location",
  "title": "โรงพยาบาลราชวิถี",
  "address": "2 Phayathai Rd, Thung Phaya Thai, Ratchathewi, Bangkok 10400",
  "latitude": 13.765088,
  "longitude": 100.536026
}';
$decodeJsonLocationRa = jsonFormatDecode($jsonLocationRa);

$jsonLocationPh = '{
  "type": "location",
  "title": "โรงพยาบาลพญาไท 2",
  "address": "943 Phahonyothin Rd, แขวง พญาไท Phaya Thai, Bangkok 10400",
  "latitude": 13.770518,
  "longitude": 100.540625
}';
$decodeJsonLocationPh = jsonFormatDecode($jsonLocationPh);

$jsonLocationTi = '{
  "type": "location",
  "title": "โรงพยาบาลรามาธิบดี",
  "address": "270 Thanon Rama VI, Thung Phaya Thai, Ratchathewi, Bangkok 10400",
  "latitude": 13.766057,
  "longitude": 100.526645
}';
$decodeJsonLocationTi = jsonFormatDecode($jsonLocationTi);
// --------------------------------------------------------------------------------------------------------------


$jsonHospital = '{
  "type": "flex",
  "altText": "Flex Message",
  "contents": {
    "type": "carousel",
    "contents": [
      {
        "type": "bubble",
        "hero": {
          "type": "image",
          "url": "https://upload.wikimedia.org/wikipedia/commons/f/fa/King_chulalongkorn_memorial_hospital_20-10-2017.jpg",
          "size": "full",
          "aspectRatio": "20:13",
          "aspectMode": "cover"
        },
        "body": {
          "type": "box",
          "layout": "vertical",
          "spacing": "sm",
          "contents": [
            {
              "type": "text",
              "text": "โรงพยาบาลจุฬาลงกรณ์",
              "size": "lg",
              "align": "center",
              "weight": "bold"
            },
            {
              "type": "text",
              "text": "🔴 ประเภท : โรงพยาบาลรัฐบาล",
              "margin": "sm"
            },
            {
              "type": "text",
              "text": "🔵 ค่าใช้จ่าย : 3,000 – 6,000 บาท",
              "margin": "sm"
            },
            {
              "type": "text",
              "text": "🔘 ติดต่อ : 02-256-5487",
              "margin": "sm"
            }
          ]
        },
        "footer": {
          "type": "box",
          "layout": "vertical",
          "spacing": "sm",
          "contents": [
            {
              "type": "button",
              "action": {
                "type": "message",
                "label": "แผนที่",
                "text": "ขอแผนที่โรงพยาบาลจุฬาลงกรณ์"
              },
              "color": "#4EA78C",
              "style": "primary"
            }
          ]
        }
      },
      {
        "type": "bubble",
        "hero": {
          "type": "image",
          "url": "https://www.matichon.co.th/wp-content/uploads/2017/12/%E0%B8%AD%E0%B8%B2%E0%B8%84%E0%B8%B2%E0%B8%A3%E0%B8%A8%E0%B8%B9%E0%B8%99%E0%B8%A2%E0%B9%8C%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B9%81%E0%B8%9E%E0%B8%97%E0%B8%A2%E0%B9%8C%E0%B8%A3%E0%B8%B2%E0%B8%8A%E0%B8%A7%E0%B8%B4%E0%B8%96%E0%B8%B5.jpg",
          "size": "full",
          "aspectRatio": "20:13",
          "aspectMode": "cover"
        },
        "body": {
          "type": "box",
          "layout": "vertical",
          "spacing": "sm",
          "contents": [
            {
              "type": "text",
              "text": "โรงพยาบาลราชวิธี",
              "size": "lg",
              "align": "center",
              "weight": "bold"
            },
            {
              "type": "text",
              "text": "🔴 ประเภท : โรงพยาบาลรัฐบาล",
              "margin": "sm"
            },
            {
              "type": "text",
              "text": "🔵 ค่าใช้จ่าย : 3,000 – 6,000 บาท",
              "margin": "sm"
            },
            {
              "type": "text",
              "text": "🔘 ติดต่อ : 02-354-8108-37",
              "margin": "sm"
            }
          ]
        },
        "footer": {
          "type": "box",
          "layout": "vertical",
          "spacing": "sm",
          "contents": [
            {
              "type": "button",
              "action": {
                "type": "message",
                "label": "แผนที่",
                "text": "ขอแผนที่โรงพยาบาลราชวิถี"
              },
              "color": "#4EA78C",
              "style": "primary"
            }
          ]
        }
      },
      {
        "type": "bubble",
        "hero": {
          "type": "image",
          "url": "https://www.honestdocs.co/system/hospitals/hero_images/000/000/087/original/phyathai-2-hospital-hero.jpg",
          "size": "full",
          "aspectRatio": "20:13",
          "aspectMode": "cover"
        },
        "body": {
          "type": "box",
          "layout": "vertical",
          "spacing": "sm",
          "contents": [
            {
              "type": "text",
              "text": "โรงพยาบาลพญาไท 2",
              "size": "lg",
              "align": "center",
              "weight": "bold"
            },
            {
              "type": "text",
              "text": "🔴 ประเภท : โรงพยาบาลเอกชน",
              "margin": "sm"
            },
            {
              "type": "text",
              "text": "🔵 ค่าใช้จ่าย : 6,100 บาท",
              "margin": "sm"
            },
            {
              "type": "text",
              "text": "🔘 ติดต่อ : 02-271-6700",
              "margin": "sm"
            }
          ]
        },
        "footer": {
          "type": "box",
          "layout": "vertical",
          "spacing": "sm",
          "contents": [
            {
              "type": "button",
              "action": {
                "type": "message",
                "label": "แผนที่",
                "text": "ขอแผนที่โรงพยาบาลพญาไท2"
              },
              "color": "#4EA78C",
              "style": "primary"
            }
          ]
        }
      },
      {
        "type": "bubble",
        "hero": {
          "type": "image",
          "url": "https://med.mahidol.ac.th/rama_hospital/sites/default/files/public/img/slide/Slide-RAMA-02.jpg",
          "size": "full",
          "aspectRatio": "20:13",
          "aspectMode": "cover"
        },
        "body": {
          "type": "box",
          "layout": "vertical",
          "spacing": "sm",
          "contents": [
            {
              "type": "text",
              "text": "โรงพยาบาลรามาธิบดี",
              "size": "lg",
              "align": "center",
              "weight": "bold"
            },
            {
              "type": "text",
              "text": "🔴 ประเภท : โรงพยาบาลรัฐบาล",
              "margin": "sm"
            },
            {
              "type": "text",
              "text": "🔵 ค่าใช้จ่าย : 5,000 บาท ขึ้นไป",
              "margin": "sm"
            },
            {
              "type": "text",
              "text": "🔘 ติดต่อ : 02-201-1000",
              "margin": "sm"
            }
          ]
        },
        "footer": {
          "type": "box",
          "layout": "vertical",
          "spacing": "sm",
          "contents": [
            {
              "type": "button",
              "action": {
                "type": "message",
                "label": "แผนที่",
                "text": "ขอแผนที่โรงพยาบาลรามาธิบดี"
              },
              "color": "#4EA78C",
              "style": "primary"
            }
          ]
        }
      }
    ]
  }
}';
  $decodejsonHospital = jsonFormatDecode($jsonHospital);

// --------------------------------------------------------------------------------------------------------------


    switch ($words) {
    case "ยอดรวมผู้ติดเชื้อปัจจุบันของประเทศไทย":
       $messages['replyToken'] = $replyToken;
       $messages['messages'][0] = $decodejsonConfirmedcovid;
        break;
    case "ผู้รักษาที่หายแล้ว":
       $messages['replyToken'] = $replyToken;
       $messages['messages'][0] = $decodejsonRecoveredcovid;
        break;
     case "ผู้ป่วยที่กำลังรักษา":
       $messages['replyToken'] = $replyToken;
       $messages['messages'][0] = $decodejsonHospitalizedcovid;
        break;
     case "ผู้ป่วยที่เสียชีวิต":
       $messages['replyToken'] = $replyToken;
       $messages['messages'][0] = $decodejsonDeathscovid;
        break;  
      case "ผู้ป่วยรายใหม่วันนี้":
       $messages['replyToken'] = $replyToken;
       $messages['messages'][0] = $decodejsonNewConfirmedcovid;
        break;  
      case "ผู้ป่วยรายใหม่ที่รักษาหาย":
       $messages['replyToken'] = $replyToken;
       $messages['messages'][0] = $decodejsonNewRecoveredcovid;
        break;
      case "ผู้ป่วยรายใหม่ที่กำลังรักษา":
       $messages['replyToken'] = $replyToken;
       $messages['messages'][0] = $decodejsonNewHospitalizedcovid;
        break;
      case "ผู้ป่วยที่เสียชีวิตแล้ววันนี้":
       $messages['replyToken'] = $replyToken;
       $messages['messages'][0] = $decodejsonNewDeathscovid;
        break;
      case "แสดงยอดรวมทั้งหมด":
       $messages['replyToken'] = $replyToken;
       $messages['messages'][0] = $decodejsonAllcovid;
        break;
        // --------------------------------------------------------------------------------------------------------------

        case "โรงพยาบาล":
       $messages['replyToken'] = $replyToken;
       $messages['messages'][0] = $decodejsonHospital;
        break;
        case "ขอแผนที่โรงพยาบาลจุฬาลงกรณ์":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodeJsonLocationCu;
        break;
        case "ขอแผนที่โรงพยาบาลราชวิถี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodeJsonLocationRa;
        break; 
        case "ขอแผนที่โรงพยาบาลพญาไท2":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodeJsonLocationPh;
        break; 
        case "ขอแผนที่โรงพยาบาลรามาธิบดี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodeJsonLocationTi;
        break;
        // --------------------------------------------------------------------------------------------------------------

        case "ค้นหาจำนวนตามจังหวัด":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonUnknownProcovid;
      $messages['messages'][1] = $decodejsonflexProvince; 
      break;
      // --------------------------------------------------------------------------------------------------------------
        case "ภาคเหนือ":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonflexNorth;
        break;
        case "จังหวัดเชียงราย":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonChiangRai;
        break;
        case "จังหวัดเชียงใหม่":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonChiangMai;
        break;
        case "จังหวัดน่าน":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonNan;
        break;
        case "จังหวัดพะเยา":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonPhayao;
        break;
        case "จังหวัดแพร่":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonPhrae;
        break;
        case "จังหวัดแม่ฮ่องสอน":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonMaeHongSon;
        break;
        case "จังหวัดลำปาง":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonLampang;
        break;
        case "จังหวัดลำพูน":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonLamphun;
        break;
        case "จังหวัดอุตรดิตถ์":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonUttaradit;
        break;
        // --------------------------------------------------------------------------------------------------------------

        case "ภาคตะวันออกเฉียงเหนือ":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonflexNortheast;


        break;
        case "จังหวัดกาฬสินธุ์":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonKalasin;
        break;
        case "จังหวัดขอนแก่น":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonKhonKaen;
        break;
        case "จังหวัดชัยภูมิ":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonChaiyaphum;
        break;
        case "จังหวัดนครพนม":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonNakhonPhanom;
        break;
        case "จังหวัดนครราชสีมา":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonNakhonRatchasima;
        break;
        case "จังหวัดบุรีรัมย์":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonBuriram;
        break;
        case "จังหวัดมหาสารคาม":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonMahaSarakham;
        break;
        case "จังหวัดมุกดาหาร":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonMukdahan;
        break;
        case "จังหวัดยโสธร":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonYasothon;
        break;        
        case "จังหวัดร้อยเอ็ด":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonRoiEt;
        break;
        case "จังหวัดเลย":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonLoei;
        break;
        case "จังหวัดสกลนคร":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonSaKaeo;
        break;
        case "จังหวัดสุรินทร์":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonSurin;
        break;
        case "จังหวัดศรีสะเกษ":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonSisaket;
        break;
        case "จังหวัดหนองคาย":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonNongKhai;
        break;
        case "จังหวัดหนองบัวลำภู":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonNongBuaLamphu;
        break;
        case "จังหวัดอุดรธานี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonUdonThani;
        break;
        case "จังหวัดอุบลราชธานี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonUbonRatchathani;
        break;       
        case "จังหวัดอำนาจเจริญ":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonAmnatCharoen;
        break;   
        // --------------------------------------------------------------------------------------------------------------

        case "ภาคกลาง":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonflexCentralregion;
        break;
        case "กรุงเทพมหานคร":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonBangkok;
        break;
        case "จังหวัดกำแพงเพชร":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonKamphaengPhet;
        break;
        case "จังหวัดชัยนาท":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonChainat;
        break;
        case "จังหวัดนครนายก":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonNakhonNayok;
        break;
        case "จังหวัดนครปฐม":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonNakhonPathom;
        break;
        case "จังหวัดนครสวรรค์":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonNakhonSawan;
        break;
        case "จังหวัดนนทบุรี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonNonthaburi;
        break;
        case "จังหวัดปทุมธานี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonPathumThani;
        break;
        case "จังหวัดพระนครศรีอยุธยา":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonPhraNakhonSiAyutthaya;
        break;
        case "จังหวัดพิจิตร":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonPhichit;
        break;
        case "จังหวัดพิษณุโลก":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonPhitsanulok;
        break;
        case "จังหวัดเพรชบูรณ์":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonPhetchabun;
        break;
        case "จังหวัดลพบุรี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonLopburi;
        break;
        case "จังหวัดสมุทรปราการ":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonSamutPrakan;
        break;
        case "จังหวัดสมุทรสงคราม":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonSamutSongkhram;
        break;
        case "จังหวัดสมุทรสาคร":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonSamutSakhon;
        break;
        case "จังหวัดสิงห์บุรี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonSingBuri;
        break;
        case "จังหวัดสุโขทัย":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonSukhothai;
        break;
        case "จังหวัดสุพรรณบุรี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonSuphanBuri;
        break;
        case "จังหวัดสระบุรี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonSaraburi;
        break;
        case "จังหวัดอ่างทอง":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonAngThong;
        break;
        case "จังหวัดอุทัยธานี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonUthaiThani;
        break;
        // --------------------------------------------------------------------------------------------------------------

        case "ภาคตะวันออก":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonflexEast;
        break;
        case "จังหวัดจันทบุรี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonChanthaburi;
        break;
        case "จังหวัดฉะเชิงเทรา":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonChachoengsao;
        break;
        case "จังหวัดชลบุรี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonChonburi;
        break;
        case "จังหวัดตราด":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonTrat;
        break;
        case "จังหวัดปราจีนบุรี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonPrachinburi;
        break;
        case "จังหวัดระยอง":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonRayong;
        break;
        case "จังหวัดสระแก้ว":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonSaKaeo;
        break;
        // --------------------------------------------------------------------------------------------------------------

        case "ภาคตะวันตก":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonflexWest;
        break;
        case "จังหวัดกาญจนบุรี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonKanchanaburi;
        break;
        case "จังหวัดตาก":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonTak;
        break;
        case "จังหวัดประจวบคีรีขันธ์":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonPrachuapKhiriKhan;
        break;
        case "จังหวัดเพชรบุรี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonPhetchaburi;
        break;
        case "จังหวัดราชบุรี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonRatchaburi;
        break;
        // --------------------------------------------------------------------------------------------------------------

        case "ภาคใต้":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonflexSouth;
        break;
        case "จังหวัดกระบี่":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonKrabi;
        break;
        case "จังหวัดชุมพร":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonChumphon;
        break;
        case "จังหวัดตรัง":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonTrang;
        break;
        case "จังหวัดนครศรีธรรมราช":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonNakhonSiThammarat;
        break;
        case "จังหวัดนราธิวาส":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonNarathiwat;
        break;
        case "จังหวัดปัตตานี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonPattani;
        break;
        case "จังหวัดพังงา":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonPhangnga;
        break;
        case "จังหวัดพัทลุง":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonPhatthalung;
        break;
        case "จังหวัดภูเก็ต":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonPhuket;
        break;
        case "จังหวัดระนอง":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonRanong;
        break;
        case "จังหวัดสตูล":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonSatun;
        break;
        case "จังหวัดสงขลา":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonSongkhla;
        break;
        case "จังหวัดสุราษฎร์ธานี":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonSuratThani;
        break;
        case "จังหวัดยะลา":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonYala;
        break;
        // --------------------------------------------------------------------------------------------------------------

        case "ข้อมูลโควิด19":
      $messages['replyToken'] = $replyToken;
      $messages['messages'][0] = $decodejsonDetailcovid1;
      $messages['messages'][1] = $decodejsonDetailcovid2;
      $messages['messages'][2] = $decodejsonDetailcovid3;
      $messages['messages'][3] = $decodeJsonChoose;
      // $messages['messages'][4] = $decodejsonDetailcovid1;

        break;
        // --------------------------------------------------------------------------------------------------------------

    default:
       $messages['replyToken'] = $replyToken;
       $messages['messages'][0] = $decodeJsonStart;
      $messages['messages'][1] = $decodeJsonChoose;
      $messages['messages'][2] = $decodejsonUpdateDatecovid;
}








    

 










// --------------------------------------------------------------------------------------------------------------
$strmorning = "อรุณสวัสดิ์ครับ คุณ ".$displayName." วันนี้ดูแลสุขภาพด้วยนะครับ"; 



  $encodeJson = json_encode($messages);
  $LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";
    $results = sentMessage($encodeJson,$LINEDatas);
    /*Return HTTP Request 200*/
  http_response_code(200);


  function checknull($value)
  {
if ($value != null || $value != "" || $value != '') 
{
      return number_format(abs(round($value)))." คน";
    } 
    else 
    {
      $value = "- คน\n🙏🏼 ขออภัยครับ ข้อมูลมีปัญหากำลังรอการแก้ไขข้อมูลจากกรมควบคุมโรคครับ 🙏🏼";
      return ($value);
    }   
  }

// --------------------------------------------------------------------------------------------------------------

  function jsonFormatDecode($json)
  {
    $values = json_decode($json,true);
    return $values;
  }

// --------------------------------------------------------------------------------------------------------------


function getcovidall()
{
 $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://corona.lmao.ninja/all",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Cookie: __cfduid=d232fd990d553cae0fb43249c755bcf301586108870"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;

}


// --------------------------------------------------------------------------------------------------------------

function getcovidtoday()
{
 $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://covid19.th-stat.com/api/open/today",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Cookie: __cfduid=d8aec245279a0375e21704f856d5017e61585913648"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
 return $response;
}


// --------------------------------------------------------------------------------------------------------------
function getcovidsum()
{
 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://covid19.th-stat.com/api/open/cases/sum",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Cookie: __cfduid=d8aec245279a0375e21704f856d5017e61585913648"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;

 
}
// --------------------------------------------------------------------------------------------------------------
function getcovidarea()
{
 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://covid19.th-stat.com/api/open/area",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Cookie: __cfduid=d8aec245279a0375e21704f856d5017e61585913648"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;

 
}
// --------------------------------------------------------------------------------------------------------------
  function getFormatTextMessage($text)
  {
    $datas = [];
    $datas['type'] = 'text';
    $datas['text'] = $text;
    return $datas;
  }
function insertData($spreadsheetId,$service,$userId,$displayName,$words,$displayImage)
    {
      // $range = 'congress!D2:F1000000';
      //INSERT DATA
      $range = ['a2'];
      $values = [
        [$userId,$displayName,$words,$displayImage],
      ];
      $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
      ]);
      $params = [
        'valueInputOption' => 'RAW'
      ];
      $insert = [
        'insertDataOption' => 'INSERT_ROWS'
      ];
      $result = $service->spreadsheets_values->append(
        $spreadsheetId,
        $range,
        $body,
        $params,
        $insert
      );
    }

    


    function updateData($spreadsheetId,$service)
    {
      $range = 'a2:b2';
      $values = [
        ["Test","Test"],
      ];
      $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
      ]);
      $params = [
        'valueInputOption' => 'RAW'
      ];
      $result = $service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
      );
    }

     function getData($spreadsheetId,$service)
    {
      // GET DATA
      $range = 'congress!D2:F1000000';
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();

    if(empty($values)){
      print "No Data Found.\n";
    }else{
      foreach ($values as $row) {
        echo $row[0]."<br/>";
      }
    }
    }

  function getLINEProfile($datas)
  {
    $datasReturn = [];
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $datas['url'],
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer ".$datas['token'],
        "Postman-Token: 32d99c7d-9f6e-4413-a4d2-fa0a9f1ecf6d",
        "cache-control: no-cache"
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
            $datasReturn['result'] = 'E';
            $datasReturn['message'] = $err;
        } else {
            if($response == "{}"){
                $datasReturn['result'] = 'S';
                $datasReturn['message'] = 'Success';
            }else{
                $datasReturn['result'] = 'E';
                $datasReturn['message'] = $response;
            }
        }
        return $datasReturn;
  }
  function sentMessage($encodeJson,$datas)
  {
    $datasReturn = [];
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $datas['url'],
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $encodeJson,
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$datas['token'],
            "cache-control: no-cache",
            "content-type: application/json; charset=UTF-8",
          ),
        ));
        $response = curl_exec($curl);
        // dd($response);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $datasReturn['result'] = 'E';
            $datasReturn['message'] = $err;
        } else {
            if($response == "{}"){
                $datasReturn['result'] = 'S';
                $datasReturn['message'] = 'Success';
            }else{
                $datasReturn['result'] = 'E';
                $datasReturn['message'] = $response;
            }
        }
        return $datasReturn;
  }
?>