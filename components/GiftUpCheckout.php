<?php

namespace IgniterLabs\GiftUp\Components;

use IgniterLabs\GiftUp\Classes\GiftUpOptions;
use IgniterLabs\GiftUp\Models\Settings;
use System\Classes\BaseComponent;

class GiftUpCheckout extends BaseComponent
{
    public function defineProperties()
    {
        return [
            'companyId' => [
                'label' => 'Your company ID. Leave blank to use the default company ID',
                'type' => 'text',
                'validationRule' => 'required|string',
            ],
            'productId' => [
                'label' => 'Product ID',
                'type' => 'text',
                'validationRule' => 'required|string',
            ],
            'groupId' => [
                'label' => 'Group ID',
                'type' => 'text',
                'validationRule' => 'required|string',
            ],
            'language' => [
                'label' => 'Force a specific language',
                'type' => 'text',
                'default' => 'en-GB',
                'validationRule' => 'required|string',
            ],
            'purchaserName' => [
                'label' => 'Purchaser\'s name',
                'type' => 'text',
                'validationRule' => 'required|string',
            ],
            'purchaserEmail' => [
                'label' => 'Purchaser\'s email',
                'type' => 'text',
                'validationRule' => 'required|email',
            ],
            'recipientName' => [
                'label' => 'Recipient\'s name',
                'type' => 'text',
                'validationRule' => 'required|string',
            ],
            'recipientEmail' => [
                'label' => 'Recipient\'s email',
                'type' => 'text',
                'validationRule' => 'required|email',
            ],
            'step' => [
                'label' => 'The default checkout step to display',
                'type' => 'text',
                'default' => 'details',
                'options' => [
                    'details' => 'details',
                    'payment' => 'payment',
                ],
                'validationRule' => 'required|string',
            ],
            'whoFor' => [
                'label' => 'Who the buying experience is for',
                'type' => 'select',
                'options' => [
                    'yourself' => 'yourself',
                    'someoneelse' => 'someoneelse',
                    'onlyme' => 'onlyme',
                    'onlysomeoneelse' => 'onlysomeoneelse',
                ],
                'validationRule' => 'required|string',
            ],
            'promoCode' => [
                'label' => 'Automatically apply a promo code',
                'type' => 'text',
                'validationRule' => 'required|string',
            ],
            'hideArtwork' => [
                'label' => 'Whether to hide your artwork or not',
                'type' => 'switch',
                'default' => FALSE,
                'validationRule' => 'required|boolean',
            ],
            'hideGroups' => [
                'label' => 'Hide all grouped items. This will leave un-grouped items and the custom value gift cards',
                'type' => 'switch',
                'default' => FALSE,
                'validationRule' => 'required|boolean',
            ],
            'hideUngroupedItems' => [
                'label' => 'Hide all un-grouped items. This will leave all groups of items and the custom value gift cards (if enabled) only.',
                'type' => 'switch',
                'default' => FALSE,
                'validationRule' => 'required|boolean',
            ],
            'hideCustomValue' => [
                'label' => 'Hide custom value gift cards',
                'type' => 'switch',
                'default' => FALSE,
                'validationRule' => 'required|boolean',
            ],
            'customValueAmount' => [
                'label' => 'The custom value amount to display',
                'type' => 'text',
                'validationRule' => 'required|string',
            ],
        ];
    }

    public function onRun()
    {
        $this->page['errorPage'] = $this->controller->pageUrl($this->property('errorPage'));
        $this->page['successPage'] = $this->controller->pageUrl($this->property('successPage'));

        $this->page['giftUpOptions'] = $this->loadOptions();
    }

    protected function loadOptions()
    {
        return new GiftUpOptions([
            'companyId' => $this->property('companyId', Settings::getCompanyId()),
            'domain' => $this->property('domain'),
            'product' => $this->property('productId'),
            'group' => $this->property('groupId'),
            'language' => $this->property('language'),
            'purchaserName' => $this->property('purchaserName'),
            'purchaserEmail' => $this->property('purchaserEmail'),
            'recipientName' => $this->property('recipientName'),
            'recipientEmail' => $this->property('recipientEmail'),
            'step' => $this->property('step'),
            'whoFor' => $this->property('whoFor'),
            'promoCode' => $this->property('promoCode'),
            'hideArtwork' => $this->property('hideArtwork'),
            'hideGroups' => $this->property('hideGroups'),
            'hideUngroupedItems' => $this->property('hideUngroupedItems'),
            'hideCustomValue' => $this->property('hideCustomValue'),
            'customValueAmount' => $this->property('customValueAmount'),
        ]);
    }
}
