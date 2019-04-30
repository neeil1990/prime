<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Google\AdsApi\AdWords\AdWordsSession;
use Google\AdsApi\AdWords\AdWordsSessionBuilder;
use Google\AdsApi\AdWords\Reporting\v201809\DownloadFormat;
use Google\AdsApi\AdWords\Reporting\v201809\ReportDefinition;
use Google\AdsApi\AdWords\Reporting\v201809\ReportDefinitionDateRangeType;
use Google\AdsApi\AdWords\Reporting\v201809\ReportDownloader;
use Google\AdsApi\AdWords\ReportSettingsBuilder;
use Google\AdsApi\AdWords\v201809\cm\Predicate;
use Google\AdsApi\AdWords\v201809\cm\PredicateOperator;
use Google\AdsApi\AdWords\v201809\cm\ReportDefinitionReportType;
use Google\AdsApi\AdWords\v201809\cm\Selector;
use Google\AdsApi\Common\OAuth2TokenBuilder;
use Google\AdsApi\AdWords\v201809\cm\DateRange;
use Mockery\CountValidator\Exception;

class AdWordsController extends Controller {

    public static function runExample(AdWordsSession $session, $filePath,$time,$id_user) {
        // Create selector.

        $selector = new Selector();
        $selector->setFields(['Cost','Clicks','AccountCurrencyCode']);
        // Use a predicate to filter out paused criteria (this is optional).

        $selector->setPredicates([
            new Predicate('Status', PredicateOperator::NOT_IN, ['PAUSED'])]);
        // Create report definition.


        $reportDefinition = new ReportDefinition();
        $reportDefinition->setSelector($selector);

        $reportDefinition->setReportName(
            'Criteria performance report #' . uniqid());

        if($time == 'ALL_TIME'){
            $reportDefinition->setDateRangeType(ReportDefinitionDateRangeType::ALL_TIME);
        }else {
            $reportDefinition->setDateRangeType(ReportDefinitionDateRangeType::CUSTOM_DATE);
            $selector->setDateRange(new DateRange(date('Y-m-d', strtotime('-' . $time . ' days')), date('Y-m-d', strtotime('-1 days'))));
        }



        $reportDefinition->setReportType(
            ReportDefinitionReportType::CRITERIA_PERFORMANCE_REPORT);
        $reportDefinition->setDownloadFormat(DownloadFormat::XML);


        // Download report.
        $reportDownloader = new ReportDownloader($session);


        // Optional: If you need to adjust report settings just for this one
        // request, you can create and supply the settings override here. Otherwise,
        // default values from the configuration file (adsapi_php.ini) are used.
        $reportSettingsOverride = (new ReportSettingsBuilder())
            ->includeZeroImpressions(false)
            ->build();


        try{
            $reportDownloadResult = $reportDownloader->downloadReport($reportDefinition, $reportSettingsOverride);
        }
        catch(\Exception $error){
            $notice = \App\NoticeSendMail::find(1);

            $subject = 'PRIME - Google Authorization Error: ID Клиента '.$id_user.' доступ запрещён';
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= 'From: PRIME ERROR' . "\r\n";

            $message = 'ID<br>'.$id_user;

            mail($notice->mail, $subject, $message, $headers);
            print $subject;
            return false;
        }

        $xml = $reportDownloadResult->getAsString($filePath);


        $SimpleXML = new \SimpleXMLElement($xml);

        $arCost = array();
        foreach($SimpleXML->table->row as $key=>$row){
            if((string)$row['clicks'] != 0){
                $arCost['clicks'][] = (string)$row['clicks'];
            }
            if(!empty((string)$row['cost'])){
                $arCost['cost'][] = (string)$row['cost'];
            }
            $AccountCurrencyCode = (string)$row['currency'];
        }
        if(isset($arCost['cost'])) {
            $summ_not_null_and_cent = substr(array_sum($arCost['cost']), 0, -6);
        }else{
            $summ_not_null_and_cent = 0;
        }
        if(isset($arCost['clicks'])) {
            $arCost['clicks'] = array_sum($arCost['clicks']);
        }else{
            $arCost['clicks'] = 0;
        }

        if(!empty($AccountCurrencyCode)){
            if($AccountCurrencyCode == "USD"){
                $currency = file_get_contents("https://www.cbr-xml-daily.ru/daily_json.js");
                $now_carrency = round(json_decode($currency)->Valute->$AccountCurrencyCode->Value);
                $summ_not_null_and_cent = $summ_not_null_and_cent*$now_carrency;
            }
        }

        $arrResult = array(
            'cost' => $summ_not_null_and_cent,
            'clicks' => $arCost['clicks']
        );

        return $arrResult;
    }

    public static function main($id_user,$time) {
        // Generate a refreshable OAuth2 credential for authentication.
        $auth_file = $_SERVER['DOCUMENT_ROOT']."/adsapi_php.ini";
        $oAuth2Credential = (new OAuth2TokenBuilder())
            ->fromFile($auth_file)
            ->build();
        // See: AdWordsSessionBuilder for setting a client customer ID that is
        // different from that specified in your adsapi_php.ini file.
        // Construct an API session configured from a properties file and the OAuth2
        // credentials above.
        $session = (new AdWordsSessionBuilder())
            ->fromFile($auth_file)
            ->withClientCustomerId($id_user)
            ->withOAuth2Credential($oAuth2Credential)
            ->build();

        $filePath = $_SERVER['DOCUMENT_ROOT']."/import.xml";
        return self::runExample($session, $filePath,$time,$id_user);
    }



    
}



