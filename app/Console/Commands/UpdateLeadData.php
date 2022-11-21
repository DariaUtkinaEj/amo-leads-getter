<?php

namespace App\Console\Commands;

use AmoCRM\Client\AmoCRMApiClient;
use App\Models\Lead;
use App\Models\LeadCatalogElement;
use App\Models\Company;
use App\Models\LeadCompany;
use App\Models\LeadContact;
use App\Models\LeadCustomField;
use App\Models\LeadCustomFieldValue;
use App\Models\LeadLossReason;
use App\Models\LeadTag;
use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;

class UpdateLeadData extends Command
{
    private $apiClient;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:lead';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->prepareAmoClient();

        $leadsService = $this->apiClient->leads();

        $leads = json_decode($leadsService->get(
            null,
            [
                'catalog_elements',
                'is_price_modified_by_robot',
                'loss_reason',
                'contacts',
                'source_id'
            ]
        ));

        DB::delete('DELETE FROM lead');

        foreach ($leads as $lead) {
            $leadModel = new Lead([
                'id' => $lead->id,
                'name' => $lead->name,
                'price' => $lead->price,
                'responsible_user_id' => $lead->responsible_user_id,
                'group_id' => $lead->group_id,
                'status_id' => $lead->status_id,
                'pipeline_id' => $lead->pipeline_id,
                'loss_reason_id' => $lead->loss_reason_id,
                'source_id' => $lead->source_id,
                'created_by' => $lead->created_by,
                'updated_by' => $lead->updated_by,
                'created_at' => $lead->created_at,
                'updated_at' => $lead->updated_at,
                'closest_task_at' => $lead->closest_task_at,
                'is_deleted' => $lead->is_deleted,
                'score' => $lead->score,
                'account_id' => $lead->account_id,
                'is_price_modified_by_robot' => $lead->is_price_modified_by_robot,
            ]);
            $leadModel->save();

            if (property_exists($lead, 'company')) {
                $companyModel = new Company([
                    'name' => $lead->company->name,
                    'responsible_user_id' => $lead->company->responsible_user_id,
                    'group_id' => $lead->company->group_id,
                    'created_by' => $lead->company->created_by,
                    'updated_by' => $lead->company->updated_by,
                    'created_at' => $lead->company->created_at,
                    'updated_at' => $lead->company->updated_at,
                    'closest_task_at' => $lead->company->closest_task_at,
                    'custom_fields_values' => $lead->company->custom_fields_values,
                    'account_id' => $lead->company->account_id,
                    'id' => $lead->company->id,
                ]);

                try {
                    $companyModel->save();
                } catch (\Exception $e) {}

                $leadCompanyRelation = new LeadCompany([
                    'lead_id' => $lead->id,
                    'company_id' => $lead->company->id
                ]);
                $leadCompanyRelation->save();
            }

            if (property_exists($lead, 'contacts') && is_array($lead->contacts)) {
                foreach ($lead->contacts as $contact) {
                    $leadContactModel = new LeadContact([
                        'name' => $contact->name,
                        'first_name' => $contact->first_name,
                        'last_name' => $contact->last_name,
                        'responsible_user_id' => $contact->responsible_user_id,
                        'group_id' => $contact->group_id,
                        'created_by' => $contact->created_by,
                        'updated_by' => $contact->updated_by,
                        'created_at' => $contact->created_at,
                        'updated_at' => $contact->updated_at,
                        'closest_task_at' => $contact->closest_task_at,
                        'custom_fields_values' => $contact->custom_fields_values,
                        'account_id' => $contact->account_id,
                        'is_unsorted' => $contact->is_unsorted,
                        'lead_id' => $lead->id
                    ]);
                    $leadContactModel->save();
                }
            }

            if (property_exists($lead, 'custom_fields_values') && is_array($lead->custom_fields_values)) {
                foreach ($lead->custom_fields_values as $customField) {
                    $leadCustomFieldModel = new LeadCustomField([
                        'id' => $customField->field_id,
                        'field_code' => $customField->field_code,
                        'field_name' => $customField->field_name,
                        'field_type' => $customField->field_type,
                        'lead_id' => $lead->id
                    ]);
                    $leadCustomFieldModel->save();

                    foreach ($customField->values as $value) {
                        $leadCustomFieldValueModel = new LeadCustomFieldValue([
                            'value' => $value->value,
                            'lead_custom_field_id' => $customField->field_id
                        ]);
                        $leadCustomFieldValueModel->save();
                    }
                }
            }

            if (property_exists($lead, 'tags') && is_array($lead->tags)) {
                foreach ($lead->tags as $tag) {
                    $leadTagModel = new Tag([
                        'id' => $tag->id,
                        'name' => $tag->name,
                        'color' => $tag->color,
                    ]);
                    try {
                        $leadTagModel->save();
                    } catch (\Exception $e) {}

                    $leadTagRelation = new LeadTag([
                        'lead_id' => $lead->id,
                        'tag_id' => $tag->id
                    ]);
                    $leadTagRelation->save();
                }
            }

            if (property_exists($lead, 'loss_reason')) {
                $leadLossReasonModel = new LeadLossReason([
                    'id' => $lead->loss_reason->id,
                    'name' => $lead->loss_reason->name,
                    'lead_id' => $lead->id
                ]);
                $leadLossReasonModel->save();
            }

            if (property_exists($lead, 'catalog_elements') && is_array($lead->catalog_elements)) {
                foreach ($lead->catalog_elements as $element) {
                    $leadCatalogElementModel = new LeadCatalogElement([
                        'id' => $element->id,
                        'lead_id' => $lead->id,
                        'metadata' => $element->metadata,
                        'quantity' => $element->quantity,
                        'catalog_id' => $element->catalog_id,
                        'price_id' => $element->price_id,
                    ]);
                    $leadCatalogElementModel->save();
                }
            }
        }
    }

    // should not be in __construct, reason: artisan calls all constructors of cli before any command
    // so this code will break artisan migrate (when done first time) if put into __construct
    private function prepareAmoClient()
    {
        $clientId     = env('AMO_CLIENT_ID');
        $clientSecret = env('AMO_CLIENT_SECRET');
        $redirectUri  = env('AMO_REDIRECT_URL');
        $refreshToken = env('AMO_REFRESH_TOKEN');
        $baseDomain   = env('AMO_BASE_DOMAIN');

        $this->apiClient = new AmoCRMApiClient($clientId, $clientSecret, $redirectUri);

        $accessTokenSavedData = DB::select('select * from amo_access_token');
        $accessTokenSavedData = $accessTokenSavedData[0];

        $accessToken = new AccessToken([
            'access_token'  => $accessTokenSavedData->access_token,
            'expires_in'    => $accessTokenSavedData->expires_at,
            'refresh_token' => $refreshToken,
            'baseDomain'    => $baseDomain
        ]);

        $this->apiClient->setAccessToken($accessToken)
            ->setAccountBaseDomain($accessToken->getValues()['baseDomain'])
            ->onAccessTokenRefresh(
                function (AccessTokenInterface $accessToken) {
                    $expiresAt = time() + 60 * 60 * 24;
                    DB::delete('DELETE FROM amo_access_token');
                    DB::insert("INSERT INTO amo_access_token VALUES (1, '$accessToken', $expiresAt)");
                });
    }
}
