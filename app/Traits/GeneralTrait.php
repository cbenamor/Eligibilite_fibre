<?php

namespace App\Traits;

trait GeneralTrait
{

    public function showPaginate(
        $builder,
        $start = 0,
        $limit = 50,
        $page = 1,
        $status_code = \Illuminate\Http\Response::HTTP_OK,
        $resource = null

    ) {
        $total = $builder->count();
        $builder = $builder
            ->offset($start)
            ->limit($limit)
            ->get()
            ->all();
        $data['data'] = $builder;
        $collection = $builder;
        $data['data'] = $collection;
        $count = (int) $limit;
        if ($total < $limit) {
            $count = $total;
        }
        $data['meta'] = [
            'pagination' => [
                'total' => $total,
                'count' => $count,
                'per_page' => (int) $limit,
                'current_page' => (int) $page,
                'total_pages' => max((int) ceil($total / $limit), 1),
            ],
        ];
        $data['status'] = true;
        $data['status_code'] = $status_code;

        return response()->json($data, $status_code);
    }



    public function returnError($status_code = 401, $message = 'something went wrong, caught yah!')
    {
       
        return response()->json(
            [
                'status' => false,
                'status_code' => $status_code,
                'message' => $message,
            ],
         $status_code,
        );
    }

    public function returnSuccessMessage($message = 'Accepted',  $status_code = '202')
    {
        return response()->json(
            [
                'status' => true,
                'status_code' => $status_code,
                'message' => $message,
            ],
            $status_code
        );
    }

    public function returnData($data, $status_code = \Illuminate\Http\Response::HTTP_OK,   $msg = '')
    {
        return response()->json(
            [
                'status' => true,
                'status_code' => $status_code,
                'message' => $msg,
                'data' => $data,
            ],
            $status_code
        );
    }

    public function returnValidationError($code = 'E001', $validator)
    {
        return $this->returnError($code, $validator->errors()->first());
    }

    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

    public function getErrorCode($input)
    {
        if ($input == 'name') {
            return 'E0011';
        } elseif ($input == 'password') {
            return 'E002';
        } elseif ($input == 'mobile') {
            return 'E003';
        } elseif ($input == 'id_number') {
            return 'E004';
        } elseif ($input == 'birth_date') {
            return 'E005';
        } elseif ($input == 'agreement') {
            return 'E006';
        } elseif ($input == 'email') {
            return 'E007';
        } elseif ($input == 'city_id') {
            return 'E008';
        } elseif ($input == 'insurance_company_id') {
            return 'E009';
        } elseif ($input == 'activation_code') {
            return 'E010';
        } elseif ($input == 'longitude') {
            return 'E011';
        } elseif ($input == 'latitude') {
            return 'E012';
        } elseif ($input == 'id') {
            return 'E013';
        } elseif ($input == 'promocode') {
            return 'E014';
        } elseif ($input == 'doctor_id') {
            return 'E015';
        } elseif ($input == 'payment_method' || $input == 'payment_method_id') {
            return 'E016';
        } elseif ($input == 'day_date') {
            return 'E017';
        } elseif ($input == 'specification_id') {
            return 'E018';
        } elseif ($input == 'importance') {
            return 'E019';
        } elseif ($input == 'type') {
            return 'E020';
        } elseif ($input == 'message') {
            return 'E021';
        } elseif ($input == 'reservation_no') {
            return 'E022';
        } elseif ($input == 'reason') {
            return 'E023';
        } elseif ($input == 'branch_no') {
            return 'E024';
        } elseif ($input == 'name_en') {
            return 'E025';
        } elseif ($input == 'name_ar') {
            return 'E026';
        } elseif ($input == 'gender') {
            return 'E027';
        } elseif ($input == 'nickname_en') {
            return 'E028';
        } elseif ($input == 'nickname_ar') {
            return 'E029';
        } elseif ($input == 'rate') {
            return 'E030';
        } elseif ($input == 'price') {
            return 'E031';
        } elseif ($input == 'information_en') {
            return 'E032';
        } elseif ($input == 'information_ar') {
            return 'E033';
        } elseif ($input == 'street') {
            return 'E034';
        } elseif ($input == 'branch_id') {
            return 'E035';
        } elseif ($input == 'insurance_companies') {
            return 'E036';
        } elseif ($input == 'photo') {
            return 'E037';
        } elseif ($input == 'logo') {
            return 'E038';
        } elseif ($input == 'working_days') {
            return 'E039';
        } elseif ($input == 'insurance_companies') {
            return 'E040';
        } elseif ($input == 'reservation_period') {
            return 'E041';
        } elseif ($input == 'nationality_id') {
            return 'E042';
        } elseif ($input == 'commercial_no') {
            return 'E043';
        } elseif ($input == 'nickname_id') {
            return 'E044';
        } elseif ($input == 'reservation_id') {
            return 'E045';
        } elseif ($input == 'attachments') {
            return 'E046';
        } elseif ($input == 'summary') {
            return 'E047';
        } elseif ($input == 'user_id') {
            return 'E048';
        } elseif ($input == 'mobile_id') {
            return 'E049';
        } elseif ($input == 'paid') {
            return 'E050';
        } elseif ($input == 'use_insurance') {
            return 'E051';
        } elseif ($input == 'doctor_rate') {
            return 'E052';
        } elseif ($input == 'provider_rate') {
            return 'E053';
        } elseif ($input == 'message_id') {
            return 'E054';
        } elseif ($input == 'hide') {
            return 'E055';
        } elseif ($input == 'checkoutId') {
            return 'E056';
        } else {
            return '';
        }
    }
}
