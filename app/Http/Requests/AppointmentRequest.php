<?php

namespace Calendar\Http\Requests;

use Calendar\Http\Requests\Request;

    class AppointmentRequest extends Request
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return [
                'title' => 'required|min:3',
                'date' => 'required|date_format:d.m.Y H:i'
            ];
        }
    }
