<?php

namespace cardial\Http\Requests;

use cardial\Http\Requests\Request;

class VisitaBaseRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
                //
        ];
    }

}
