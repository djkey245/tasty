<?php

namespace App\Models;

use App\PaymentTypes\PaymentTypeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    private static function checkPaymentTypeToImplement(string $class): bool
    {
        return !in_array(PaymentTypeInterface::class, class_implements($class));
    }

    public static function findBySlug($slug): ?PaymentType
    {
        $paymentType = self::where('slug', $slug)->active()->first();
        if (!$paymentType || self::checkPaymentTypeToImplement($paymentType->class)) {
            return null;
        }
        return $paymentType;
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort');
    }

    public static function activeSlugs()
    {
        return self::active()->ordered()->pluck('slug');
    }
}
