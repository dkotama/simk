<?php
namespace App;

use App\Conference;
use Validator;

class ConferenceService
{
    public function update(Conference $confUrl, $request) {
        $rules = [
          'name' => 'required',
          'description' => 'required',
        ];

        $conferenceData = $request->all();

        if ($confUrl->url !== $conferenceData['url'] && $conferenceData['url'] !== '') {
          $rules['url'] = 'required|alpha_num|unique:conferences';
        } else {
          unset($conferenceData['url']);
        }


        $validator = Validator::make($request->all(), $rules);
        //
        if ($validator->fails()) {
          return $validator->errors();
        }

        $update = $confUrl->update($conferenceData);
        // //

        if ($update) {
          return true;
        }
    }

    public function extends(Conference $confUrl, $request){
      dd($request->all());
    }

    public function updateVisibility(Conference $confUrl, $request){
      dd($request->all());
    }


}
