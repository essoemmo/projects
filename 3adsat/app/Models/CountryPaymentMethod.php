<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $country_id
 * @property int $payment_method_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Country $country
 * @property PaymentMethod $paymentMethod
 */
class CountryPaymentMethod extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable = ['country_id', 'payment_method_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    //get names by language
    public static function getAll($country_id, $language_id)
    {        
        $pageCatgeories = DB::table('country_payment_methods')
            ->join('payment_methods', 'payment_methods.id', '=', 'country_payment_methods.payment_method_id')
            ->join('payment_method_descriptions', 'payment_methods.id', '=', 'payment_method_descriptions.payment_method_id')
            ->select('country_payment_methods.*', 'payment_method_descriptions.name')
            ->where([
                    ['country_payment_methods.country_id', '=', $country_id],
                    ['payment_method_descriptions.language_id', '=', $language_id],
                    ['country_payment_methods.deleted_at', '=', NULL],
                    ['payment_method_descriptions.deleted_at', '=', NULL],
                   ])
            ->orderBy('payment_methods.sort_order', 'asc')
            ->get();

        return $pageCatgeories;      
    }

    public static function getOneById($country_payment_method_id, $language_id)
    {        
        $pageCatgeories = DB::table('country_payment_methods')
            ->join('payment_methods', 'payment_methods.id', '=', 'country_payment_methods.payment_method_id')
            ->join('payment_method_descriptions', 'payment_methods.id', '=', 'payment_method_descriptions.payment_method_id')
            ->select('country_payment_methods.*', 'payment_method_descriptions.name')
            ->where([
                    ['country_payment_methods.id', '=', $country_payment_method_id],
                    ['payment_method_descriptions.language_id', '=', $language_id],
                    ['country_payment_methods.deleted_at', '=', NULL],
                    ['payment_method_descriptions.deleted_at', '=', NULL],
                   ])
            ->first();
        return $pageCatgeories;      
    }

    public static function getOneByPaymentMethodId($payment_method_id, $language_id)
    {        
        $pageCatgeories = DB::table('country_payment_methods')
            ->join('payment_methods', 'payment_methods.id', '=', 'country_payment_methods.payment_method_id')
            ->join('payment_method_descriptions', 'payment_methods.id', '=', 'payment_method_descriptions.payment_method_id')
            ->select('country_payment_methods.*', 'payment_method_descriptions.name')
            ->where([
                    ['country_payment_methods.payment_method_id', '=', $payment_method_id],
                    ['payment_method_descriptions.language_id', '=', $language_id],
                    ['country_payment_methods.deleted_at', '=', NULL],
                    ['payment_method_descriptions.deleted_at', '=', NULL],
                   ])
            ->first();
        return $pageCatgeories;      
    }
}
