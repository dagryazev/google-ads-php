<?php

/**
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Ads\GoogleAds\Examples\Extensions;

require __DIR__ . '/../../vendor/autoload.php';

use GetOpt\GetOpt;
use Google\Ads\GoogleAds\Examples\Utils\ArgumentNames;
use Google\Ads\GoogleAds\Examples\Utils\ArgumentParser;
use Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder;
use Google\Ads\GoogleAds\Lib\V3\GoogleAdsClient;
use Google\Ads\GoogleAds\Lib\V3\GoogleAdsClientBuilder;
use Google\Ads\GoogleAds\Lib\V3\GoogleAdsException;
use Google\Ads\GoogleAds\Util\FieldMasks;
use Google\Ads\GoogleAds\Util\V3\ResourceNames;
use Google\Ads\GoogleAds\V3\Enums\ExtensionTypeEnum\ExtensionType;
use Google\Ads\GoogleAds\V3\Errors\GoogleAdsError;
use Google\Ads\GoogleAds\V3\Resources\CampaignExtensionSetting;
use Google\Ads\GoogleAds\V3\Services\CampaignExtensionSettingOperation;
use Google\ApiCore\ApiException;
use Google\Protobuf\StringValue;

/**
 * Updates the sitelink campaign extension setting to replace its extension feed items.
 * Note that this doesn't completely remove your old extension feed items.
 * See https://developers.google.com/google-ads/api/docs/extensions/extension-settings/overview
 * for details.
 */
class UpdateSitelinkCampaignExtensionSetting
{
    private const CUSTOMER_ID = 'INSERT_CUSTOMER_ID_HERE';
    private const CAMPAIGN_ID = 'INSERT_CAMPAIGN_ID_HERE';
    private const EXTENSION_FEED_ITEM_RESOURCE_NAME1
        = 'INSERT_EXTENSION_FEED_ITEM_RESOURCE_NAME1_HERE';
    private const EXTENSION_FEED_ITEM_RESOURCE_NAME2
        = 'INSERT_EXTENSION_FEED_ITEM_RESOURCE_NAME2_HERE';

    public static function main()
    {
        // Either pass the required parameters for this example on the command line, or insert them
        // into the constants above.
        $options = (new ArgumentParser())->parseCommandArguments([
            ArgumentNames::CUSTOMER_ID => GetOpt::REQUIRED_ARGUMENT,
            ArgumentNames::CAMPAIGN_ID => GetOpt::REQUIRED_ARGUMENT,
            ArgumentNames::EXTENSION_FEED_ITEM_RESOURCE_NAMES => GetOpt::MULTIPLE_ARGUMENT
        ]);

        // Generate a refreshable OAuth2 credential for authentication.
        $oAuth2Credential = (new OAuth2TokenBuilder())->fromFile()->build();

        // Construct a Google Ads client configured from a properties file and the
        // OAuth2 credentials above.
        $googleAdsClient = (new GoogleAdsClientBuilder())->fromFile()
            ->withOAuth2Credential($oAuth2Credential)
            ->build();

        try {
            self::runExample(
                $googleAdsClient,
                $options[ArgumentNames::CUSTOMER_ID] ?: self::CUSTOMER_ID,
                $options[ArgumentNames::CAMPAIGN_ID] ?: self::CAMPAIGN_ID,
                $options[ArgumentNames::EXTENSION_FEED_ITEM_RESOURCE_NAMES] ?:
                    [
                        self::EXTENSION_FEED_ITEM_RESOURCE_NAME1,
                        self::EXTENSION_FEED_ITEM_RESOURCE_NAME2
                    ]
            );
        } catch (GoogleAdsException $googleAdsException) {
            printf(
                "Request with ID '%s' has failed.%sGoogle Ads failure details:%s",
                $googleAdsException->getRequestId(),
                PHP_EOL,
                PHP_EOL
            );
            foreach ($googleAdsException->getGoogleAdsFailure()->getErrors() as $error) {
                /** @var GoogleAdsError $error */
                printf(
                    "\t%s: %s%s",
                    $error->getErrorCode()->getErrorCode(),
                    $error->getMessage(),
                    PHP_EOL
                );
            }
            exit(1);
        } catch (ApiException $apiException) {
            printf(
                "ApiException was thrown with message '%s'.%s",
                $apiException->getMessage(),
                PHP_EOL
            );
            exit(1);
        }
    }

    /**
     * Runs the example.
     *
     * @param GoogleAdsClient $googleAdsClient the Google Ads API client
     * @param int $customerId the client customer ID
     * @param int $campaignId the campaign ID
     * @param string $extensionFeedItemResourceNames the extension feed item resource names to
     *     replace
     */
    public static function runExample(
        GoogleAdsClient $googleAdsClient,
        int $customerId,
        int $campaignId,
        array $extensionFeedItemResourceNames
    ) {
        // Transforms the specified resource names to the array of StringValue, as required by
        // the API.
        $extensionFeedItems = array_map(function ($resourceName) {
            return new StringValue(['value' => $resourceName]);
        }, $extensionFeedItemResourceNames);

        // Creates a campaign extension setting using the specified campaign ID and extension feed
        // item resource names.
        $campaignExtensionSetting = new CampaignExtensionSetting([
            'resource_name' => ResourceNames::forCampaignExtensionSetting(
                $customerId,
                $campaignId,
                ExtensionType::SITELINK
            ),
            'extension_feed_items' => $extensionFeedItems
        ]);

        // Constructs an operation that will update the campaign extension setting, using the
        // FieldMasks utility to derive the update mask. This mask tells the Google Ads API which
        // attributes of the campaign extension setting you want to change.
        $campaignExtensionSettingOperation = new CampaignExtensionSettingOperation();
        $campaignExtensionSettingOperation->setUpdate($campaignExtensionSetting);
        $campaignExtensionSettingOperation->setUpdateMask(
            FieldMasks::allSetFieldsOf($campaignExtensionSetting)
        );

        // Issues a mutate request to update the campaign extension setting.
        $campaignExtensionSettingServiceClient =
            $googleAdsClient->getCampaignExtensionSettingServiceClient();
        $response = $campaignExtensionSettingServiceClient->mutateCampaignExtensionSettings(
            $customerId,
            [$campaignExtensionSettingOperation]
        );

        // Prints the resource name of the updated campaign extension setting.
        /** @var CampaignExtensionSetting $updatedCampaignExtensionSetting */
        $updatedCampaignExtensionSetting = $response->getResults()[0];
        printf(
            "Updated a campaign extension setting with resource name: '%s'.%s",
            $updatedCampaignExtensionSetting->getResourceName(),
            PHP_EOL
        );
    }
}

UpdateSitelinkCampaignExtensionSetting::main();
