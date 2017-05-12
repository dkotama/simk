<?php
namespace App;

use App\Conference;
use App\ConferenceDate;
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

    public function postExtends(Conference $confUrl, $request){
      // dd($request->all());
      $date = ConferenceDate::create($request->all());
      $result = $confUrl->dates()->save($date);

      return $result;
    }

    public function updateVisibility(Conference $confUrl, $request){

      if(count($request->visible) === 0) {
          return ['minimal' => 'Please check minimum 1 date to show'];
      }

      $visible = $request->visible;
      $dates   = $confUrl->dates;

      $dates = $dates->each(function ($item, $key) use ($visible) {
        if(array_key_exists($item->id, $visible)) {
          $item->update(['is_visible' => 1]);
        } else {
          $item->update(['is_visible' => 0]);
        }
      });
    }


}
