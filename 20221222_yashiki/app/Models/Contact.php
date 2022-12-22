<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static function doSearch($fullname, $gender, $date_first, $date_last, $email)
    {
        $query = Contact::query();

        if (!empty($fullname)) {
            $query->where('fullname', 'LIKE', "%{$fullname}%");
        }

        if (!empty($gender)) {
            if ($gender == '1') {
                $query->where('gender', '=', '1');
            } elseif ($gender == '2') {
                $query->where('gender', '=', '2');
            }
        }

        if (!empty($date_first) && !empty($date_last)) {
            $query->whereBetween('created_at', [$date_first, $date_last]);
        } elseif (!empty($date_last)) {
            $query->where('created_at', '<=', $date_last);
        } elseif (!empty($date_first)) {
            $query->where('created_at', '>=', $date_first);
        }

        if (!empty($email)) {
            $query->where('email', 'LIKE', "%{$email}%");
        }
        $results = $query->Paginate(10);
        return $results;
    }
}
